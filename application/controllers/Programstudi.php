<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Programstudi extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mod_program_studi');
    }

    public function index()
    {
        $this->_cek_status();
        $data['judul'] = 'Program Studi';
        $data['modal_tambah_program_studi'] = show_my_modal('program_studi/modal_tambah_program_studi', $data);
        $js = $this->load->view('program_studi/program-studi-js', null, true);
        $this->template->views('program_studi/home', $data, $js);
    }

    public function ajax_list()
    {
        $this->_cek_status();
        ini_set('memory_limit', '512M');
        set_time_limit(3600);
        $list = $this->Mod_program_studi->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $prodi) {
            $cekuser = $this->Mod_program_studi->getuser($prodi->id_prodi);
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $prodi->nama_prodi;
            $row[] = $prodi->id_prodi;
            $row[] = $cekuser;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Mod_program_studi->count_all(),
            "recordsFiltered" => $this->Mod_program_studi->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function edit($id)
    {
        $this->_cek_status();
        $data = $this->Mod_program_studi->get_prodi($id);
        echo json_encode($data);
    }

    public function insert()
    {
        $this->_cek_status();
        $this->_validate();
        $save  = array(
            'nama_prodi'    => $this->input->post('nama_prodi'),
        );
        $this->Mod_program_studi->insert($save);
        echo json_encode(array("status" => TRUE));
    }

    public function update()
    {
        $this->_cek_status();
        $this->_validate();
        $id      = $this->input->post('id_prodi');
        $data  = array(
            'nama_prodi' => $this->input->post('nama_prodi'),
        );
        $this->Mod_program_studi->update($id, $data);
        echo json_encode(array("status" => TRUE));
    }

    public function delete()
    {
        $this->_cek_status();
        $id = $this->input->post('id_prodi');
        $this->Mod_program_studi->delete($id);
        echo json_encode(array("status" => TRUE));
    }

    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if ($this->input->post('nama_prodi') == '') {
            $data['inputerror'][] = 'nama_prodi';
            $data['error_string'][] = 'Nama Program Studi Tidak Boleh Kosong';
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

/* End of file ProgramStudi.php */