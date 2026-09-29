<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Oops extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->library('Set_views');
    }

    public function index()
    {
        $this->not_found();
    }

    public function not_found()
    {
        $this->render($this->set_views->not_found(), 'Error');
    }
}
