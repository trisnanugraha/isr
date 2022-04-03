<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profil extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mod_user');
    }

    function index()
    {
        $data['fullname'] = $this->session->userdata('full_name');
        $data['username'] = $this->session->userdata('user_name');
        $data['prodi'] = $this->session->userdata('prodi');
        $data['judul'] = 'Profil';
        $this->template->load('layoutbackend', 'profil/view_profil', $data);
    }
}
/* End of file Profil.php */
