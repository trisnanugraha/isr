<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Userlevel extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mod_userlevel');
        $this->load->helper('url');
    }

    public function index()
    {
        $this->_cek_status();
        $data['judul'] = 'Hak Akses';
        $data['user_level'] = $this->Mod_userlevel->getAll();
        $data['modal_tambah_hak_akses'] = show_my_modal('hak_akses/modal_tambah_hak_akses', $data);
        $js = $this->load->view('hak_akses/hak-akses-js', null, true);
        $this->template->views('hak_akses/home', $data, $js);
    }

    public function ajax_list()
    {
        $this->_cek_status();
        ini_set('memory_limit', '512M');
        set_time_limit(3600);
        $list = $this->Mod_userlevel->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $level) {
            $cekuser = $this->Mod_userlevel->getuser($level->id_level);
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $level->nama_level;
            $row[] = $level->id_level;
            $row[] = $cekuser;
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Mod_userlevel->count_all(),
            "recordsFiltered" => $this->Mod_userlevel->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function view()
    {
        $this->_cek_status();
        $id = $this->input->post('id');
        $table = $this->input->post('table');
        $data['table'] = $table;
        $data['data_field'] = $this->db->field_data($table);
        $data['data_table'] = $this->Mod_userlevel->view($id)->result_array();
        $this->load->view('admin/view', $data);
    }

    public function insert()
    {
        $this->_cek_status();
        $this->_validate();
        $save  = array(
            'nama_level' => $this->input->post('nama_level')
        );
        $this->Mod_userlevel->insertlevel("tbl_userlevel", $save);
        echo json_encode(array("status" => TRUE));

        $nama_level = $this->input->post('nama_level');
        $idlevel = $this->Mod_userlevel->getId($nama_level);
        $id = $idlevel->id_level;
        $menus = $this->Mod_userlevel->getMenu()->result();

        // Insert Akses Menu
        foreach ($menus as $key) {
            $idmenu = intval($key->id_menu);
            $datamenu = array(
                'id_level' => $id,
                'id_menu' => $idmenu,
                'view_level' => 'N',
            );
            $this->Mod_userlevel->insert_akses_menu('tbl_akses_menu', $datamenu);
        }

        $submenus = $this->db->get('tbl_submenu')->result();
        foreach ($submenus as $submenu) {
            $datasubmenu = array(
                'id'    => '',
                'id_level'  => $id,
                'id_submenu'   => $submenu->id_submenu,
                'view_level' => 'N',
                'add_level'  => 'N',
                'edit_level' => 'N',
                'delete_level' => 'N',
                'print_level'  => 'N',
                'upload_level' => 'N'
            );
            $this->db->insert('tbl_akses_submenu', $datasubmenu);
        }
    }

    public function edit($id)
    {
        $this->_cek_status();
        $data = $this->Mod_userlevel->getUserlevel($id);
        echo json_encode($data);
    }

    public function update()
    {
        $this->_cek_status();
        $this->_validate();
        $id = $this->input->post('id_level');
        $save  = array(
            'nama_level' => $this->input->post('nama_level')
        );

        $this->Mod_userlevel->update($id, $save);
        echo json_encode(array("status" => TRUE));
    }

    public function delete()
    {
        $this->_cek_status();
        $id = $this->input->post('id');
        $this->Mod_userlevel->delete($id, 'tbl_userlevel');
        $this->Mod_userlevel->deleteakses($id, 'tbl_akses_menu');
        $this->Mod_userlevel->deleteaksessubmenu($id, 'tbl_akses_submenu');
        $data['status'] = TRUE;
        echo json_encode($data);
    }

    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if ($this->input->post('nama_level') == '') {
            $data['inputerror'][] = 'nama_level';
            $data['error_string'][] = 'Nama Level Tidak Boleh Kosong';
            $data['status'] = FALSE;
        }

        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }

    public function view_akses_menu()
    {
        $this->_cek_status();
        $id = $this->input->post('id');
        $data['data_menu'] = $this->Mod_userlevel->view_akses_menu($id)->result();
        $data['data_submenu'] = $this->Mod_userlevel->akses_submenu($id)->result();
        $this->load->view('hak_akses/view_akses_menu', $data);
    }

    public function update_akses()
    {
        $this->_cek_status();
        $chek = $this->input->post('chek');
        $id = $this->input->post('id');
        if ($chek == 'checked') {
            $up = array(
                'view_level' => 'N'
            );
        } else {
            $up = array(
                'view_level' => 'Y'
            );
        }
        $this->Mod_userlevel->update_aksesmenu($id, $up);
        echo json_encode(array("status" => TRUE));
    }

    public function view_akses_submenu()
    {
        $this->_cek_status();
        $id = $this->input->post('id');
        $data['data_submenu'] = $this->Mod_userlevel->akses_submenu($id)->result();
        $this->load->view('admin/view_akses_submenu', $data);
    }
    public function view_akses()
    {
        $this->_cek_status();
        $chek = $this->input->post('chek');
        $id = $this->input->post('id');
        if ($chek == 'checked') {
            $data = array(
                'view_level' => 'N'
            );
        } else {
            $data = array(
                'view_level' => 'Y'
            );
        }
        $this->Mod_userlevel->update_akses_submenu($id, $data);
        echo json_encode(array("status" => TRUE));
    }

    public function add_akses()
    {
        $this->_cek_status();
        $chek = $this->input->post('chek');
        $id = $this->input->post('id');
        var_dump($id);
        if ($chek == 'checked') {
            $data = array(
                'add_level' => 'N'
            );
        } else {
            $data = array(
                'add_level' => 'Y'
            );
        }
        $this->Mod_userlevel->update_akses_submenu($id, $data);
        echo json_encode(array("status" => TRUE));
    }

    public function edit_akses()
    {
        $this->_cek_status();
        $chek = $this->input->post('chek');
        $id = $this->input->post('id');
        var_dump($id);
        if ($chek == 'checked') {
            $data = array(
                'edit_level' => 'N'
            );
        } else {
            $data = array(
                'edit_level' => 'Y'
            );
        }
        $this->Mod_userlevel->update_akses_submenu($id, $data);
        echo json_encode(array("status" => TRUE));
    }

    public function delete_akses()
    {
        $this->_cek_status();
        $chek = $this->input->post('chek');
        $id = $this->input->post('id');
        var_dump($id);
        if ($chek == 'checked') {
            $data = array(
                'delete_level' => 'N'
            );
        } else {
            $data = array(
                'delete_level' => 'Y'
            );
        }
        $this->Mod_userlevel->update_akses_submenu($id, $data);
        echo json_encode(array("status" => TRUE));
    }

    public function print_akses()
    {
        $this->_cek_status();
        $chek = $this->input->post('chek');
        $id = $this->input->post('id');
        var_dump($id);
        if ($chek == 'checked') {
            $data = array(
                'print_level' => 'N'
            );
        } else {
            $data = array(
                'print_level' => 'Y'
            );
        }
        $this->Mod_userlevel->update_akses_submenu($id, $data);
        echo json_encode(array("status" => TRUE));
    }

    public function upload_akses()
    {
        $this->_cek_status();
        $chek = $this->input->post('chek');
        $id = $this->input->post('id');
        var_dump($id);
        if ($chek == 'checked') {
            $data = array(
                'upload_level' => 'N'
            );
        } else {
            $data = array(
                'upload_level' => 'Y'
            );
        }
        $this->Mod_userlevel->update_akses_submenu($id, $data);
        echo json_encode(array("status" => TRUE));
    }

    private function _cek_status()
    {
        $is_login = $this->session->userdata('logged_in');
        $hak_akses = $this->session->userdata('hak_akses');
        $this->fungsi->validasiAkses($is_login, $hak_akses);
    }
}
