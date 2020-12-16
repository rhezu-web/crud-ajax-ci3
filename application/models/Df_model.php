<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Df_model extends CI_Model
{
    function getdata($table)
    {
        return $this->db->get($table);
    }

    function get_outlet()
    {
        $query = $this->db->get('toko');
        return $query;
    }

    function insert_outlet($outlet_name, $pack, $item)
    {
        $data = array(
            'outlet' => $outlet_name,
            'pack' => $pack,
            'item' => $item
        );
        $this->db->insert('toko', $data);
    }

    function delete_outlet($id)
    {
        $this->db->delete('toko', array('id' => $id));
    }

    function update_outlet($id, $outlet, $pack, $item)
    {
        $this->db->set('outlet', $outlet);
        $this->db->set('pack', $pack);
        $this->db->set('item', $item);
        $this->db->where('id', $id);
        $this->db->update('toko');
    }
} // end Model