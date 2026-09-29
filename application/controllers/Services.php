<!-- Controller for Testing page, using services.php file -->

<?php

class Services extends MY_Controller
{

    private $apiKey;

    public function __construct()
    {
        parent::__construct();

        $this->load->library('Set_views');
        $this->load->helper('my_helper');

        $this->apiKey = get_secure_api_key('trip_ad_api');
    }

    public function searchLocations()
    {
        $searchQuery = $this->input->get('searchQuery');

        if (empty($searchQuery)) {
            echo '<p>Error: Missing required parameters (searchQuery or key).</p>';
            return;
        }

        $encodedQuery = urlencode($searchQuery);

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://api.content.tripadvisor.com/api/v1/location/search?key={$this->apiKey}&searchQuery={$encodedQuery}&language=en",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "accept: application/json"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo '<p>Error: ' . $err . '</p>';
        } else {
            $data = json_decode($response, true);

            if (isset($data['data']) && !empty($data['data'])) {
                foreach ($data['data'] as $location) {
                    echo '<p><strong>' . htmlspecialchars($location['name'], ENT_QUOTES, 'UTF-8') . '</strong><br>';
                    echo htmlspecialchars($location['address_obj']['address_string'], ENT_QUOTES, 'UTF-8') . '</p>';
                    echo '<p>Location ID: ' . htmlspecialchars($location['location_id'], ENT_QUOTES, 'UTF-8') . '</p>';
                }
            } else {
                echo '<p>No locations found.</p>';
            }
        }
    }

    public function searchLocationId()
    {
        $searchLocation = $this->input->get('searchLocation');
        if (empty($searchLocation)) {
            echo '<p>Error: Missing required parameters (searchQuery or key).</p>';
            return;
        }

        $encodedQuery = urlencode($searchLocation);

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://api.content.tripadvisor.com/api/v1/location/{$encodedQuery}/details?key={$this->apiKey}&language=en",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "accept: application/json"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo '<p>Error: ' . $err . '</p>';
        } else {
            $data = json_decode($response, true);

            if ($data) {
                echo '<p><strong>Name:</strong> ' . htmlspecialchars($data['name'], ENT_QUOTES, 'UTF-8') . '</p>';

                if (isset($data['address_obj']['address_string'])) {
                    echo '<p><strong>Address:</strong> ' . htmlspecialchars($data['address_obj']['address_string'], ENT_QUOTES, 'UTF-8') . '</p>';
                }
                if (isset($data['amenities']) && is_array($data['amenities'])) {
                    echo '<p><strong>Amenities:</strong> ' . htmlspecialchars(implode(', ', $data['amenities']), ENT_QUOTES, 'UTF-8') . '</p>';
                }

                if (isset($data['photo_count'])) {
                    echo '<p><strong>Photo Count:</strong> ' . htmlspecialchars($data['photo_count'], ENT_QUOTES, 'UTF-8') . '</p>';
                }

                if (isset($data['num_reviews'])) {
                    echo '<p><strong>Number of Reviews:</strong> ' . htmlspecialchars($data['num_reviews'], ENT_QUOTES, 'UTF-8') . '</p>';
                }

                if (isset($data['review_rating_count']) && is_array($data['review_rating_count'])) {
                    echo '<p><strong>Review Ratings:</strong></p>';
                    foreach ($data['review_rating_count'] as $stars => $count) {
                        echo '<p>' . htmlspecialchars($stars . '-star: ' . $count, ENT_QUOTES, 'UTF-8') . '</p>';
                    }
                }
            } else {
                echo '<p>No data found.</p>';
            }
        }
    }
}
