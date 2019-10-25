<?php

class Login extends CI_controller {
    public function __construct() {
        parent::__construct();

        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');

        $this->load->model('menu_model');
        $this->load->model('user_model');
    }

    public function index() {
        $data['menu']    = $this->menu_model->get_menu();
        $data['message'] = '';

        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('header', $data);
            $this->load->view('login/login', $data);
            $this->load->view('footer');
        } else {
            $name = $this->input->post('username');
            $password = $this->input->post('password');

            $user = $this->user_model->login($name, $password);
            if ( $user !== NULL ) {
                $session_data = array(
                    'name' => $user['name'],
                );
                $this->session->set_userdata('logged_in', $session_data);
                $this->load->view('admin_page', $data);
            } else {
                $data['message'] = 'Invalid Username or Password';
                $this->load->view('header', $data);
                $this->load->view('login/login', $data);
                $this->load->view('footer');
            }
        }
    }

    public function signup() {
        $data['menu']    = $this->menu_model->get_menu();
        $data['message'] = '';

        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('header', $data);
            $this->load->view('login/signup', $data);
            $this->load->view('footer');
        } else {
            $name = $this->input->post('username');
            $password = $this->input->post('password');
            if ($this->user_model->register($name, $password, TRUE)) {
                $data['message'] = 'Registration Successfully!';
                $this->load->view('header', $data);
                $this->load->view('login/login', $data);
                $this->load->view('footer');
            } else {
                $data['message'] = 'Username already exist!';
                $this->load->view('header', $data);
                $this->load->view('login/signup', $data);
                $this->load->view('footer');
            }
        }
    }

    public function logout() {
        $session_array = array(
            'name' => '',
        );
        $this->session->unset_userdata('logged_in', $session_array);

        $data['menu']    = $this->menu_model->get_menu();
        $data['message'] = 'Successfully Logout';

        $this->load->view('header', $data);
        $this->load->view('login/login', $data);
        $this->load->view('footer');
    }
}