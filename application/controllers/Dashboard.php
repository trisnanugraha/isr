<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('fungsi');
        $this->load->library('user_agent');
        $this->load->helper('myfunction_helper');
        $this->load->model('Mod_user');
        $this->load->model('Mod_userlevel');
        $this->load->model('Mod_aktivasi_user');
        $this->load->model('Mod_userlevel');
        $this->load->model('Mod_priode');
        $this->load->model('Mod_data_penelitian');
        $this->load->model('Mod_data_pkm');
        $this->load->model('Mod_kegiatan');
        $this->load->model('Mod_arsip');
        $this->load->model('Mod_dashboard');
        // backButtonHandle();
    }

    function index()
    {
        $data['judul'] = 'Dashboard';
        // $data['user'] = $this->Mod_user->total_rows();
        // $data['priode'] = $this->Mod_priode->total_rows();
        // $data['penelitian'] = $this->Mod_data_penelitian->total_rows();
        // $data['pendinguser'] = $this->Mod_aktivasi_user->total_rows();
        // $data['pkm'] = $this->Mod_data_pkm->total_rows();
        $data['kegiatan'] = $this->Mod_kegiatan->total_rows();
        $data['arsip'] = $this->Mod_arsip->total_rows();
        // $data['periode'] = $this->Mod_priode->get_data();
        // $data['dataPenelitian'] = $this->Mod_dashboard->get_total_penelitian($this->getdata());
        // $data['dataPKM'] = $this->Mod_dashboard->get_total_pkm($this->getdata());
        // $data['dataPriode'] = $this->Mod_priode->get_priode($this->getdata());
        // $data['test'] = json_encode($this->Mod_dashboard->get_total_penelitian(5));

        $logged_in = $this->session->userdata('logged_in');
        if ($logged_in != TRUE || empty($logged_in)) {
            redirect('login');
        } else {
            // $this->template->load('layoutbackend', 'dashboard/view_dashboard', $data);
            $checklevel = $this->_cek_status($this->session->userdata['id_level']);

            if ($checklevel == 'Guest') {
                $js = $this->load->view('dashboard/dashboard-js', null, true);
            } else {
                $js = $this->load->view('dashboard/dashboard-js', null, true);
                
            }$this->template->views('dashboard/home', $data, $js);
        }

        // echo json_encode($data['dataPenelitian']);
        // echo json_encode($data['dataPKM']);
    }

    function getdata()
    {
        $post = $this->input->post();
        $this->id_priode = $post['priode'];
        echo json_encode($this->id_priode = $post['priode']);
    }

    function fetch_data()
    {
        $penelitian = [];
        $pkm = [];

        $id = $_POST['idPriode'];
        // echo json_encode($id);
        if ($id != null) {
            // $penelitian = [];
            $dataPenelitian = $this->Mod_dashboard->get_total_penelitian($id);
            $dataPKM = $this->Mod_dashboard->get_total_pkm($id);
            $dataPriode = $this->Mod_priode->get_priode($id);

            foreach ($dataPenelitian->result() as $row) {
                $penelitian['nama_level'][] = $row->nama_level;
                $penelitian['total'][] = (int) $row->total;
            }

            // $data['dataPenelitian'] = json_encode($penelitian);

            // foreach ($dataPenelitian->result_array() as $row) {
            //     $output[] = array(
            //         'nama_lv'  => $row["nama_level"],
            //         'total' => $row["total"]
            //     );
            // }

            // return $penelitian;
            foreach ($dataPKM->result() as $row) {
                $penelitian['nama_level_pkm'][] = $row->nama_level;
                $penelitian['totalPKM'][] = (int) $row->total;
            }

            $penelitian['priode'][] = $dataPriode->priode;

            echo json_encode($penelitian);
            // foreach ($dataPriode->result_array() as $priode) {
            //     $output[] = array(
            //         'priode' => $priode["priode"]
            //     );
            // }


        }
        // echo json_encode($output);
    }

    private function _cek_status($id_level)
    {
        $nama_level = $this->Mod_userlevel->getUserlevel($id_level);
        return $nama_level->nama_level;
    }
}
/* End of file Dashboard.php */
