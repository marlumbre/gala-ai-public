<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Search extends MY_Controller
{
    public function index()
    {
        $this->search_page();
    }

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Google_Places_model');
        $this->load->model('Tripadvisor_model');
        $this->load->model('Admin_model');
    }


    public function search_page()
    {
        $this->render_login($this->set_views->search(), 'Search');
    }

    public function query()
    {
        $location = $this->input->post('location');

        if (empty($location)) {
            $this->output
                ->set_status_header(400)
                ->set_content_type('application/json')
                ->set_output(json_encode(['error' => 'Missing location parameter.']));
            return;
        }

        //get latitude longitude of searched location
        $geocode = $this->Google_Places_model->getGeocode($location);

        if ($geocode) {
            $lat = $geocode['lat'];
            $lng = $geocode['lng'];

            //get nerby place of searched location
            $placesResponse = $this->Google_Places_model->getNearbyPlaces($lat, $lng);

            if (isset($placesResponse['results']) && !empty($placesResponse['results'])) {
                $placesWithDetails = [];

                foreach ($placesResponse['results'] as $place) {
                    $placeId = $place['place_id'];
                    $detailsResponse = $this->Google_Places_model->getPlaceDetails($placeId);

                    if (isset($detailsResponse['result'])) {
                        $place['details'] = $detailsResponse['result'];
                    }
                    $placesWithDetails[] = $place;
                }

                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode(['status' => 'OK', 'results' => $placesWithDetails]));
            } else {
                $this->output
                    ->set_status_header(404)
                    ->set_content_type('application/json')
                    ->set_output(json_encode(['error' => 'No results found.']));
            }
        } else {
            $this->output
                ->set_status_header(404)
                ->set_content_type('application/json')
                ->set_output(json_encode(['error' => 'Location not found.']));
        }
    }

    public function query_tripadvisor()
    {
        $location = $this->input->post('location');

        if (empty($location)) {
            $this->output
                ->set_status_header(400)
                ->set_content_type('application/json')
                ->set_output(json_encode(['error' => 'Missing location parameter.']));
            return;
        }

        //get loc id
        $locationId = $this->Tripadvisor_model->getLocationId($location);

        if ($locationId) {
            //get lat lng
            $latLng = $this->Tripadvisor_model->getLatLng($locationId);

            if ($latLng) {
                //get nearby travel spots
                $nearbySpots = $this->Tripadvisor_model->getNearbyTravelSpots($latLng['lat'], $latLng['lng']);

                if (isset($nearbySpots['data']) && !empty($nearbySpots['data'])) {
                    $this->output
                        ->set_content_type('application/json')
                        ->set_output(json_encode(['status' => 'OK', 'results' => $nearbySpots['data']]));
                } else {
                    $this->output
                        ->set_status_header(404)
                        ->set_content_type('application/json')
                        ->set_output(json_encode(['error' => 'No nearby travel spots found.']));
                }
            } else {
                $this->output
                    ->set_status_header(404)
                    ->set_content_type('application/json')
                    ->set_output(json_encode(['error' => 'Could not fetch latitude and longitude for the location.']));
            }
        } else {
            $this->output
                ->set_status_header(404)
                ->set_content_type('application/json')
                ->set_output(json_encode(['error' => 'Location not found. Please try a different location.']));
        }
    }

    public function track_input()
    {
        $user_id = $this->session->userdata('id');
        $user_input = $this->input->post('userInput');

        if (!$user_id) {
            $data = array(
                'u_ID' => 0,
                'input' => $user_input,
                'valid' => 1
            );

            $data = $this->Admin_model->save_input($data);
        } else {
            $data = array(
                'u_ID' => $user_id,
                'input' => $user_input,
                'valid' => 1
            );
        }

        $data = $this->Admin_model->save_input($data);
    }
}
