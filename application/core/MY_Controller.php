<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{

    public $template = array();
    public $data = array();
    public $middle = '';
    public $render_data = '';
    private $admin_data = array();

    function __construct()
    {
        parent::__construct();

        // Default initialization
        $this->data['message'] = '';
        $this->load->helper(array('form', 'language', 'url', 'date'));
        $this->data['admin_data'] = NULL;
    }

    /**
     * Render method to load views with optional data
     *
     * @param string $middleParam Middle view file path
     * @param string $title Page title
     * @param array $data Custom data array (optional)
     */
    public function render($middleParam = '', $title = '', $data = [])
    {
        // Fallback to default middle if not provided
        $middleParam = $middleParam ?: $this->middle;

        // Use the provided $data array or fallback to the default $this->data
        $data = array_merge($this->data, $data);

        // Prepare template components
        $this->template['title'] = $title;
        $this->template['headerscripts'] = $this->load->view('Home/HeaderScripts.php', $data, true);
        $this->template['header'] = $this->load->view('Home/HeaderNavigation.php', $data, true);
        $this->template['middle'] = $this->load->view($middleParam . '.php', $data, true);
        $this->template['footer'] = $this->load->view('Home/FooterNavigation.php', $data, true);
        $this->template['endlinks'] = $this->load->view('Home/FooterScripts.php', $data, true);

        // Load the main layout with the template
        $this->load->view('Layout/Front', $this->template);
    }

    public function render_login($middleParam = '', $title = '', $data = [])
    {
        $middleParam = $middleParam ?: $this->middle;
        $data = array_merge($this->data, $data);

        $this->template['title'] = $title;
        $this->template['headerscripts'] = $this->load->view('Login/HeaderScripts.php', $data, true);
        $this->template['middle'] = $this->load->view($middleParam . '.php', $data, true);
        $this->template['footerscripts'] = $this->load->view('Login/FooterScripts.php', $data, true);

        $this->load->view('Layout/LoginFront', $this->template);
    }

    public function render_booking($middleParam = '', $title = '', $data = [])
    {
        $middleParam = $middleParam ?: $this->middle;
        $data = array_merge($this->data, $data);

        $this->template['title'] = $title;
        $this->template['headerscripts'] = $this->load->view('Booking/HeaderScripts.php', $data, true);
        $this->template['middle'] = $this->load->view($middleParam . '.php', $data, true);
        $this->template['footerscripts'] = $this->load->view('Booking/FooterScripts.php', $data, true);

        $this->load->view('Layout/BookingFront', $this->template);
    }

    public function render_admin_login($middleParam = '', $title = '', $data = [])
    {
        $middleParam = $middleParam ?: $this->middle;
        $data = array_merge($this->data, $data);

        $this->template['title'] = $title;
        $this->template['headerscripts'] = $this->load->view('Admin/Login_HeaderScripts.php', $data, true);
        $this->template['middle'] = $this->load->view($middleParam . '.php', $data, true);
        $this->template['footerscripts'] = $this->load->view('Admin/Login_FooterScripts.php', $data, true);

        $this->load->view('Layout/AdminLoginFront', $this->template);
    }

    public function render_admin($middleParam = '', $title = '', $data = [])
    {
        $middleParam = $middleParam ?: $this->middle;
        $data = array_merge($this->data, $data);

        $this->template['title'] = $title;
        $this->template['headerscripts'] = $this->load->view('Admin/HeaderScripts.php', $data, true);
        $this->template['headernavigation'] = $this->load->view('Admin/HeaderNavigation.php', $data, true);
        $this->template['middle'] = $this->load->view($middleParam . '.php', $data, true);

        $this->load->view('Layout/AdminFront', $this->template);
    }
}
