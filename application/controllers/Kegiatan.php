<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kegiatan extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mod_kegiatan');
    }

    public function index()
    {
        $this->_cek_status();
        $data['judul'] = 'Kegiatan';
        $data['modal_tambah_kegiatan'] = show_my_modal('kegiatan/modal_tambah_kegiatan', $data);
        $js = $this->load->view('kegiatan/kegiatan-js', null, true);
        $this->template->views('kegiatan/home', $data, $js);
    }

    public function ajax_list()
    {
        $this->_cek_status();
        ini_set('memory_limit', '512M');
        set_time_limit(3600);
        $list = $this->Mod_kegiatan->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $kegiatan) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $kegiatan->judul;
            $row[] = $this->fungsi->tanggalindo($kegiatan->tanggal);
            $row[] = $kegiatan->id_kegiatan;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Mod_kegiatan->count_all(),
            "recordsFiltered" => $this->Mod_kegiatan->count_filtered(),
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

        $this->judul = $post['judul'];
        $this->tanggal = $post['tanggal'];
        $this->keterangan = $post['keterangan'];

        if (!empty($_FILES['foto']['name'])) {
            $this->foto = $this->_uploadFoto('kegiatan', 'foto');
        }

        $this->Mod_kegiatan->insert($this);
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
        $id = $this->input->post('id_kegiatan');

        $foto = $this->Mod_kegiatan->get_foto($id)->row_array();
        if ($foto != null) {
            //hapus gambar yg ada diserver
            unlink('upload/kegiatan/' . $foto['foto']);
        }

        $this->Mod_kegiatan->delete($id);
        echo json_encode(array("status" => TRUE));
    }

    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if ($this->input->post('judul') == '') {
            $data['inputerror'][] = 'judul';
            $data['error_string'][] = 'Judul Kegiatan Tidak Boleh Kosong';
            $data['status'] = FALSE;
        }

        if ($this->input->post('tanggal') == '') {
            $data['inputerror'][] = 'tanggal';
            $data['error_string'][] = 'Tanggal Kegiatan Tidak Boleh Kosong';
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

    private function _uploadFoto($folder, $target)
    {
        $format = "%Y-%M-%d--%H-%i";
        $config['upload_path']          = './upload/' . $folder . '/';
        $config['allowed_types']        = 'jpg|png';
        $config['overwrite']            = true;
        $config['file_name']            = mdate($format);

        $this->upload->initialize($config);

        if ($this->upload->do_upload($target)) {
            return $this->upload->data('file_name');
        }
    }
}

/* End of file Kegiatan.php */