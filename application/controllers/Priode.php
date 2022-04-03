<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Priode extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mod_priode');
        $this->load->model('Mod_userlevel');
    }

    public function index()
    {
        $this->_cek_status();
        // $this->load->helper('url');
        $data['judul'] = "Priode";
        $data['modal_tambah_priode'] = show_my_modal('priode/modal_tambah_priode', $data);

        $js = $this->load->view('priode/priode-js', null, true);
        $this->template->views('priode/home', $data, $js);
    }

    public function ajax_list()
    {
        $this->_cek_status();
        ini_set('memory_limit', '512M');
        set_time_limit(3600);
        $list = $this->Mod_priode->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $priode) {
            $cekpenelitian = $this->Mod_priode->get_penelitian($priode->id_priode);
            $cekpkm = $this->Mod_priode->get_pkm($priode->id_priode);
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $priode->priode;
            $row[] = $priode->judul;
            $row[] = $this->fungsi->tanggalindo($priode->tgl_mulai);
            $row[] = $this->fungsi->tanggalindo($priode->tgl_akhir);
            $row[] = $priode->status;
            $row[] = $priode->id_priode;
            $row[] = $cekpenelitian;
            $row[] = $cekpkm;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Mod_priode->count_all(),
            "recordsFiltered" => $this->Mod_priode->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function edit($id)
    {
        $this->_cek_status();
        $data = $this->Mod_priode->get_priode($id);
        echo json_encode($data);
    }

    public function insert()
    {
        $this->_cek_status();
        $this->_validate();
        $data  = array(
            'priode'    => $this->input->post('priode'),
            'judul'      => $this->input->post('judul'),
            'tgl_mulai' => $this->input->post('tgl_mulai'),
            'tgl_akhir' => $this->input->post('tgl_akhir'),
            'status'    => $this->input->post('status')
        );
        $this->Mod_priode->insert($data);
        // $id_level = $this->session->userdata['id_level'];
        echo json_encode(array("status" => TRUE));
    }

    public function update()
    {
        $this->_cek_status();
        $this->_validate();
        $id      = $this->input->post('id_priode');
        $data  = array(
            'priode'    => $this->input->post('priode'),
            'judul'      => $this->input->post('judul'),
            'tgl_mulai' => $this->input->post('tgl_mulai'),
            'tgl_akhir' => $this->input->post('tgl_akhir'),
            'status'    => $this->input->post('status')
        );
        $this->Mod_priode->update($id, $data);
        echo json_encode(array("status" => TRUE));
    }

    public function delete()
    {
        $this->_cek_status();
        $id = $this->input->post('id_priode');
        $this->Mod_priode->delete($id);
        echo json_encode(array("status" => TRUE));
    }

    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if ($this->input->post('priode') == '') {
            $data['inputerror'][] = 'priode';
            $data['error_string'][] = 'Periode Tidak Boleh Kosong';
            $data['status'] = FALSE;
        }

        if ($this->input->post('judul') == '') {
            $data['inputerror'][] = 'judul';
            $data['error_string'][] = 'Judul Tidak Boleh Kosong';
            $data['status'] = FALSE;
        }

        if ($this->input->post('tgl_mulai') == '') {
            $data['inputerror'][] = 'tgl_mulai';
            $data['error_string'][] = 'Tanggal Mulai Tidak Boleh Kosong';
            $data['status'] = FALSE;
        }

        if ($this->input->post('tgl_akhir') == '') {
            $data['inputerror'][] = 'tgl_akhir';
            $data['error_string'][] = 'Tanggal Akhir Tidak Boleh Kosong';
            $data['status'] = FALSE;
        }

        if ($this->input->post('status') == '') {
            $data['inputerror'][] = 'status';
            $data['error_string'][] = 'Status Tidak Boleh Kosong';
            $data['status'] = FALSE;
        }

        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }

    private function _cek_status()
    {
        $is_login = $this->session->userdata('logged_in');
        $hak_akses = $this->session->userdata('hak_akses');
        $this->fungsi->validasiAkses($is_login, $hak_akses);
    }
}
