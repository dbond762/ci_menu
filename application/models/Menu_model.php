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

        return $this->list_to_tree($arr);
    }

    public function update_menu($menu) {
        foreach ($menu as $menu_item) {
            $this->db->update( 'menu', $menu_item, array('id' => $menu_item->id) );
            if ( count( $menu_item->childrens ) > 0 ) {
                $this->update_menu($menu_item->childrens);
            }
        }
    }

    public function get_item($id) {
        $query = $this->db->get_where('menu', array('id' => $id));
        return $query->row_array();
    }

    public function update_item($menu_item) {
        $this->db->update('menu', $menu_item, array('id' => $menu_item['id']));
    }

    public function add_item_after($id, $label, $link) {
        $query = $this->db->get_where('menu', array('id' => $id));
        $menu_item = $query->row_array();

        $order = intval($menu_item['order']);

        $query = $this->db->where('order >', $order)->get('menu');
        $arr = $query->result_array();

        foreach ($arr as $item) {
            $item['order'] = intval($item['order']) + 1;
            $this->db->update('menu', $item, array('id' => $item['id']));
        }

        $new_item = array(
            'label'   => $label,
            'link'    => $link,
            'order'   => intval($order) + 1,
            'parrent' => $menu_item['parrent'],
        );

        $this->db->insert('menu', $new_item);
    }

    private function list_to_tree($list) {
        $map   = array();
        $roots = array();

        for ( $i = 0; $i < count( $list ); $i++ ) {
            $map[ $list[ $i ]['id'] ] = $i;
            $list[ $i ]['childrens'] = array();
        }

        for ( $i = count( $list ) - 1; $i >= 0; $i-- ) {
            $node = $list[ $i ];
            if ($node['parrent'] !== NULL) {
                array_unshift( $list[ $map[ $node['parrent'] ] ]['childrens'], $node );
            } else {
                array_unshift( $roots, $node );
            }
        }

        return $roots;
    }
}