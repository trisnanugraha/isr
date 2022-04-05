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
        $this->_cek_status();
        $data['judul'] = 'Arsip';
        $data['modal_tambah_arsip'] = show_my_modal('arsip/modal_tambah_arsip', $data);
        $js = $this->load->view('arsip/arsip-js', null, true);
        $this->template->views('arsip/home', $data, $js);
    }

    public function ajax_list()
    {
        $this->_cek_status();
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
        $this->_cek_status();
        $data = $this->Mod_kegiatan->get_kegiatan($id);
        echo json_encode($data);
    }

    public function insert()
    {
        // $this->_cek_status();
        $this->_validate();

        $post = $this->input->post();

        $this->nama_arsip = $post['nama_arsip'];

        if (!empty($_FILES['berkas_arsip']['name'])) {
            $this->berkas_arsip = $this->_uploadArsip('arsip', 'berkas_arsip');
        }

        $this->Mod_arsip->insert($this);
        echo json_encode(array("status" => TRUE));
    }

    public function update()
    {
        // $this->_cek_status();
        $this->_validate();
        $id      = $this->input->post('id_kegiatan');
        $data  = array(
            'judul'         => $this->input->post('judul'),
            'tanggal'       => $this->input->post('tanggal'),
            'keterangan'    => $this->input->post('keterangan'),
        );
        $this->Mod_kegiatan->update($id, $data);
        echo json_encode(array("status" => TRUE));
    }

    public function delete()
    {
        $this->_cek_status();
        $id = $this->input->post('id_arsip');

        $arsip = $this->Mod_arsip->get_arsip($id)->row_array();
        if ($arsip != null) {
            //hapus gambar yg ada diserver
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

    private function _cek_status()
    {
        $is_login = $this->session->userdata('logged_in');
        $hak_akses = $this->session->userdata('hak_akses');
        $this->fungsi->validasiAkses($is_login, $hak_akses);
    }

    private function _uploadArsip($folder, $target)
    {
        $format = "%Y-%M-%d--%H-%i-%s";
        $config['upload_path']          = './upload/' . $folder . '/';
        $config['allowed_types']        = 'pdf|doc|docx';
        $config['overwrite']            = true;
        $config['file_name']            = mdate($format);

        $this->upload->initialize($config);

        if ($this->upload->do_upload($target)) {
            return $this->upload->data('file_name');
        }
    }
}

/* End of file Kegiatan.php */