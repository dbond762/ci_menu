<?php

class Admin extends CI_controller {
    public function __construct() {
        parent::__construct();

        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('menu_model');

        $this->load->library('session');
    }

    public function index() {
        $data['menu']    = $this->menu_model->get_menu();
        $data['massage'] = '';

        if ( ! $this->session->has_userdata('logged_in') ) {
            $this->load->view('header', $data);
            $this->load->view('login/login', $data);
            $this->load->view('footer');
            return;
        }

        $this->form_validation->set_rules('menu', '', 'required');

        if ( $this->form_validation->run() === FALSE ) {
            $this->load->view('admin_page', $data);
        } else {
            $menu = json_decode( $this->input->post('menu') );
            if ($menu !== NULL) {
                $this->menu_model->update_menu($menu);
            }

            redirect('admin', 'refresh');
        }

    }

    public function change_menu_item($id) {
        $data['menu']    = $this->menu_model->get_menu();
        $data['massage'] = '';

        if ( ! $this->session->has_userdata('logged_in') ) {
            $this->load->view('header', $data);
            $this->load->view('login/login', $data);
            $this->load->view('footer');
            return;
        }

        $id = intval($id);

        $data['menu_item'] = $this->menu_model->get_item($id);
        echo var_dump( $data['menu_item'] );

        $this->form_validation->set_rules('label', 'Label', 'required');
        $this->form_validation->set_rules('link', 'Link', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('admin_change_menu_item', $data);
        } else {
            $menu_item = array(
                'id'      => $id,
                'label'   => $this->input->post('label'),
                'link'    => $this->input->post('link'),
                'order'   => $this->input->post('order'),
                'parrent' => $this->input->post('parrent'),
            );

            if ($menu_item['parrent'] == 0) {
                $menu_item['parrent'] = NULL;
            }

            $this->menu_model->update_item($menu_item);
            $this->load->view('admin_page', $data);
        }
    }
}