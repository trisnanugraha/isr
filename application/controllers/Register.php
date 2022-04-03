<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Register extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mod_program_studi');
        $this->load->model('Mod_user');
        $this->load->model('Mod_aktivasi_user');
        $this->load->model(array('Mod_login'));
    }

    public function index()
    {
        $data['aplikasi'] = $this->Mod_login->Aplikasi()->row();
        $data['user_level'] = $this->Mod_user->userlevelRegister();
        $data['programStudi'] = $this->Mod_program_studi->get_all();
        $this->load->view('admin/register', $data);
    }

    function signup()
    {
        $this->_validate();
        $username = $this->input->post('username');
        $cek = $this->Mod_user->cekUsername($username);
        if ($cek->num_rows() > 0) {
            echo json_encode(array("error" => "Username Sudah Ada!!"));
        } else {
            $nama = slug($this->input->post('username'));
            $config['upload_path']   = './assets/foto/user/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png'; //mencegah upload backdor
            $config['max_size']      = '1000';
            $config['max_width']     = '2000';
            $config['max_height']    = '1024';
            $config['file_name']     = $nama;

            $this->upload->initialize($config);

            if ($this->upload->do_upload('imagefile')) {
                $gambar = $this->upload->data();

                $save  = array(
                    'id_prodi' => $this->input->post('prodi'),
                    'username' => $this->input->post('username'),
                    'full_name' => $this->input->post('fullname'),
                    'password'  => get_hash($this->input->post('password')),
                    'id_level'  => $this->input->post('level'),
                    'is_active' => 'N',
                    'image' => $gambar['file_name']
                );

                $id = $this->Mod_user->insertUser("tbl_user", $save);

                $pending = array(
                    'id_user' => $id->id_user
                );

                $this->Mod_aktivasi_user->insert("tbl_pending_user", $pending);

                echo json_encode(array("status" => TRUE));
            } else { //Apabila tidak ada gambar yang di upload
                $save  = array(
                    'id_prodi' => $this->input->post('prodi'),
                    'username' => $this->input->post('username'),
                    'full_name' => $this->input->post('fullname'),
                    'password'  => get_hash($this->input->post('password')),
                    'id_level'  => $this->input->post('level'),
                    'is_active' => 'N'
                );

                $id = $this->Mod_user->insertUser("tbl_user", $save);

                $pending = array(
                    'id_user' => $id
                );

                $this->Mod_aktivasi_user->insert("tbl_pending_user", $pending);
                echo json_encode(array("status" => TRUE));
            }
        }
    }

    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if ($this->input->post('fullname') == '') {
            $data['inputerror'][] = 'fullname';
            $data['error_string'][] = 'Nama Lengkap Tidak Boleh Kosong';
            $data['status'] = FALSE;
        }

        if ($this->input->post('username') == '') {
            $data['inputerror'][] = 'username';
            $data['error_string'][] = 'Nama Lengkap Tidak Boleh Kosong';
            $data['status'] = FALSE;
        }

        if ($this->input->post('prodi') == '') {
            $data['inputerror'][] = 'prodi';
            $data['error_string'][] = 'Program Studi Tidak Boleh Kosong';
            $data['status'] = FALSE;
        }

        if ($this->input->post('password') == '') {
            $data['inputerror'][] = 'password';
            $data['error_string'][] = 'Password Tidak Boleh Kosong';
            $data['status'] = FALSE;
        }

        if ($this->input->post('verifypassword') == '') {
            $data['inputerror'][] = 'verifypassword';
            $data['error_string'][] = 'Verifikasi Password Tidak Boleh Kosong';
            $data['status'] = FALSE;
        }

        if ($this->input->post('password') != '' && $this->input->post('verifypassword') != '' && $this->input->post('password') != $this->input->post('verifypassword')) {
            $data['inputerror'][] = 'verifypassword';
            $data['error_string'][] = 'Verifikasi Password Tidak Cocok Dengan Password';
            $data['status'] = FALSE;
        }

        if ($this->input->post('level') == '') {
            $data['inputerror'][] = 'level';
            $data['error_string'][] = 'Hak Akses Tidak Boleh Kosong';
            $data['status'] = FALSE;
        }

        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }
}

/* End of file Register.php */
