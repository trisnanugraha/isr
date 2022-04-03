<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboarduser extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('fungsi');
        $this->load->library('user_agent');
        $this->load->helper('myfunction_helper');
        $this->load->model('Mod_user');
        $this->load->model('Mod_aktivasi_user');
        $this->load->model('Mod_userlevel');
        $this->load->model('Mod_priode');
        $this->load->model('Mod_ajuan_penelitian');
        $this->load->model('Mod_ajuan_pkm');
        $this->load->model('Mod_dashboard');
        // backButtonHandle();
    }

    function index()
    {
        $id = $this->session->userdata('id_user');
        $data['judul'] = 'Dashboard';
        $data['penelitian'] = $this->Mod_ajuan_penelitian->count_all($id);
        $data['pkm'] = $this->Mod_ajuan_pkm->count_all($id);
        // $data['dataPenelitian'] = $this->Mod_dashboard->get_total_penelitian($this->getdata());
        // $data['dataPKM'] = $this->Mod_dashboard->get_total_pkm($this->getdata());
        // $data['dataPriode'] = $this->Mod_priode->get_priode($this->getdata());
        // $data['test'] = json_encode($this->Mod_dashboard->get_total_penelitian(5));

        $logged_in = $this->session->userdata('logged_in');
        if ($logged_in != TRUE || empty($logged_in)) {
            redirect('login');
        } else {
            // $this->template->load('layoutbackend', 'dashboard/view_dashboard', $data);
            $js = $this->load->view('dashboard_user/dashboard-js', null, true);
            $this->template->views('dashboard_user/home', $data, $js);
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
}
/* End of file Dashboarduser.php */
