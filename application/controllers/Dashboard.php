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
        $this->load->model('Mod_kegiatan');
        $this->load->model('Mod_arsip');
        $this->load->model('Mod_isr');
        $this->load->model('Mod_cluster');
        $this->load->model('Mod_dashboard');
        $this->load->model('Mod_bulan');
        // backButtonHandle();
    }

    function index()
    {
        $data['judul'] = 'Dashboard';
        $data['kegiatan'] = $this->Mod_kegiatan->total_rows();
        $data['arsip'] = $this->Mod_arsip->total_rows();
        $data['isr'] = $this->Mod_isr->total_rows();
        $data['cluster'] = $this->Mod_cluster->total_rows();
        // $tahun = $this->Mod_kegiatan->get_tahun();

        // foreach ($tahun as $row) {
        //     $data = explode('-', $row['tanggal']);
        //     $th[] = $data[0];
        // }

        // echo json_encode($th);

        $data['filterTahun'] = $this->db->select('DISTINCT DATE_FORMAT(`t`.`tanggal`, "%Y") `tahun`', FALSE)->from('tbl_kegiatan `t`')->group_by('YEAR(`t`.`tanggal`)')->order_by('t.tanggal', 'DESC')->get()->result();


        // echo '<pre>';
        // print_r($data['grafik']);
        // print_r($data['filterTahun']);

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
            }
            $this->template->views('dashboard/home', $data, $js);
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
        $tahun = $_POST['tahun'];
        // echo json_encode($id);
        if ($tahun != null) {
            $data['bulan'] = $this->Mod_bulan->get_data();
            $data['tahun'] = $tahun;
            $data['grafik'] = $this->Mod_dashboard->get_grafik($tahun);

            echo json_encode($data);
 

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
