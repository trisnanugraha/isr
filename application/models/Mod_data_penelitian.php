<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mod_data_penelitian extends CI_Model
{

    var $table = 'tbl_ajuan_penelitian';
    var $column_order = array('', 'full_name', 'judul_penelitian', 'nama_skema', 'status', 'status_reviewer');
    var $column_search = array('full_name', 'judul_penelitian', 'nama_skema', 'status', 'status_reviewer');
    var $order = array('id_ajuan_penelitian' => 'asc'); // default order 

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    private function _get_datatables_query()
    {
        $this->db->select('a.*,b.nama_skema,c.full_name');
        $this->db->join('tbl_skema_penelitian b', 'a.id_skema=b.id_skema_penelitian');
        $this->db->join('tbl_user c', 'a.id_ketua=c.id_user');
        $this->db->from('tbl_ajuan_penelitian a');
        // $this->db->from($this->table);
        $i = 0;

        foreach ($this->column_search as $item) // loop column 
        {
            if ($_POST['search']['value']) // if datatable send POST for search
            {

                if ($i === 0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if (isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables()
    {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all($id = '')
    {

        $this->db->from($this->table);
        if ($id != '') {
            $this->db->where('id_reviewer', $id);
        }
        return $this->db->count_all_results();
    }

    function getAll()
    {
        return $this->db->get($this->table);
    }

    public function count_by_priode($idPriode)
    {

        $this->db->from($this->table);
        $this->db->where('id_priode', $idPriode);
        return $this->db->count_all_results();
    }

    function get_by_priode($idPriode)
    {
        $this->db->where('id_priode', $idPriode);
        return $this->db->get($this->table);
    }

    function get_status_reviewer($id){
        $this->db->select('status_reviewer');
        $this->db->where('id_ajuan_penelitian', $id);
        return $this->db->get($this->table)->row();
    }

    function check_reviewer($id)
    {
        $this->db->select('id_reviewer');
        $this->db->where('id_ajuan_penelitian', $id);
        return $this->db->get($this->table)->row();
    }

    function get_new_data($id)
    {
        $this->db->select(
            'a.id_ajuan_penelitian,
            b.judul,
            a.judul_penelitian,
            c.nama_skema,
            d.full_name AS ketua,
            a.anggaran,
            a.lokasi,
            a.nama_jurnal,
            a.peringkat_jurnal,
            a.link_jurnal,
            a.e_issn,
            a.berkas_laporan,
            a.berkas_jurnal,
            a.status,
            a.komentar_lppm,
            a.berkas_review,
            a.tgl_dibuat,
            a.tgl_diubah,
            a.tgl_validasi_lppm,
            a.tgl_validasi_reviewer'
        );
        $this->db->join('tbl_priode b', 'a.id_priode=b.id_priode');
        $this->db->join('tbl_skema_penelitian c', 'a.id_skema=c.id_skema_penelitian');
        $this->db->join('tbl_user d', 'a.id_ketua=d.id_user');
        // $this->db->join('tbl_user e', 'a.id_reviewer=e.id_user');
        $this->db->from('tbl_ajuan_penelitian a');
        $this->db->where('a.id_ajuan_penelitian', $id);
        return $this->db->get($this->table)->row();
    }

    function get_data($id)
    {
        $this->db->select(
            'a.id_ajuan_penelitian,
            b.judul,
            a.judul_penelitian,
            c.nama_skema,
            d.full_name AS ketua,
            a.anggaran,
            a.lokasi,
            a.nama_jurnal,
            a.peringkat_jurnal,
            a.link_jurnal,
            a.e_issn,
            a.berkas_laporan,
            a.berkas_jurnal,
            a.status,
            a.komentar_lppm,
            a.id_reviewer AS reviewer,
            e.full_name AS nama_reviewer,
            a.status_reviewer,
            a.komentar_reviewer,
            a.berkas_review,
            a.tgl_dibuat,
            a.tgl_diubah,
            a.tgl_validasi_lppm,
            a.tgl_validasi_reviewer'
        );
        $this->db->join('tbl_priode b', 'a.id_priode=b.id_priode');
        $this->db->join('tbl_skema_penelitian c', 'a.id_skema=c.id_skema_penelitian');
        $this->db->join('tbl_user d', 'a.id_ketua=d.id_user');
        $this->db->join('tbl_user e', 'a.id_reviewer=e.id_user');
        $this->db->from('tbl_ajuan_penelitian a');
        $this->db->where('a.id_ajuan_penelitian', $id);
        return $this->db->get($this->table)->row();
    }

    function insert($data)
    {
        $insert = $this->db->insert($this->table, $data);
        return $insert;
    }

    function update($id, $data)
    {
        $this->db->where('id_ajuan_penelitian', $id);
        $this->db->update($this->table, $data);
    }

    function delete($id)
    {
        $this->db->where('id_ajuan_penelitian', $id);
        $this->db->delete($this->table);
    }

    function total_rows()
    {
        $data = $this->db->get($this->table);
        return $data->num_rows();
    }

    function get_anggota($id, $x)
    {
        $this->db->select(
            "b.full_name"
        );
        $this->db->join('tbl_user b', 'a.id_anggota_' . $x . '=b.id_user');
        // $this->db->join('tbl_user c', 'a.id_anggota_2=c.id_user');
        // $this->db->join('tbl_user d', 'a.id_anggota_3=d.id_user');
        // $this->db->join('tbl_user e', 'a.id_anggota_4=e.id_user');
        // $this->db->join('tbl_user f', 'a.id_anggota_5=f.id_user');
        // $this->db->join('tbl_user g', 'a.id_ketua=g.id_user');
        $this->db->from('tbl_ajuan_penelitian a');
        $this->db->where('a.id_ajuan_penelitian', $id);
        return $this->db->get($this->table)->row();
    }

    function get_priode($id)
    {
        $this->db->select(
            "b.judul"
        );
        $this->db->join('tbl_priode b', 'a.id_priode=b.id_priode');
        // $this->db->join('tbl_user c', 'a.id_anggota_2=c.id_user');
        // $this->db->join('tbl_user d', 'a.id_anggota_3=d.id_user');
        // $this->db->join('tbl_user e', 'a.id_anggota_4=e.id_user');
        // $this->db->join('tbl_user f', 'a.id_anggota_5=f.id_user');
        // $this->db->join('tbl_user g', 'a.id_ketua=g.id_user');
        $this->db->from('tbl_ajuan_penelitian a');
        $this->db->where('a.id_ajuan_penelitian', $id);
        return $this->db->get($this->table)->row();
    }
}

/* End of file Mod_ajuan_penelitian.php */
