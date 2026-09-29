<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TripAdvisor extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('NY_Helper');
    }

    public function get_places()
    {
        $lat = $this->input->get('lat');
        $lng = $this->input->get('lng');
        $category = $this->input->get('category');
        $filters = $this->input->get('filters');

        $apiKey = get_secure_api_key('trip_ad_api');
        $apiUrl = "https://api.tripadvisor.com/api/v2/search?lat=$lat&lng=$lng&category=$category&filters=$filters&key=$apiKey";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        $httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        if ($httpStatus != 200) {
            $this->output
                ->set_status_header($httpStatus)
                ->set_content_type('application/json')
                ->set_output(json_encode(['error' => 'Unable to fetch data']));
        } else {
            $this->output
                ->set_content_type('application/json')
                ->set_output($response);
        }
    }
}
