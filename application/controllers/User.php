<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class User extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mod_user');
        $this->load->model('Mod_import');
    }

    public function index()
    {
        $this->_cek_status();
        $this->load->helper('url');
        $data['judul'] = 'Manajemen User';
        $data['user'] = $this->Mod_user->getAll();
        $data['user_level'] = $this->Mod_user->userlevel();
        $data['modal_tambah_user'] = show_my_modal('user/modal_tambah_user', $data);
        $js = $this->load->view('user/user-js', null, true);
        $this->template->views('user/home', $data, $js);
    }

    public function ajax_list()
    {
        $this->_cek_status();
        ini_set('memory_limit', '512M');
        set_time_limit(3600);
        $list = $this->Mod_user->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $user) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $user->full_name;
            $row[] = $user->username;
            $row[] = $user->nama_level;
            $row[] = $user->is_active;
            $row[] = $user->id_user;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Mod_user->count_all(),
            "recordsFiltered" => $this->Mod_user->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function insert()
    {
        $this->_cek_status();
        // var_dump($this->input->post('username'));
        $this->_validate();
        $username = $this->input->post('username');
        $cek = $this->Mod_user->cekUsername($username);
        if ($cek->num_rows() > 0) {
            echo json_encode(array("error" => "Username Sudah Ada!!"));
        } else {
            $nama = slug($this->input->post('username'));
            $config['upload_path']   = './assets/foto/user/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png'; //mencegah upload backdor
            $config['max_size']      = '1000';
            $config['max_width']     = '2000';
            $config['max_height']    = '1024';
            $config['file_name']     = $nama;

            $this->upload->initialize($config);

            if ($this->upload->do_upload('imagefile')) {
                $gambar = $this->upload->data();

                $save  = array(
                    'username' => $this->input->post('username'),
                    'full_name' => $this->input->post('full_name'),
                    'password'  => get_hash($this->input->post('password')),
                    'id_level'  => $this->input->post('level'),
                    'is_active' => $this->input->post('is_active'),
                    'image' => $gambar['file_name']
                );

                $this->Mod_user->insertUser("tbl_user", $save);
                echo json_encode(array("status" => TRUE));
            } else { //Apabila tidak ada gambar yang di upload
                $save  = array(
                    'username' => $this->input->post('username'),
                    'full_name' => $this->input->post('full_name'),
                    'password'  => get_hash($this->input->post('password')),
                    'id_level'  => $this->input->post('level'),
                    'is_active' => $this->input->post('is_active')
                );

                $this->Mod_user->insertUser("tbl_user", $save);
                echo json_encode(array("status" => TRUE));
            }
        }
    }

    public function viewuser()
    {
        $this->_cek_status();
        $id = $this->input->post('id');
        $table = $this->input->post('table');
        $data['table'] = $table;
        $data['data_field'] = $this->db->field_data($table);
        $data['data_table'] = $this->Mod_user->view_user($id)->result_array();
        $this->load->view('admin/view', $data);
    }

    public function edituser($id)
    {
        $this->_cek_status();
        $data = $this->Mod_user->getUser($id);
        echo json_encode($data);
    }


    public function update()
    {
        $this->_cek_status();
        if (!empty($_FILES['imagefile']['name'])) {
            // $this->_validate();
            $id = $this->input->post('id_user');

            $nama = slug($this->input->post('username'));
            $config['upload_path']   = './assets/foto/user/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png'; //mencegah upload backdor
            $config['max_size']      = '1000';
            $config['max_width']     = '2000';
            $config['max_height']    = '1024';
            $config['file_name']     = $nama;

            $this->upload->initialize($config);

            if ($this->upload->do_upload('imagefile')) {
                $gambar = $this->upload->data();
                //Jika Password tidak kosong
                if ($this->input->post('password')) {
                    $save  = array(
                        'username' => $this->input->post('username'),
                        'full_name' => $this->input->post('full_name'),
                        'password'  => get_hash($this->input->post('password')),
                        'id_level'  => $this->input->post('level'),
                        'is_active' => $this->input->post('is_active'),
                        'image' => $gambar['file_name']
                    );
                } else { //Jika password kosong
                    $save  = array(
                        'username' => $this->input->post('username'),
                        'full_name' => $this->input->post('full_name'),
                        'id_level'  => $this->input->post('level'),
                        'is_active' => $this->input->post('is_active'),
                        'image' => $gambar['file_name']
                    );
                }


                $g = $this->Mod_user->getImage($id)->row_array();

                if ($g != null) {
                    //hapus gambar yg ada diserver
                    unlink('assets/foto/user/' . $g['image']);
                }

                $this->Mod_user->updateUser($id, $save);
                echo json_encode(array("status" => TRUE));
            } else { //Apabila tidak ada gambar yang di upload

                //Jika Password tidak kosong
                if ($this->input->post('password')) {
                    $save  = array(
                        'username' => $this->input->post('username'),
                        'full_name' => $this->input->post('full_name'),
                        'password'  => get_hash($this->input->post('password')),
                        'id_level'  => $this->input->post('level'),
                        'is_active' => $this->input->post('is_active')
                    );
                } else { //Jika password kosong
                    $save  = array(
                        'username' => $this->input->post('username'),
                        'full_name' => $this->input->post('full_name'),
                        'id_level'  => $this->input->post('level'),
                        'is_active' => $this->input->post('is_active')
                    );
                }

                $this->Mod_user->updateUser($id, $save);
                echo json_encode(array("status" => TRUE));
            }
        } else {
            // $this->_validate();
            $id_user = $this->input->post('id_user');
            if ($this->input->post('password')) {
                $save  = array(
                    'username' => $this->input->post('username'),
                    'full_name' => $this->input->post('full_name'),
                    'password'  => get_hash($this->input->post('password')),
                    'id_level'  => $this->input->post('level'),
                    'is_active' => $this->input->post('is_active')
                );
            } else {
                $save  = array(
                    'username' => $this->input->post('username'),
                    'full_name' => $this->input->post('full_name'),
                    'id_level'  => $this->input->post('level'),
                    'is_active' => $this->input->post('is_active')
                );
            }

            $this->Mod_user->updateUser($id_user, $save);
            echo json_encode(array("status" => TRUE));
        }
    }

    public function delete()
    {
        $this->_cek_status();
        $id = $this->input->post('id');
        $g = $this->Mod_user->getImage($id)->row_array();
        if ($g != null) {
            //hapus gambar yg ada diserver
            unlink('assets/foto/user/' . $g['image']);
        }
        $this->Mod_user->deleteUsers($id, 'tbl_user');
        $data['status'] = TRUE;
        echo json_encode($data);
    }

    public function reset()
    {
        $this->_cek_status();
        $id = $this->input->post('id');
        $data = array(
            'password'  => get_hash('password123')
        );
        $this->Mod_user->reset_pass($id, $data);
        $data['status'] = TRUE;
        echo json_encode($data);
    }

    public function import()
    {
        $this->_cek_status();
        $file_mimes = array('application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

        if (isset($_FILES['file']['name']) && in_array($_FILES['file']['type'], $file_mimes)) {

            $arr_file = explode('.', $_FILES['file']['name']);
            $extension = end($arr_file);

            if ($extension == 'csv') {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
            } elseif ($extension == 'xlsx') {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            } else {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
            }

            $spreadsheet = $reader->load($_FILES['file']['tmp_name']);

            $sheetData = $spreadsheet->getActiveSheet()->toArray();
            $sheetcount = count($sheetData);
            if ($sheetcount > 1) {
                for ($i = 1; $i < $sheetcount; $i++) {
                    $username = $sheetData[$i]['0'];
                    $full_name = $sheetData[$i]['1'];
                    $password = $sheetData[$i]['2'];
                    $level =  $sheetData[$i]['3'];
                    $status = $sheetData[$i]['4'];
                    $prodi = $sheetData[$i]['5'];

                    $temp_data[] = array(
                        'username' => $username,
                        'full_name' => $full_name,
                        'password' => get_hash($password),
                        'id_level' => $level,
                        'is_active' => $status,
                        'id_prodi' => $prodi
                    );
                }

                $insert = $this->Mod_import->insert($temp_data, 'tbl_user');

                if ($insert) {
                    redirect('user');
                }
            }
        }
    }

    public function download()
    {
        $this->_cek_status();
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Username');
        $sheet->setCellValue('C1', 'Full name');
        $sheet->setCellValue('D1', 'password');
        $sheet->setCellValue('E1', 'level');
        $sheet->setCellValue('F1', 'Image');
        $sheet->setCellValue('G1', 'Active');

        $user = $this->Mod_user->getAll()->result();
        $no = 1;
        $x = 2;
        foreach ($user as $row) {
            $sheet->setCellValue('A' . $x, $no++);
            $sheet->setCellValue('B' . $x, $row->username);
            $sheet->setCellValue('C' . $x, $row->full_name);
            $sheet->setCellValue('D' . $x, $row->password);
            $sheet->setCellValue('E' . $x, $row->nama_level);
            $sheet->setCellValue('F' . $x, $row->image);
            $sheet->setCellValue('G' . $x, $row->is_active);
            $x++;
        }
        $writer = new Xlsx($spreadsheet);
        $filename = 'laporan-User';

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }


    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if ($this->input->post('username') == '') {
            $data['inputerror'][] = 'username';
            $data['error_string'][] = 'Username Tidak Boleh Kosong';
            $data['status'] = FALSE;
        }

        if ($this->input->post('full_name') == '') {
            $data['inputerror'][] = 'full_name';
            $data['error_string'][] = 'Nama Lengkap Tidak Boleh Kosong';
            $data['status'] = FALSE;
        }

        if ($this->input->post('password') == '') {
            $data['inputerror'][] = 'password';
            $data['error_string'][] = 'Password Tidak Boleh Kosong';
            $data['status'] = FALSE;
        }

        if ($this->input->post('is_active') == '') {
            $data['inputerror'][] = 'is_active';
            $data['error_string'][] = 'Status Tidak Boleh Kosong';
            $data['status'] = FALSE;
        }

        if ($this->input->post('level') == '') {
            $data['inputerror'][] = 'level';
            $data['error_string'][] = 'Hak Akses Tidak Boleh Kosong';
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
}
