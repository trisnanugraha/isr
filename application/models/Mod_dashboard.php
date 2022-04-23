<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mod_dashboard extends CI_Model
{

    function get_grafik($tahun)
    {
        return $this->db->select('DISTINCT DATE_FORMAT(`t`.`tanggal`, "%M %Y") `bulan`, COUNT(tanggal) AS total', FALSE)
        ->from('tbl_kegiatan `t`')
        ->group_by('MONTH(`t`.`tanggal`), YEAR(`t`.`tanggal`)')
        ->order_by('t.tanggal', 'DESC')
        ->where('YEAR(`t`.`tanggal`)', $tahun)
        ->get()->result();
    }
}

/* End of file Mod_dashboard.php */
