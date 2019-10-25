<?php

class Home extends CI_controller {
    public function index() {
        $this->load->model('menu_model');
        $this->load->library('session');

        if ($this->session->has_userdata('logged_in')) {
            $user = $this->session->userdata('logged_in');
            echo var_dump($user);
        }

        $data['menu'] = $this->menu_model->get_menu();

        $this->load->view('header', $data);
        $this->load->view('content', $data);
        $this->load->view('footer');
    }
}
