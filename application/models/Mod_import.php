<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mod_import extends CI_Model
{
    public function insert($data, $table)
    {
        $insert = $this->db->insert_batch($table, $data);
        if ($insert) {
            return true;
        }
    }
}
