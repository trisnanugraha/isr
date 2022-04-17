<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cluster extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mod_cluster');
    }

    public function index()
    {
        $data['judul'] = 'Cluster';
        $data['modal_tambah_cluster'] = show_my_modal('cluster/modal_tambah_cluster', $data);

        $logged_in = $this->session->userdata('logged_in');
        if ($logged_in != TRUE || empty($logged_in)) {
            redirect('login');
        } else {
            $checklevel = $this->session->userdata('hak_akses');

            if ($checklevel == 'Guest') {
                $js = $this->load->view('cluster/cluster-guest-js', null, true);
                $this->template->views('cluster/home-guest', $data, $js);
            } else {
                $js = $this->load->view('cluster/cluster-js', null, true);
                $this->template->views('cluster/home', $data, $js);
            }
        }
    }

    public function ajax_list()
    {
        ini_set('memory_limit', '512M');
        set_time_limit(3600);
        $list = $this->Mod_cluster->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $cluster) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $cluster->nama_cluster;
            $row[] = $cluster->id_cluster;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Mod_cluster->count_all(),
            "recordsFiltered" => $this->Mod_cluster->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function edit($id)
    {
        $data = $this->Mod_cluster->get_cluster($id);
        echo json_encode($data);
    }

    public function insert()
    {
        $this->_validate();

        $post = $this->input->post();

        $this->nama_cluster = $post['nama_cluster'];

        $this->Mod_cluster->insert($this);
        echo json_encode(array("status" => TRUE));
    }

    public function update()
    {
        $this->_validate();
        $id      = $this->input->post('id_cluster');
        $post = $this->input->post();

        $this->nama_cluster = $post['nama_cluster'];

        $this->Mod_cluster->update($id, $this);
        echo json_encode(array("status" => TRUE));
    }

    public function delete()
    {
        $id = $this->input->post('id_cluster');

        $this->Mod_cluster->delete($id);
        echo json_encode(array("status" => TRUE));
    }

    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if ($this->input->post('nama_cluster') == '') {
            $data['inputerror'][] = 'nama_cluster';
            $data['error_string'][] = 'Nama Cluster Tidak Boleh Kosong';
            $data['status'] = FALSE;
        }

        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }
}

/* End of file Cluster.php */