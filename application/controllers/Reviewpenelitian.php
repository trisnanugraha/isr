<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Reviewpenelitian extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mod_review_penelitian');
        $this->load->model('Mod_priode');
        $this->load->model('Mod_skema_penelitian');
        $this->load->model('Mod_user');
        $this->load->model('Mod_userlevel');
    }

    public function index()
    {
        $data['judul'] = "Review Penelitian";
        $data['priode'] = $this->Mod_priode->get_all();
        $data['skema'] = $this->Mod_skema_penelitian->get_all();
        $data['user'] = $this->Mod_user->get_all();
        $data['filename'] = 'Template Review.docx';
        $data['link'] = 'assets/template/Template Review.docx';
        $data['modal_detail_review_penelitian'] = show_my_modal('review_penelitian/modal_detail_review_penelitian', $data);

        $logged_in = $this->session->userdata('logged_in');
        if ($logged_in != TRUE || empty($logged_in)) {
            redirect('login');
        } else {
            $checklevel = $this->_cek_status($this->session->userdata['id_level']);
            if ($checklevel == 'Mahasiswa' || $checklevel == 'Dosen') {
                redirect('dashboarduser');
            }
            // $this->template->load('layoutbackend', 'dashboard/view_dashboard', $data);
            $js = $this->load->view('review_penelitian/review-penelitian-js', null, true);
            $this->template->views('review_penelitian/home', $data, $js);
        }
    }

    public function ajax_list()
    {
        $checklevel = $this->_cek_status($this->session->userdata['id_level']);
        if ($checklevel == 'Mahasiswa' || $checklevel == 'Dosen') {
            redirect('dashboarduser');
        }
        $id = $this->session->userdata['id_user'];
        ini_set('memory_limit', '512M');
        set_time_limit(3600);
        $list = $this->Mod_review_penelitian->get_datatables($id);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $review) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $review->full_name;
            $row[] = $review->judul_penelitian;
            $row[] = $review->nama_skema;
            $row[] = $review->status;
            $row[] = $review->status_reviewer;
            $row[] = $review->id_ajuan_penelitian;
            $row[] = $review->status_pengusul;
            if ($review->tgl_diubah == null) {
                $row[] = tgl_indonesia($review->tgl_dibuat);
            } else {
                $row[] = tgl_indonesia($review->tgl_diubah);
            }
            if ($review->tgl_validasi_lppm == null) {
                $row[] = "";
            } else {
                $row[] = tgl_indonesia($review->tgl_validasi_lppm);
            }
            if ($review->tgl_validasi_reviewer == null) {
                $row[] = "";
            } else {
                $row[] = tgl_indonesia($review->tgl_validasi_reviewer);
            }
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Mod_review_penelitian->count_all($id),
            "recordsFiltered" => $this->Mod_review_penelitian->count_filtered($id),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function edit($id)
    {
        $checklevel = $this->_cek_status($this->session->userdata['id_level']);
        if ($checklevel == 'Mahasiswa' || $checklevel == 'Dosen') {
            redirect('dashboarduser');
        }
        $data = $this->Mod_review_penelitian->get_data($id);

        $data->tgl_dibuat = tgl_indonesia($data->tgl_dibuat);
        if ($data->tgl_diubah == null) {
            $data->tgl_diubah = "-";
        } else {
            $data->tgl_diubah = tgl_indonesia($data->tgl_diubah);
        }

        if ($data->tgl_validasi_lppm == null) {
            $data->tgl_validasi_lppm = "-";
        } else {
            $data->tgl_validasi_lppm = tgl_indonesia($data->tgl_validasi_lppm);
        }

        if ($data->tgl_validasi_reviewer == null) {
            $data->tgl_validasi_reviewer = "-";
        } else {
            $data->tgl_validasi_reviewer = tgl_indonesia($data->tgl_validasi_reviewer);
        }

        echo json_encode($data);
    }

    public function update()
    {
        $checklevel = $this->_cek_status($this->session->userdata['id_level']);
        if ($checklevel == 'Mahasiswa' || $checklevel == 'Dosen') {
            redirect('dashboarduser');
        }
        $this->_validate();
        $id      = $this->input->post('id_ajuan_penelitian');
        $status_lppm = $this->Mod_review_penelitian->get_status_lppm($id);

        if (!empty($_FILES['berkasreview']['name'])) {
            $file = $this->_uploadPdf('penelitian', 'berkasreview');
        } else {
            $file = $this->input->post('filereview');
        }

        if ($status_lppm->status == "Approve" && $this->input->post('status_reviewer') == "Approve") {
            $save  = array(
                'status_reviewer' => $this->input->post('status_reviewer'),
                'komentar_reviewer' => $this->input->post('komentar_reviewer'),
                'berkas_review' => $file,
                'tgl_validasi_reviewer' => date('Y-m-d H:i:s'),
                'status_pengusul' => "Pengajuan Diterima"
            );
        } else {
            $save  = array(
                'status_reviewer' => $this->input->post('status_reviewer'),
                'komentar_reviewer' => $this->input->post('komentar_reviewer'),
                'berkas_review' => $file,
                'tgl_validasi_reviewer' => date('Y-m-d H:i:s')
            );
        }

        $this->Mod_review_penelitian->update($id, $save);
        echo json_encode(array("status" => TRUE));
    }

    public function delete()
    {
        $checklevel = $this->_cek_status($this->session->userdata['id_level']);
        if ($checklevel == 'Mahasiswa' || $checklevel == 'Dosen') {
            redirect('dashboarduser');
        }
        $id = $this->input->post('id_ajuan_penelitian');
        $this->Mod_data_penelitian->delete($id);
        echo json_encode(array("status" => TRUE));
    }

    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if ($this->input->post('status_reviewer') == '') {
            $data['inputerror'][] = 'status_reviewer';
            $data['error_string'][] = 'Status Tidak Boleh Kosong';
            $data['status'] = FALSE;
        }

        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }

    private function _uploadPdf($folder, $target)
    {
        $user = $this->session->userdata['user_name'];
        $format = "%Y-%M-%d--%H-%i";
        $config['upload_path']          = './upload/review/' . $folder . '/';
        $config['allowed_types']        = 'pdf|doc|docx';
        $config['overwrite']            = true;
        $config['file_name']            = mdate($format) . "_Hasil_Review_{$user}";

        $this->upload->initialize($config);

        if ($this->upload->do_upload($target)) {
            return $this->upload->data('file_name');
        }
    }

    private function _cek_status($id_level)
    {
        $nama_level = $this->Mod_userlevel->getUserlevel($id_level);
        return $nama_level->nama_level;
    }
}

/* End of file Reviewpenelitian.php */