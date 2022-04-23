<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mod_bulan extends CI_Model
{

    var $table = 'tbl_bulan';
    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function get_data()
    {
        return $this->db->get($this->table)
            ->result();
    }

    function total_rows()
    {
        $data = $this->db->get($this->table);
        return $data->num_rows();
    }
}

/* End of file Mod_bulan.php */
