<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mod_detail_isr extends CI_Model
{
    var $table = 'tbl_detail_isr';

    function insert($data)
    {
        $insert = $this->db->insert($this->table, $data);
        return $insert;
    }

    function get_data_detail_isr($id)
    {
        $this->db->select('*');
        $this->db->from("{$this->table} a");
        $this->db->where('id_isr', $id);
        return $this->db->get()->result();
    }

    function update($id, $data)
    {
        $this->db->where('id_detail_isr', $id);
        $this->db->update($this->table, $data);
    }

    function delete($id)
    {
        $this->db->where('id_detail_isr', $id);
        $this->db->delete($this->table);
    }
}

/* End of file Mod_detail_isr.php */
