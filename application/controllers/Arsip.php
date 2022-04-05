<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Arsip extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mod_arsip');
    }

    public function index()
    {
        $data['judul'] = 'Arsip';
        $data['modal_tambah_arsip'] = show_my_modal('arsip/modal_tambah_arsip', $data);

        $logged_in = $this->session->userdata('logged_in');
        if ($logged_in != TRUE || empty($logged_in)) {
            redirect('login');
        } else {
            $checklevel = $this->session->userdata('hak_akses');

            if ($checklevel == 'Guest') {
                $js = $this->load->view('arsip/arsip-guest-js', null, true);
                $this->template->views('arsip/home-guest', $data, $js);
            } else {
                $js = $this->load->view('arsip/arsip-js', null, true);
                $this->template->views('arsip/home', $data, $js);
            }
        }
    }

    public function ajax_list()
    {
        ini_set('memory_limit', '512M');
        set_time_limit(3600);
        $list = $this->Mod_arsip->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $arsip) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $arsip->nama_arsip;
            $row[] = $arsip->berkas_arsip;
            $row[] = $arsip->id_arsip;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Mod_arsip->count_all(),
            "recordsFiltered" => $this->Mod_arsip->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function edit($id)
    {
        $data = $this->Mod_arsip->get_data_arsip($id);
        echo json_encode($data);
    }

    public function insert()
    {
        $this->_validate();

        $post = $this->input->post();

        $this->nama_arsip = $post['nama_arsip'];

        if (!empty($_FILES['berkas_arsip']['name'])) {
            $this->berkas_arsip = $this->_uploadArsip('arsip', 'berkas_arsip', $post['nama_arsip']);
        }

        $this->Mod_arsip->insert($this);
        echo json_encode(array("status" => TRUE));
    }

    public function update()
    {
        $this->_validate();
        $id      = $this->input->post('id_arsip');
        $post = $this->input->post();

        $this->nama_arsip = $post['nama_arsip'];

        if (!empty($_FILES['berkas_arsip']['name']) && empty($post['file_arsip'])) {
            $this->berkas_arsip = $this->_uploadArsip('arsip', 'berkas_arsip', $post['nama_arsip']);
        } else if (empty($_FILES['berkas_arsip']['name']) && !empty($post['file_arsip'])) {
            $this->berkas_arsip = $post['file_arsip'];
        } else if (!empty($_FILES['berkas_arsip']['name']) && !empty($post['file_arsip'])) {
            $this->berkas_arsip = $this->_uploadArsip('arsip', 'berkas_arsip', $post['nama_arsip']);
            unlink('upload/arsip/' . $post['file_arsip']);
        } else {
            $this->berkas_arsip = null;
        }

        $this->Mod_arsip->update($id, $this);
        echo json_encode(array("status" => TRUE));
    }

    public function delete()
    {
        $id = $this->input->post('id_arsip');

        $arsip = $this->Mod_arsip->get_arsip($id)->row_array();
        if ($arsip['berkas_arsip'] != null) {
            //hapus arsip yg ada diserver
            unlink('upload/arsip/' . $arsip['berkas_arsip']);
        }

        $this->Mod_arsip->delete($id);
        echo json_encode(array("status" => TRUE));
    }

    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if ($this->input->post('nama_arsip') == '') {
            $data['inputerror'][] = 'nama_arsip';
            $data['error_string'][] = 'Nama Arsip Tidak Boleh Kosong';
            $data['status'] = FALSE;
        }

        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }

    private function _uploadArsip($folder, $target, $nama_arsip)
    {
        $format = "%Y-%M-%d--%H-%i-%s";
        $rand_num = random_string('nozero', 10);
        $config['upload_path']          = './upload/' . $folder . '/';
        $config['allowed_types']        = 'pdf|doc|docx';
        $config['overwrite']            = true;
        $config['file_name']            = $rand_num . ' - ' . $nama_arsip;

        $this->upload->initialize($config);

        if ($this->upload->do_upload($target)) {
            return $this->upload->data('file_name');
        }
    }
}

/* End of file Arsip.php */