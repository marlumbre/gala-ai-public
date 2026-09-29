<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tripadvisor_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('NY_Helper');
        $this->api_key = get_secure_api_key('trip_ad_api');
    }

    private $api_key;
    private $base_url = 'https://api.content.tripadvisor.com/api/v1';

    private function makeApiRequest($endpoint, $params = [])
    {
        $params['key'] = $this->api_key;

        $url = $this->base_url . $endpoint . '?' . http_build_query($params);

        $headers = [
            'Accept: application/json',
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response, true);
    }

    public function getLocationId($location)
    {
        $endpoint = '/location/search';
        $params = [
            'searchQuery' => $location,
            'category' => 'attractions',
            'language' => 'en',
        ];

        $response = $this->makeApiRequest($endpoint, $params);

        log_message('debug', 'TripAdvisor API Response: ' . print_r($response, true));

        if (isset($response['data']) && !empty($response['data'])) {
            return $response['data'][0]['location_id'];
        }

        return null;
    }

    public function getLatLng($locationId)
    {
        $endpoint = '/location/' . $locationId . '/details';
        $params = [
            'language' => 'en',
        ];

        $response = $this->makeApiRequest($endpoint, $params);

        if (isset($response['latitude']) && isset($response['longitude'])) {
            return [
                'lat' => $response['latitude'],
                'lng' => $response['longitude'],
            ];
        }

        return null;
    }

    public function getNearbyTravelSpots($lat, $lng)
    {
        $endpoint = '/location/nearby_search';
        $params = [
            'latLong' => $lat . ',' . $lng,
            'category' => 'attractions,hotels,restaurants',
            'language' => 'en',
        ];

        return $this->makeApiRequest($endpoint, $params);
    }
}
