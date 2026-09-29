<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends MY_Controller
{
    private $apis;

    public function __construct()
    {
        parent::__construct();

        $this->load->library('Set_views');
        $this->load->model('Booking_model');
        $this->load->model('Home_data_model');
        $this->load->model('Admin_model');
        $this->load->model('Gpt_model');

        $this->load->helper('my_helper');

        $this->apis = array(
            'gpt' => get_secure_api_key('openai_api'),
            'maps' => get_secure_api_key('google_api'),
            'tripAd' => get_secure_api_key('trip_ad_api')
        );
    }

    public function index()
    {
        $place_data = $this->Admin_model->get_trending_places();
        $carousel_images = $this->Home_data_model->get_carousel_images();

        $data = array(
            'places' => $place_data,
            'carousel_images' => $carousel_images,
            'maps' => $this->apis['maps']
        );

        $this->render($this->set_views->home(), 'Home', $data);
    }

    public function about()
    {
        // if ($this->session->userdata('log') != 'logged') {
        //     redirect('Login/index');
        // } else {
        $this->render($this->set_views->about(), 'About');
        // }
    }

    public function services()
    {
        // if ($this->session->userdata('log') != 'logged') {
        //     redirect('Login/index');
        // } else {
        $this->render($this->set_views->services(), 'Services');
        // }
    }

    public function blog()
    {
        // if ($this->session->userdata('log') != 'logged') {
        //     redirect('Login/index');
        // } else {
        $this->render($this->set_views->blog(), 'Blog');
        // }
    }

    public function booking()
    {
        // if (!$this->session->userdata('id')) {
        //         redirect('Login/index');
        // } else {
        $this->render($this->set_views->booking(), 'Booking');
        // }
    }

    public function contact()
    {
        // if ($this->session->userdata('log') != 'logged') {
        //     redirect('Login/index');
        // } else {
        $this->render($this->set_views->contact(), 'Contact');
        // }
    }

    public function destination()
    {
        $this->render($this->set_views->destination(), 'Home');
    }

    public function gallery()
    {
        // if ($this->session->userdata('log') != 'logged') {
        //     redirect('Login/index');
        // } else {
        $this->render($this->set_views->gallery(), 'Gallery');
        // }
    }

    public function guides()
    {
        // if ($this->session->userdata('log') != 'logged') {
        //     redirect('Login/index');
        // } else {
        $this->render($this->set_views->guides(), 'Guides');
        // }
    }

    public function packages()
    {
        // if ($this->session->userdata('log') != 'logged') {
        //     redirect('Login/index');
        // } else {
        $this->render($this->set_views->packages(), 'Packages');
        // }
    }

    public function sample()
    {
        // if ($this->session->userdata('log') != 'logged') {
        //     redirect('Login/index');
        // } else {
        $this->render($this->set_views->sample(), 'Sample');
        // }
    }

    public function testimonial()
    {
        // if ($this->session->userdata('log') != 'logged') {
        //     redirect('Login/index');
        // } else {
        $this->render($this->set_views->testimonial(), 'Testimonial');
        // }
    }

    public function tour()
    {
        // if ($this->session->userdata('log') != 'logged') {
        //     redirect('Login/index');
        // } else {
        $this->render($this->set_views->tour(), 'Tour');
        // }
    }

    public function search()
    {
        // if ($this->session->userdata('log') != 'logged') {
        //     redirect('Login/index');
        // } else {
        $this->render($this->set_views->search(), 'Search');
        // }
    }

    public function form()
    {
        $province_data = $this->Booking_model->get_province_data();
        $place_data = $this->Booking_model->get_place_data();
        $budget_data = $this->Booking_model->get_budget_data();
        $filter_data = $this->Booking_model->get_filter_data();
        $count_data = $this->Booking_model->get_count_data();

        $data = array(
            'gpt' => $this->apis['gpt'],
            'maps' => $this->apis['maps'],
            'province' => $province_data,
            'places' => $place_data,
            'counts' => $count_data,
            'budget' => $budget_data,
            'filter' => $filter_data
        );


        $this->render_booking($this->set_views->form(), 'Booking', $data);
    }

    public function Save()
    {
        $this->load->model('Gpt_model');
        $types = $this->Gpt_model->collect_place_types('Metro Manila');

        foreach ($types as $type) {
            $exists = $this->db->get_where('data', ['value' => $type])->row();

            if (!$exists) {
                $this->db->insert('data', ['value' => $type, 'type' => 'place', 'valid' => 1]);
            }
        }

        echo "Types synchronized.";
    }

    public function query()
    {
        $province = $this->input->post('province');
        $place = $this->input->post('place');
        $budget = $this->input->post('budget');
        $total_guest = $this->input->post('total_guest');
        $data = [];

        if (!empty($province) || !empty($place)) {
            $jsonContent = $this->Gpt_model->get_combined_recommendations($province, $place, $budget, $total_guest);

            // $jsonContent = json_decode($response, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                echo json_encode(['status' => 'success', 'data' => $jsonContent]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Response format from is invalid or not structured as JSON.', 'json' => $jsonContent]);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Please enter a location.']);
        }
    }

    public function get_places_db()
    {
        $user_id = $this->session->userdata('id');

        $events = $this->Booking_model->get_places($user_id);

        if (!empty($events)) {
            echo json_encode(['status' => 'success', 'data' => $events]);
        } else {
            echo json_encode(['status' => 'error', 'data' => []]);
        }
    }

    public function save_place_db()
    {
        $user_id = $this->session->userdata('id');

        if (!$user_id) {
            echo json_encode(['status' => 'error', 'message' => 'User is not logged in.']);
            return;
        }

        $name = $this->input->post('name');
        $type = $this->input->post('type');
        $location = $this->input->post('location');
        $description = $this->input->post('description');
        $date = $this->input->post('date');

        if (empty($name) || empty($type) || empty($location) || empty($description) || empty($date)) {
            echo json_encode(['status' => 'error', 'message' => 'All fields are required.']);
            return;
        }

        $data = [
            'user_id' => $user_id,
            'name' => $name,
            'type' => $type,
            'location' => $location,
            'description' => $description,
            'date' => $date,
            'created_at' => date('Y-m-d H:i:s')
        ];

        if ($this->Booking_model->save_place($data)) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to save the place.']);
        }
    }

    public function show_itinerary()
    {
        $location = $this->input->post('location');
        $total_days = $this->input->post('total_days');
        $place = $this->input->post('place');
        $total_guest = $this->input->post('total_guest');

        if (strtolower($total_guest) === "solo") {
            $total_guest = 'solo individual';
        }

        // Example: Fetch itinerary from model
        $data['location'] = $location;
        $data['total_days'] = $total_days;
        $data['place'] = $place;
        $data['total_guest'] = $total_guest;
        $data['itinerary'] = $this->Gpt_model->get_itinerary($location, $total_days, $place, $total_guest);

        if (empty($data['itinerary'])) {
            echo json_encode([
                'status' => 'error',
                'message' => 'No itinerary found for the given criteria.'
            ]);
            return;
        }

        $html = $this->load->view('partials/itinerary_modal', $data, TRUE);

        echo json_encode([
            'status' => 'success',
            'html' => $html
        ]);
    }
}
