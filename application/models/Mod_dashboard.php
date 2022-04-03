<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mod_dashboard extends CI_Model
{

    // function get_total_penelitian($idPriode)
    // {
    //     $penelitian = $this->_get_penelitian($idPriode);
    //     $pkm = $this->_get_pkm($idPriode);

    //     $query = $penelitian;
    //     $query += $pkm;

    //     return $query;
    // }

    // function get_total_pkm($idPriode)
    // {
    //     $this->db->group_by(['a.nama_level', 'd.priode']);
    //     $this->db->select([
    //         'a.nama_level AS nama_level',
    //         'd.priode',
    //         'COUNT(c.id_ajuan_pkm) AS total_pkm',
    //         // 'COUNT(e.id_ajuan_pkm) AS total_pkm'
    //     ]);
    //     return $this->db->from('tbl_userlevel AS a')
    //         ->join('tbl_user b', 'b.id_level = a.id_level')
    //         ->join('tbl_ajuan_pkm c', 'c.id_ketua = b.id_user')
    //         ->join('tbl_priode d', 'd.id_priode = c.id_priode')
    //         // ->join('tbl_ajuan_pkm e', 'e.id_ketua = b.id_user')
    //         ->where('d.id_priode', $idPriode)
    //         ->get()
    //         ->result();
    // }

    function _get_penelitian($idPriode)
    {
        $this->db->group_by(['a.nama_level', 'd.priode']);
        $this->db->select([
            'a.nama_level',
            'd.priode',
            'COUNT(c.id_ajuan_penelitian) AS total_penelitian',
            // 'COUNT(e.id_ajuan_pkm) AS total_pkm'
        ]);
        return $this->db->from('tbl_userlevel AS a')
            ->join('tbl_user b', 'b.id_level = a.id_level')
            ->join('tbl_ajuan_penelitian c', 'c.id_ketua = b.id_user')
            ->join('tbl_priode d', 'd.id_priode = c.id_priode')
            // ->join('tbl_ajuan_pkm e', 'e.id_ketua = b.id_user')
            ->where('d.id_priode', $idPriode)
            ->get()
            ->result();
    }

    function _get_pkm($idPriode)
    {
        $this->db->group_by(['a.nama_level', 'd.priode']);
        $this->db->select([
            'a.nama_level',
            'd.priode',
            'COUNT(c.id_ajuan_pkm) AS total_pkm',
            // 'COUNT(e.id_ajuan_pkm) AS total_pkm'
        ]);
        return $this->db->from('tbl_userlevel AS a')
            ->join('tbl_user b', 'b.id_level = a.id_level')
            ->join('tbl_ajuan_pkm c', 'c.id_ketua = b.id_user')
            ->join('tbl_priode d', 'd.id_priode = c.id_priode')
            // ->join('tbl_ajuan_pkm e', 'e.id_ketua = b.id_user')
            ->where('d.id_priode', $idPriode)
            ->get()
            ->result();
    }

    function get_total_penelitian($idPriode)
    {
        $this->db->group_by(['a.nama_level', 'd.priode']);
        $this->db->select([
            'a.nama_level',
            'd.priode',
            'COUNT(c.id_ajuan_penelitian) AS total'
        ]);
        return $this->db->from('tbl_userlevel AS a')
            ->join('tbl_user b', 'b.id_level = a.id_level')
            ->join('tbl_ajuan_penelitian c', 'c.id_ketua = b.id_user')
            ->join('tbl_priode d', 'd.id_priode = c.id_priode')
            ->where('d.id_priode', $idPriode)
            ->get();
            // ->result();
    }

    function get_total_pkm($idPriode)
    {
        $this->db->group_by(['a.nama_level', 'd.priode']);
        $this->db->select([
            'a.nama_level',
            'd.priode',
            'COUNT(c.id_ajuan_pkm) AS total'
        ]);
        return $this->db->from('tbl_userlevel AS a')
            ->join('tbl_user b', 'b.id_level = a.id_level')
            ->join('tbl_ajuan_pkm c', 'c.id_ketua = b.id_user')
            ->join('tbl_priode d', 'd.id_priode = c.id_priode')
            ->where('d.id_priode', $idPriode)
            ->get();
        // ->result();
    }
}

/* End of file Mod_dashboard.php */
