<?php

class Menu_model extends CI_model {
    public $id;
    public $label;
    public $link;
    public $order;
    public $is_draft;
    public $parrent;

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function create($lable, $link, $order = 0, $parrent = NULL, $is_draft = FALSE) {
        $this->label    = $label;
        $this->link     = $link;
        $this->order    = $order;
        $this->is_draft = $is_draft;
        $this->parrent  = $parrent;

        $this->db->insert('menu', $this);
    }

    public function get_menu($is_draft = FALSE) {
        $query = $this->db->order_by('order', 'ASC')->get_where('menu', array('is_draft' => $is_draft));
        $arr = $query->result_array();

        return $arr;
    }
}