<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Aktivasiuser extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mod_aktivasi_user');
        $this->load->model('Mod_user');
        $this->load->model('Mod_userlevel');
    }

    public function index()
    {
        $this->_cek_status();
        $data['judul'] = 'Aktivasi User';
        $js = $this->load->view('aktivasi_user/aktivasi-user-js', null, true);
        $this->template->views('aktivasi_user/home', $data, $js);
    }

    public function ajax_list()
    {
        $this->_cek_status();
        ini_set('memory_limit', '512M');
        set_time_limit(3600);
        $list = $this->Mod_aktivasi_user->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $user) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $user->username;
            $row[] = $user->full_name;
            $row[] = $user->nama_level;
            $row[] = tgl_indonesia($user->tgl_dibuat);
            $row[] = $user->id_pending_user;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Mod_aktivasi_user->count_all(),
            "recordsFiltered" => $this->Mod_aktivasi_user->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function aktivasi()
    {
        $this->_cek_status();
        $id = $this->input->post('id_pending_user');
        $user =  $this->Mod_aktivasi_user->get_user($id);

        $this->Mod_user->update_status($user->id_user);
        $this->Mod_aktivasi_user->delete($id);
        echo json_encode(array("status" => TRUE));
    }

    private function _cek_status()
    {
        $is_login = $this->session->userdata('logged_in');
        $hak_akses = $this->session->userdata('hak_akses');
        $this->fungsi->validasiAkses($is_login, $hak_akses);
    }
}
/* End of file Aktivasiuser.php */
