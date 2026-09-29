<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->library('Set_views');
        $this->load->model('User_model');
        $this->load->model('Admin_model');
        $this->load->model('Home_data_model');
    }

    public function index()
    {
        $this->login_page();
    }

    public function login_page()
    {
        $this->render_login($this->set_views->login(), 'Login');
    }

    public function login()
    {
        $this->form_validation->set_rules('email', 'email', 'required');
        $this->form_validation->set_rules('password', 'password', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('login_error', 'Invalid email or password');
        } else {
            $email = $this->input->post('email');
            $password = $this->input->post('password');

            $user = $this->User_model->login($email, $password);

            if ($user) {
                $this->session->set_userdata([
                    'id' => $user['id'],
                    'email' => $user['email'],
                    'log' => 'logged'
                ]);
                $this->session->set_flashdata('login_success', 'You are now logged in!');
            } else {
                $this->session->set_flashdata('login_error', 'Invalid email or password');
            }
        }

        $this->load_home_page();
    }

    public function logout()
    {
        $this->session->unset_userdata(['id', 'email', 'log']);
        $this->session->sess_destroy();

        $this->session->set_flashdata('logout_success', 'Logged out successfully!');

        $this->load_home_page();
    }

    private function load_home_page()
    {
        $place_data = $this->Admin_model->get_trending_places();
        $carousel_images = $this->Home_data_model->get_carousel_images();

        $data = array(
            'places' => $place_data,
            'carousel_images' => $carousel_images
        );

        $this->render($this->set_views->home(), 'Home', $data);
    }
}
