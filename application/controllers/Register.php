<?php

class Register extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->library('Set_views');
        $this->load->model('User_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->register_page();
    }

    public function register_page()
    {
        $this->render_login($this->set_views->register(), 'Register');
    }

    public function register()
    {
        // Set form validation rules
        $this->form_validation->set_rules('username', 'Full Name', 'required');
        $this->form_validation->set_rules('sex', 'Sex', 'required');
        $this->form_validation->set_rules('gender', 'Gender', 'required');
        $this->form_validation->set_rules('birthdate', 'Birthdate', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[user.email]');
        $this->form_validation->set_rules('phone', 'Phone Number', 'required|regex_match[/^[9][0-9]{9}$/]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');


        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('register_error', 'Invalid name or password');
            $this->render_login($this->set_views->register(), 'Register');
        } else {

            // Prepare data for insertion
            $data = array(
                'username'  => $this->input->post('username'),
                'sex'       => $this->input->post('sex'),
                'gender'    => $this->input->post('gender'),
                'birthdate' => $this->input->post('birthdate'),
                'email'     => $this->input->post('email'),
                'phone'     => '+63' . $this->input->post('phone'),
                'password'  => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'valid'     => 1
            );


            $user_id = $this->User_model->register($data);

            if ($user_id) {
                // $user_data = array(
                //     'id' => $user['id'],
                //     'email' => $user['email'],
                // );

                // $this->session->set_userdata($user_data);
                // $this->session->set_userdata('log', 'logged');
                $this->session->set_flashdata('register_success', 'Account successfully created!');
                $this->render($this->set_views->home(), 'Home');
            } else {
                $this->session->set_flashdata('register_error', 'Account creation failed.');
                $this->render_login($this->set_views->register(), 'Register');
            }
        }
    }
}
