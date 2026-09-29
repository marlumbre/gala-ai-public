<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Gpt_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('my_helper');
        $this->load->database();
        $this->gpt_key = get_secure_api_key('openai_api');
        $this->google_key = get_secure_api_key('google_api');
    }

    private $gpt_key;
    private $google_key;

    public function get_google_places($location)
    {
        $encoded_location = urlencode($location);
        $url = "https://maps.googleapis.com/maps/api/place/textsearch/json?query=hotels+resorts+attractions+in+{$encoded_location}&key={$this->google_key}";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        $places = json_decode($response, true);

        $results = [];
        if (isset($places['results'])) {
            foreach ($places['results'] as $place) {
                $results[] = [
                    'name' => $place['name'] ?? '',
                    'lat' => $place['geometry']['location']['lat'] ?? '',
                    'lng' => $place['geometry']['location']['lng'] ?? '',
                    'address' => $place['formatted_address'] ?? '',
                    'type' => $place['types'][0] ?? 'Place',
                    'location' => $place['vicinity'] ?? '',
                    'description' => $place['name'] . " located in " . ($place['vicinity'] ?? $location),
                ];
            }
        }

        return $results;
    }

    public function get_google_recommendations($province, $place, $budget, $total_guest)
    {
        $query = urlencode("{$place} in {$province}");
        $url = "https://maps.googleapis.com/maps/api/place/textsearch/json?query={$query}&key={$this->google_key}";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        $places = json_decode($response, true);

        $results = [];
        if (isset($places['results'])) {
            foreach ($places['results'] as $place) {
                $results[] = [
                    'name' => $place['name'] ?? '',
                    'lat' => $place['geometry']['location']['lat'] ?? '',
                    'lng' => $place['geometry']['location']['lng'] ?? '',
                    'address' => $place['formatted_address'] ?? '',
                    'type' => $place['types'][0] ?? 'Place',
                    'location' => $place['vicinity'] ?? '',
                    'description' => "Rated " . ($place['rating'] ?? 'N/A') . " based on " . ($place['user_ratings_total'] ?? '0') . " reviews.",
                    'link' => "https://www.google.com/maps/search/?api=1&query=" . urlencode($place['name'])
                ];
            }
        }

        return $results;
    }

    public function collect_place_types($location)
    {
        $url = "https://maps.googleapis.com/maps/api/place/textsearch/json?query=" . urlencode("places in $location") . "&key={$this->google_key}";

        $types = [];

        $nextPageToken = null;

        do {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            curl_close($ch);

            $data = json_decode($response, true);

            if (isset($data['results'])) {
                foreach ($data['results'] as $place) {
                    if (isset($place['types'])) {
                        foreach ($place['types'] as $type) {
                            $types[$type] = true; 
                        }
                    }
                }
            }

            if (isset($data['next_page_token'])) {
                $nextPageToken = $data['next_page_token'];
                sleep(2);
                $url = "https://maps.googleapis.com/maps/api/place/textsearch/json?pagetoken=$nextPageToken&key={$this->google_key}";
            } else {
                $nextPageToken = null;
            }
        } while ($nextPageToken);

        return array_keys($types);
    }

    public function get_places($location)
    {
        $url = "https://api.openai.com/v1/chat/completions";

        $prompt = "Provide a list of popular resorts, hotels, and tourist attractions in $location. 
        Format the response as a JSON array where each item includes the following fields:
        - name: The name of the resort, hotel, or tourist attraction.
        - lat: The latitude coordinates of the location for google maps.
        - address: The full address of the location provided.
        - lng: The longhitude coordinates of the location for google maps.
        - type: Specify whether it is a 'Resort', 'Hotel', or 'Tourist Attraction'.
        - location: Provide a brief description of its location, including nearby landmarks or features.
        - description: Add 2 to 3 sentences about the place, focusing on what makes it interesting or special.";


        $data = [
            "model" => "gpt-4o",
            "messages" => [
                ["role" => "system", "content" => "You are a travel assistant providing structured information about locations."],
                ["role" => "user", "content" => $prompt]
            ]
        ];

        $headers = [
            "Content-Type: application/json",
            "Authorization: Bearer {$this->gpt_key}"
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);
        curl_close($ch);

        $response_data = json_decode($response, true);

        if (isset($response_data['choices'][0]['message']['content'])) {
            $content = $response_data['choices'][0]['message']['content'];

            $clean_content = preg_replace('/```json\n|\n```/', '', $content);

            return $clean_content;
        }
    }

    public function get_itinerary($location, $total_days, $place, $total_guest)
    {
        $url = "https://api.openai.com/v1/chat/completions";
        
        $total_day = intval($total_days);

        $prompt = "Create a detailed $total_day-day travel itinerary for $location with main point of interest for $place, tailor the events for group of people like $total_guest.
        Format the response as a **valid JSON object**, with each day represented as a key like 'Day 1', etc.
        Each day should include time segments like 'Morning', 'Midday', 'Afternoon', 'Evening', and list activities under each.
        Each activity should include:
        - time: Time range (e.g., 7:00 AM - 8:00 AM)
        - title: Title or name of the activity
        - location: Specific name of the establishment and city e.g. Okada, Manila
        - description: 2-3 sentence description of the activity and what to expect
        - tips: Optional travel tips or must-try items for the activity

        **Ensure valid JSON output. Do not wrap it in markdown or code fences.**";

        $data = [
            "model" => "gpt-4o",
            "messages" => [
                ["role" => "system", "content" => "You are a helpful travel assistant that outputs clean, structured JSON itineraries."],
                ["role" => "user", "content" => $prompt]
            ]
        ];

        $headers = [
            "Content-Type: application/json",
            "Authorization: Bearer {$this->gpt_key}"
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);
        curl_close($ch);

        $response_data = json_decode($response, true);

        if (isset($response_data['choices'][0]['message']['content'])) {
            $content = $response_data['choices'][0]['message']['content'];

            // This assumes the model followed instructions and output clean JSON
            return json_decode($content, true);
        }

        return null;
    }


    public function get_recommendations($province, $place, $budget, $total_guest)
    {
        $url = "https://api.openai.com/v1/chat/completions";

        $prompt = "Provide a list of popular $place in $province " . ($budget ? " with a budget of $budget" : "") . ($total_guest ? " and can accommodate $total_guest person(s)" : "") . ".
        Format the response as a JSON array where each item includes the following fields:
        - name: The name of the resort, hotel, or tourist attraction.
        - lat: The latitude coordinates of the location for google maps.
        - lng: The longhitude coordinates of the location for google maps.
        - address: The full address of the location provided.
        - type: Specify what type of place is it.
        - location: Provide a brief description of its location, including nearby landmarks or features.
        - description: Provide a concise and engaging description of the place in 2 to 3 sentences. Highlight what makes it unique or special, such as its standout features, ambiance, or activities. Additionally, include the estimated number of guests the place can accommodate and the approximate budget guests should expect to spend (in Philippine Peso). Ensure the description is informative and appealing to potential visitors. 
        - link: a link to a website about each resort, hotel, or tourist attraction that contains photos. Make sure the link is redirectable
        ";

        $data = [
            "model" => "gpt-4o",
            "messages" => [
                ["role" => "system", "content" => "You are a travel assistant providing structured information about locations."],
                ["role" => "user", "content" => $prompt]
            ]
        ];

        $headers = [
            "Content-Type: application/json",
            "Authorization: Bearer {$this->gpt_key}"
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);
        curl_close($ch);

        $response_data = json_decode($response, true);

        if (isset($response_data['choices'][0]['message']['content'])) {
            $content = $response_data['choices'][0]['message']['content'];

            $clean_content = preg_replace('/```json\n|\n```/', '', $content);

            return $clean_content;
        }
    }
        
    public function get_combined_recommendations($province, $place, $budget = '', $total_guest = '')
    {
        // Step 1: Get places from Google
        $places = $this->get_google_recommendations($province, $place, $budget, $total_guest);

        if (empty($places)) return [];

        // Step 2: Prepare GPT prompt from Google data
        $place_list = array_map(function($p) {
            return [
                'name' => $p['name'],
                'address' => $p['address']
            ];
        }, $places);

        $prompt = "You are a travel assistant. Given the following list of tourist places in $province, generate a concise and engaging description (2-3 sentences) for each. Each description should highlight the place’s unique features, ambiance, or activities. If possible, include the estimated number of guests it can accommodate and an approximate budget in PHP.

    Return only a JSON array with this format:
    [
    {
        \"name\": \"PLACE_NAME\",
        \"description\": \"...generated description...\"
    },
    ...
    ]

    List of places:\n" . json_encode($place_list, JSON_PRETTY_PRINT);

        // Step 3: Query GPT for descriptions
        $gpt_response = $this->query_gpt_for_descriptions($prompt);
        $descriptions = json_decode($gpt_response, true);

        if (!is_array($descriptions)) return $places;

        // Step 4: Merge GPT descriptions into Google data
        foreach ($places as &$place_item) {
            foreach ($descriptions as $desc_item) {
                if (strcasecmp($place_item['name'], $desc_item['name']) == 0) {
                    $place_item['description'] = $desc_item['description'];
                    break;
                }
            }
        }

        return $places;
    }

    private function query_gpt_for_descriptions($prompt)
    {
        $url = "https://api.openai.com/v1/chat/completions";

        $data = [
            "model" => "gpt-4o",
            "messages" => [
                ["role" => "system", "content" => "You are a travel assistant providing detailed and attractive descriptions of tourist places."],
                ["role" => "user", "content" => $prompt]
            ]
        ];

        $headers = [
            "Content-Type: application/json",
            "Authorization: Bearer {$this->gpt_key}"
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);
        curl_close($ch);

        $response_data = json_decode($response, true);

        if (isset($response_data['choices'][0]['message']['content'])) {
            $content = $response_data['choices'][0]['message']['content'];
            $clean_content = preg_replace('/```json\n|\n```/', '', $content); // strip markdown blocks
            return $clean_content;
        }

        return null;
    }

}
