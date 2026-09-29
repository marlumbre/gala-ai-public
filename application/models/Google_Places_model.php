<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Google_Places_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('my_helper');
        $this->api_key = get_secure_api_key('google_api');
    }

    private $api_key;

    private function makeApiRequest($url, $params)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url . '?' . http_build_query($params));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response, true);
    }

    public function getGeocode($location)
    {
        $geocodeUrl = "https://maps.googleapis.com/maps/api/geocode/json";
        $geocodeParams = [
            'address' => $location,
            'key' => $this->api_key,
        ];

        $geocodeResponse = $this->makeApiRequest($geocodeUrl, $geocodeParams);

        if (isset($geocodeResponse['results']) && !empty($geocodeResponse['results'])) {
            return $geocodeResponse['results'][0]['geometry']['location'];
        }

        return null;
    }

    public function getNearbyPlaces($lat, $lng)
    {
        $placesUrl = "https://maps.googleapis.com/maps/api/place/nearbysearch/json";
        $placesParams = [
            'location' => "$lat,$lng",
            'radius' => 5000,
            'type' => "tourist_attraction",
            'key' => $this->api_key,
        ];

        return $this->makeApiRequest($placesUrl, $placesParams);
    }

    public function getPlaceDetails($placeId)
    {
        $detailsUrl = "https://maps.googleapis.com/maps/api/place/details/json";
        $detailsParams = [
            'place_id' => $placeId,
            'fields' => 'name,rating,vicinity,photos,editorial_summary,reviews,website',
            'key' => $this->api_key,
        ];

        return $this->makeApiRequest($detailsUrl, $detailsParams);
    }
}
