<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mod_aktivasi_user extends CI_Model
{
    var $table = 'tbl_pending_user';
    var $column_order = array('', 'username', 'full_name', 'nama_level', 'a.tgl_dibuat');
    var $column_search = array('username', 'full_name', 'nama_level');
    var $order = array('id_pending_user' => 'asc'); // default order 

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    private function _get_datatables_query()
    {
        $this->db->select('a.*,b.username,b.full_name,c.nama_level');
        $this->db->join('tbl_user b', 'a.id_user=b.id_user');
        $this->db->join('tbl_userlevel c', 'b.id_level=c.id_level');
        $this->db->from('tbl_pending_user a');
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

    public function count_all()
    {

        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    function get_user($id)
    {
        $this->db->where("id_pending_user", $id);
        $this->db->select('id_user');
        return $this->db->get("tbl_pending_user")->row();
    }

    function insert($tabel, $data)
    {
        $insert = $this->db->insert($tabel, $data);
        return $insert;
    }

    function delete($id)
    {
        $this->db->where('id_pending_user', $id);
        $this->db->delete($this->table);
    }

    function total_rows()
    {
        $data = $this->db->get($this->table);
        return $data->num_rows();
    }
}
