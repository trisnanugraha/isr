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
        $data['judul'] = 'Kegiatan';
        $data['modal_tambah_kegiatan'] = show_my_modal('kegiatan/modal_tambah_kegiatan', $data);

        $logged_in = $this->session->userdata('logged_in');
        if ($logged_in != TRUE || empty($logged_in)) {
            redirect('login');
        } else {
            $checklevel = $this->session->userdata('hak_akses');

            if ($checklevel == 'Guest') {
                $js = $this->load->view('kegiatan/kegiatan-guest-js', null, true);
                $this->template->views('kegiatan/home-guest', $data, $js);
            } else {
                $js = $this->load->view('kegiatan/kegiatan-js', null, true);
                $this->template->views('kegiatan/home', $data, $js);
            }
        }
    }

    public function ajax_list()
    {
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
        $data = $this->Mod_kegiatan->get_kegiatan($id);
        echo json_encode($data);
    }

    public function insert()
    {
        $this->_validate();

        $post = $this->input->post();

        $this->judul = $post['judul'];
        $this->tanggal = $post['tanggal'];
        $this->keterangan = $post['keterangan'];

        if (!empty($_FILES['foto']['name'])) {
            $this->foto = $this->_uploadFoto('kegiatan', 'foto');
        }

        if (!empty($_FILES['foto2']['name'])) {
            $this->foto2 = $this->_uploadFoto('kegiatan', 'foto2');
        }

        if (!empty($_FILES['foto3']['name'])) {
            $this->foto3 = $this->_uploadFoto('kegiatan', 'foto3');
        }

        $this->Mod_kegiatan->insert($this);
        echo json_encode(array("status" => TRUE));
    }

    public function update()
    {
        $this->_validate();
        $id      = $this->input->post('id_kegiatan');
        $post = $this->input->post();

        $this->judul = $post['judul'];
        $this->tanggal = $post['tanggal'];
        $this->keterangan = $post['keterangan'];

        if (!empty($_FILES['foto']['name']) && empty($post['fileFoto1'])) {
            $this->foto = $this->_uploadFoto('kegiatan', 'foto');
        } else if (empty($_FILES['foto']['name']) && !empty($post['fileFoto1'])) {
            $this->foto = $post['fileFoto1'];
        } else if (!empty($_FILES['foto']['name']) && !empty($post['fileFoto1'])) {
            $this->foto = $this->_uploadFoto('kegiatan', 'foto');
            unlink('upload/kegiatan/' . $post['fileFoto1']);
        } else {
            $this->foto = null;
        }

        if (!empty($_FILES['foto2']['name']) && empty($post['fileFoto2'])) {
            $this->foto2 = $this->_uploadFoto('kegiatan', 'foto2');
        } else if (empty($_FILES['foto2']['name']) && !empty($post['fileFoto2'])) {
            $this->foto2 = $post['fileFoto2'];
        } else if (!empty($_FILES['foto2']['name']) && !empty($post['fileFoto2'])) {
            $this->foto2 = $this->_uploadFoto('kegiatan', 'foto2');
            unlink('upload/kegiatan/' . $post['fileFoto2']);
        } else {
            $this->foto2 = null;
        }

        if (!empty($_FILES['foto3']['name']) && empty($post['fileFoto3'])) {
            $this->foto3 = $this->_uploadFoto('kegiatan', 'foto3');
        } else if (empty($_FILES['foto3']['name']) && !empty($post['fileFoto3'])) {
            $this->foto3 = $post['fileFoto3'];
        } else if (!empty($_FILES['foto3']['name']) && !empty($post['fileFoto3'])) {
            $this->foto3 = $this->_uploadFoto('kegiatan', 'foto3');
            unlink('upload/kegiatan/' . $post['fileFoto3']);
        } else {
            $this->foto3 = null;
        }

        $this->Mod_kegiatan->update($id, $this);
        echo json_encode(array("status" => TRUE));
    }

    public function detail()
    {
        $id = trim($_POST['id_kegiatan']);
        $data = $this->Mod_kegiatan->get_kegiatan($id);

        echo show_my_modal('kegiatan/modal_detail_kegiatan', $data);
    }

    public function delete()
    {
        $id = $this->input->post('id_kegiatan');

        $data = $this->Mod_kegiatan->get_foto($id)->row_array();
        if ($data['foto'] != null) {
            //hapus gambar yg ada diserver
            unlink('upload/kegiatan/' . $data['foto']);
        }
        if ($data['foto2'] != null) {
            //hapus gambar yg ada diserver
            unlink('upload/kegiatan/' . $data['foto2']);
        }
        if ($data['foto3'] != null) {
            //hapus gambar yg ada diserver
            unlink('upload/kegiatan/' . $data['foto3']);
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

    private function _uploadFoto($folder, $target)
    {
        $format = "%Y-%M-%d--%H-%i";
        $rand_num = random_string('nozero', 10);
        $config['upload_path']          = './upload/' . $folder . '/';
        $config['allowed_types']        = 'jpg|png';
        $config['overwrite']            = true;
        $config['file_name']            = $rand_num . ' - ' . mdate($format);

        $this->upload->initialize($config);

        if ($this->upload->do_upload($target)) {
            return $this->upload->data('file_name');
        }
    }
}

/* End of file Kegiatan.php */