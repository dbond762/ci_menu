<?php

class User_model extends CI_model {
    public $name;
    public $password;
    public $is_admin;

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function register($name, $password, $is_admin = FALSE) {
        $this->name     = $name;
        $this->password = password_hash($password, PASSWORD_BCRYPT);
        $this->is_admin = $is_admin;

        $query = $this->db->get_where('user', array('name' => $name));
        $user = $query->row_array();
        if ($user !== NULL) {
            return FALSE;
        }

        $this->db->insert('user', $this);
        return TRUE;
    }

    public function login($name, $password) {
        $query = $this->db->get_where('user', array('name' => $name));
        $user =  $query->row_array();

        if ( $user !== NULL && password_verify( $password, $user['password'] ) ) {
            return $user;
        }

        return NULL;
    }

    public function get_by_name($name) {
        $query = $this->db->get_where('user', array('name' => $name));
        return $query->row_array();
    }
}