<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->library('Set_views');

        $this->load->model('Home_model');
        $this->load->model('User_model');
    }

    public function index()
    {
        $this->profile();
    }

    public function profile()
    {
        $id = $this->input->get('id');
        $results = $this->Home_model->get_db($id);
        $data = array(
            'user_id' => $results['id'],
            'imagePath' => isset($results['imagePath']) ? $results['imagePath'] : 'db/user_profile/default.jpg',
            'name' => $results['username'],
            'gender' => isset($results['gender']) ? $results['gender'] : null,
            'address' => 'null',
            'AccountStat' => isset($results['accountStat']) ? $results['accountStat'] : null,
            'age' => isset($results['birthdate']) ? date('Y') - date('Y', strtotime($results['birthdate'])) : 'Birthday not set',
            'birthDate' => isset($results['birthdate']) ? $results['birthdate'] : null,
            'username' => isset($results['username']) ? $results['username'] : null,
            'email' => isset($results['email']) ? $results['email'] : null,
            'password' => isset($results['password']) ? $results['password'] : null
        );
        $this->render($this->set_views->profile(), 'Profile', $data);
    }

    public function update_img()
    {
        $config['upload_path']   = 'db/user_profile/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size']      = 2048;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('newPhoto')) {
            $id = $this->session->userdata('id');
            $fileData = $this->upload->data();
            $array = array(
                'imagePath' => 'db/user_profile/' . $fileData['file_name']
            );

            $this->User_model->update_profile($id, $array['imagePath']);

            $id = $this->session->userdata('id');
            $results = $this->Home_model->get_db($id);
            $data = array(
                'user_id' => $results['id'],
                'imagePath' => isset($results['imagePath']) ? $results['imagePath'] : 'db/user_profile/default.jpg',
                'name' => $results['username'],
                'gender' => isset($results['gender']) ? $results['gender'] : null,
                'address' => 'null',
                'AccountStat' => isset($results['accountStat']) ? $results['accountStat'] : null,
                'age' => date('Y') - date('Y', strtotime($results['birthdate'])),
                'birthDate' => isset($results['birthdate']) ? $results['birthdate'] : null,
                'username' => isset($results['username']) ? $results['username'] : null,
                'email' => isset($results['email']) ? $results['email'] : null,
                'password' => isset($results['password']) ? $results['password'] : null
            );
            $this->render($this->set_views->profile(), 'Profile', $data);
        };
    }

    public function update()
    {
        $oldPass = $this->input->post('oldPass');
        $newPass = $this->input->post('newPass');
        $confirmPass = $this->input->post('confirmPass');
        $id = $this->session->userdata('id');


        if ($newPass != $confirmPass) {
            $this->session->set_flashdata('mismatch_error', 'Password does not match');
        } else {
            if (!$this->User_model->update_acc($oldPass, $newPass, $id)) {
                $this->session->set_flashdata('incorrect_error', 'Incorrect Password');
            }
        }

        $results = $this->Home_model->get_db($id);
        $data = array(
            'user_id' => $results['id'],
            'imagePath' => isset($results['imagePath']) ? $results['imagePath'] : 'db/user_profile/default.jpg',
            'name' => $results['username'],
            'gender' => isset($results['gender']) ? $results['gender'] : null,
            'address' => 'null',
            'AccountStat' => isset($results['accountStat']) ? $results['accountStat'] : null,
            'age' => date('Y') - date('Y', strtotime($results['birthdate'])),
            'birthDate' => isset($results['birthdate']) ? $results['birthdate'] : null,
            'username' => isset($results['username']) ? $results['username'] : null,
            'email' => isset($results['email']) ? $results['email'] : null,
            'password' => isset($results['password']) ? $results['password'] : null
        );
        $this->render($this->set_views->profile(), 'Profile', $data);
    }

    public function update_acc()
    {
        $fullName = $this->input->post('username');
        $birthDate = $this->input->post('birthdate');
        $gender = $this->input->post('gender');
        $id = $this->session->userdata('id');

        $info = array(
            'username' => $fullName,
            'birthdate' => date('Y-m-d', strtotime($birthDate)),
            'gender' => $gender
        );

        $this->User_model->update_acc_info($info, $id);

        $results = $this->Home_model->get_db($id);
        $data = array(
            'user_id' => $results['id'],
            'imagePath' => isset($results['imagePath']) ? $results['imagePath'] : 'db/user_profile/default.jpg',
            'name' => $results['username'],
            'gender' => isset($results['gender']) ? $results['gender'] : null,
            'address' => 'null',
            'AccountStat' => isset($results['accountStat']) ? $results['accountStat'] : null,
            'age' => date('Y') - date('Y', strtotime($results['birthdate'])),
            'birthDate' => isset($results['birthdate']) ? $results['birthdate'] : null,
            'username' => isset($results['username']) ? $results['username'] : null,
            'email' => isset($results['email']) ? $results['email'] : null,
            'password' => isset($results['password']) ? $results['password'] : null
        );
        $this->render($this->set_views->profile(), 'Profile', $data);
    }
}
