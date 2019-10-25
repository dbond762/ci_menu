<?php

class Home extends CI_controller {
    public function index() {
        $this->load->model('menu_model');

        $data['menu'] = $this->menu_model->get_menu();

        $this->load->view('header', $data);
        $this->load->view('menu', $data);
        $this->load->view('content', $data);
        $this->load->view('footer', $data);
    }
}
