<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ajuanpkm extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mod_ajuan_pkm');
        $this->load->model('Mod_priode');
        $this->load->model('Mod_skema_pkm');
        $this->load->model('Mod_user');
    }

    public function index()
    {
        $id = $this->session->userdata['id_user'];
        $data['judul'] = 'Ajuan PKM';
        $data['priode'] = $this->Mod_priode->get_all('Aktif');
        $data['skema'] = $this->Mod_skema_pkm->get_all();
        $data['user'] = $this->Mod_user->get_all_mahasiswa_dosen($id);
        $data['modal_tambah_ajuan_pkm'] = show_my_modal('ajuan_pkm/modal_tambah_ajuan_pkm', $data);

        $js = $this->load->view('ajuan_pkm/ajuan-pkm-js', null, true);
        $this->template->views('ajuan_pkm/home', $data, $js);
    }

    public function ajax_list()
    {
        $id = $this->session->userdata['id_user'];
        ini_set('memory_limit', '512M');
        set_time_limit(3600);
        $list = $this->Mod_ajuan_pkm->get_datatables($id);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $ajuan) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $ajuan->judul_pkm;
            $row[] = $ajuan->nama_skema;
            $row[] = $ajuan->status;
            $row[] = $ajuan->status_reviewer;
            $row[] = $ajuan->id_ajuan_pkm;
            $row[] = $ajuan->status_pengusul;
            if ($ajuan->tgl_diubah == null) {
                $row[] = tgl_indonesia($ajuan->tgl_dibuat);
            } else {
                $row[] = tgl_indonesia($ajuan->tgl_diubah);
            }
            if ($ajuan->tgl_validasi_lppm == null) {
                $row[] = "";
            } else {
                $row[] = tgl_indonesia($ajuan->tgl_validasi_lppm);
            }
            if ($ajuan->tgl_validasi_reviewer == null) {
                $row[] = "";
            } else {
                $row[] = tgl_indonesia($ajuan->tgl_validasi_reviewer);
            }
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Mod_ajuan_pkm->count_all($id),
            "recordsFiltered" => $this->Mod_ajuan_pkm->count_filtered($id),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function edit($id)
    {
        $data = $this->Mod_ajuan_pkm->get_ajuan($id);
        echo json_encode($data);
    }

    public function insert()
    {
        // $save = array();
        $this->_validate();
        $post = $this->input->post();
        // echo json_encode($post);

        $this->id_priode = $post['priode'];
        $this->judul_pkm = $post['judul'];
        $this->id_skema = $post['skema'];
        $this->id_ketua = $this->session->userdata['id_user'];
        if (!empty($_POST['anggota1']) && $_POST['anggota1'] != 0) {
            $this->id_anggota_1 = $post['anggota1'];
        } else {
            $this->id_anggota_1 = null;
        }
        if (!empty($_POST['anggota2']) && $_POST['anggota2'] != 0) {
            $this->id_anggota_2 = $post['anggota2'];
        } else {
            $this->id_anggota_2 = null;
        }
        if (!empty($_POST['anggota3']) && $_POST['anggota3'] != 0) {
            $this->id_anggota_3 = $post['anggota3'];
        } else {
            $this->id_anggota_3 = null;
        }
        if (!empty($_POST['anggota4']) && $_POST['anggota4'] != 0) {
            $this->id_anggota_4 = $post['anggota4'];
        } else {
            $this->id_anggota_4 = null;
        }
        if (!empty($_POST['anggota5']) && $_POST['anggota5'] != 0) {
            $this->id_anggota_5 = $post['anggota5'];
        } else {
            $this->id_anggota_5 = null;
        }
        $this->anggaran = $post['anggaran'];
        $this->lokasi = $post['lokasi'];
        $this->nama_jurnal = $post['jurnal'];
        $this->peringkat_jurnal = $post['peringkat'];
        $this->link_jurnal = $post['link'];
        $this->e_issn = $post['eissn'];
        $this->anggaran = $post['anggaran'];
        if (!empty($_FILES['berkaslaporan']['name'])) {
            $this->berkas_laporan = $this->_uploadPdf('laporan', 'berkaslaporan');
        } else {
            $this->berkas_laporan = $post['filelaporan'];
        }
        if (!empty($_FILES['berkasjurnal']['name'])) {
            $this->berkas_jurnal = $this->_uploadPdf('jurnal', 'berkasjurnal');
        } else {
            $this->berkas_jurnal = $post['filejurnal'];
        }
        $this->Mod_ajuan_pkm->insert($this);
        echo json_encode(array("status" => TRUE));
    }

    public function update()
    {
        $this->_validate();
        $id = $this->input->post('id_ajuan_pkm');
        $post = $this->input->post();

        $this->id_priode = $post['priode'];
        $this->judul_pkm = $post['judul'];
        $this->id_skema = $post['skema'];
        $this->id_ketua = $this->session->userdata['id_user'];
        if (isset($_POST['anggota1']) && $_POST['anggota1'] != 0) {
            $this->id_anggota_1 = $post['anggota1'];
        } else {
            $this->id_anggota_1 = null;
        }
        if (isset($_POST['anggota2']) && $_POST['anggota2'] != 0) {
            $this->id_anggota_2 = $post['anggota2'];
        } else {
            $this->id_anggota_2 = null;
        }
        if (isset($_POST['anggota3']) && $_POST['anggota3'] != 0) {
            $this->id_anggota_3 = $post['anggota3'];
        } else {
            $this->id_anggota_3 = null;
        }
        if (isset($_POST['anggota4']) && $_POST['anggota4'] != 0) {
            $this->id_anggota_4 = $post['anggota4'];
        } else {
            $this->id_anggota_4 = null;
        }
        if (isset($_POST['anggota5']) && $_POST['anggota5'] != 0) {
            $this->id_anggota_5 = $post['anggota5'];
        } else {
            $this->id_anggota_5 = null;
        }
        $this->anggaran = $post['anggaran'];
        $this->lokasi = $post['lokasi'];
        $this->nama_jurnal = $post['jurnal'];
        $this->peringkat_jurnal = $post['peringkat'];
        $this->link_jurnal = $post['link'];
        $this->e_issn = $post['eissn'];
        $this->anggaran = $post['anggaran'];
        if (!empty($_FILES['berkaslaporan']['name'])) {
            $this->berkas_laporan = $this->_uploadPdf('laporan', 'berkaslaporan');
        } else {
            $this->berkas_laporan = $post['filelaporan'];
        }
        if (!empty($_FILES['berkasjurnal']['name'])) {
            $this->berkas_jurnal = $this->_uploadPdf('jurnal', 'berkasjurnal');
        } else {
            $this->berkas_jurnal = $post['filejurnal'];
        }
        $this->tgl_diubah = date('Y-m-d H:i:s');
        $this->status_pengusul = "Sudah Diperbaiki";
        $this->Mod_ajuan_pkm->update($id, $this);
        echo json_encode(array("status" => TRUE));
    }

    public function detail()
    {
        $id = trim($_POST['id']);
        $data['idReviewer'] = $this->Mod_ajuan_pkm->check_reviewer($id);
        $list_anggota = array();

        for ($i = 1; $i <= 5; $i++) {
            $get_value = $this->Mod_ajuan_pkm->get_anggota($id, $i);

            if ($get_value == null || $get_value == '') {
                $list_anggota["anggota{$i}"] = null;
            } else {
                $list_anggota["anggota{$i}"] = $get_value->full_name;
            }
        }

        $data['anggota'] = $list_anggota;

        if ($data['idReviewer']->id_reviewer == '' || $data['idReviewer']->id_reviewer == null) {
            $data['dataPkm'] = $this->Mod_ajuan_pkm->get_new_data($id);
        } else {
            $data['dataPkm'] = $this->Mod_ajuan_pkm->get_data($id);
        }
        echo show_my_modal('ajuan_pkm/modal_detail_ajuan_pkm', $data);
        // echo json_encode($data['dataPkm']);
    }

    public function delete()
    {
        $id = $this->input->post('id_ajuan_pkm');
        $this->Mod_ajuan_pkm->delete($id);
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
            $data['error_string'][] = 'Priode Tidak Boleh Kosong';
            $data['status'] = FALSE;
        }

        if ($this->input->post('judul') == '') {
            $data['inputerror'][] = 'judul';
            $data['error_string'][] = 'Judul Tidak Boleh Kosong';
            $data['status'] = FALSE;
        }

        if ($this->input->post('skema') == '') {
            $data['inputerror'][] = 'skema';
            $data['error_string'][] = 'Skema Tidak Boleh Kosong';
            $data['status'] = FALSE;
        }

        if ($this->input->post('anggaran') == '') {
            $data['inputerror'][] = 'anggaran';
            $data['error_string'][] = 'Anggaran Tidak Boleh Kosong';
            $data['status'] = FALSE;
        }

        if ($this->input->post('lokasi') == '') {
            $data['inputerror'][] = 'lokasi';
            $data['error_string'][] = 'Lokasi Tidak Boleh Kosong';
            $data['status'] = FALSE;
        }

        if ($this->input->post('jurnal') == '') {
            $data['inputerror'][] = 'jurnal';
            $data['error_string'][] = 'Nama Jurnal Tidak Boleh Kosong';
            $data['status'] = FALSE;
        }

        if ($this->input->post('peringkat') == '') {
            $data['inputerror'][] = 'peringkat';
            $data['error_string'][] = 'Peringkat Jurnal Tidak Boleh Kosong';
            $data['status'] = FALSE;
        }

        if ($this->input->post('link') == '') {
            $data['inputerror'][] = 'link';
            $data['error_string'][] = 'Link Tidak Boleh Kosong';
            $data['status'] = FALSE;
        }

        if ($this->input->post('eissn') == '') {
            $data['inputerror'][] = 'eissn';
            $data['error_string'][] = 'E-ISSN Tidak Boleh Kosong';
            $data['status'] = FALSE;
        }

        // if ($this->input->post('berkaslaporan') == '') {
        //     $data['inputerror'][] = 'berkaslaporan';
        //     $data['error_string'][] = 'Berkas Laporan Tidak Boleh Kosong';
        //     $data['status'] = FALSE;
        // }

        // if ($this->input->post('berkasjurnal') == '') {
        //     $data['inputerror'][] = 'berkasjurnal';
        //     $data['error_string'][] = 'Berkas Jurnal Tidak Boleh Kosong';
        //     $data['status'] = FALSE;
        // }

        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }

    private function _uploadPdf($folder, $target)
    {
        $user = $this->session->userdata['user_name'];
        $format = "%Y-%M-%d--%H-%i";
        $config['upload_path']          = './upload/pkm/' . $folder . '/';
        $config['allowed_types']        = 'pdf|doc|docx';
        $config['overwrite']            = true;
        $config['file_name']            = mdate($format) . "_{$user}";

        $this->upload->initialize($config);

        if ($this->upload->do_upload($target)) {
            return $this->upload->data('file_name');
        }
    }
}

/* End of file Ajuanpkm.php */