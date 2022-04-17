<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Isr extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mod_isr');
        $this->load->model('Mod_detail_isr');
        $this->load->model('Mod_cluster');
    }

    public function index()
    {
        $data['judul'] = 'ISR';
        $data['cluster'] = $this->Mod_cluster->get_all();
        $data['modal_tambah_isr'] = show_my_modal('isr/modal_tambah_isr', $data);

        $logged_in = $this->session->userdata('logged_in');
        if ($logged_in != TRUE || empty($logged_in)) {
            redirect('login');
        } else {
            $checklevel = $this->session->userdata('hak_akses');

            if ($checklevel == 'Guest') {
                $js = $this->load->view('isr/isr-guest-js', null, true);
                $this->template->views('isr/home-guest', $data, $js);
            } else {
                $js = $this->load->view('isr/isr-js', null, true);
                $this->template->views('isr/home', $data, $js);
            }
        }
    }

    public function ajax_list()
    {
        ini_set('memory_limit', '512M');
        set_time_limit(3600);
        $list = $this->Mod_isr->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $isr) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $isr->induk_isr;
            $row[] = $isr->nama_cluster;
            $row[] = $isr->id_isr;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Mod_isr->count_all(),
            "recordsFiltered" => $this->Mod_isr->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function edit($id)
    {
        $data['isr'] = $this->Mod_isr->get_data_isr($id);
        $data['isrDetail'] = $this->Mod_detail_isr->get_data_detail_isr($id);
        $data['total'] = count($data['isrDetail']);

        echo json_encode($data);
    }

    public function insert()
    {
        $this->_validate();

        $save = array(
            'induk_isr' => $this->input->post('induk_isr'),
            'id_cluster' => $this->input->post('cluster')
        );

        $get_id_isr = $this->Mod_isr->insert($save);

        if ($this->input->post('site_id') != null) {
            $count = count($this->input->post('site_id'));

            if ($count > 0) {
                for ($i = 0; $i < $count; $i++) {
                    // $id_detail_isr = $this->input->post('id_detail_isr');
                    $site_id = $this->input->post('site_id');
                    $rr = $this->input->post('rr');
                    $apl_id = $this->input->post('apl_id');
                    $isr_tx = $this->input->post('isr_tx');
                    $isr_rx = $this->input->post('isr_rx');
                    $actual_tx = $this->input->post('actual_tx');
                    $actual_rx = $this->input->post('actual_rx');
                    $dataISR = array(
                        'id_isr' => $get_id_isr,
                        'site_id' => $site_id[$i],
                        'rr' => $rr[$i],
                        'apl_id' => $apl_id[$i],
                        'isr_tx' => $isr_tx[$i],
                        'isr_rx' => $isr_rx[$i],
                        'actual_tx' => $actual_tx[$i],
                        'actual_rx' => $actual_rx[$i],
                    );
                    $this->Mod_detail_isr->insert($dataISR);
                }
            }
        }

        echo json_encode(array("status" => TRUE));
    }

    public function update()
    {
        $id = $this->input->post('id_isr');
        $save = array(
            'induk_isr' => $this->input->post('induk_isr'),
            'id_cluster' => $this->input->post('cluster')
        );

        $this->Mod_isr->update($id, $save);


        if ($this->input->post('delete_data') != null) {
            $count_delete_data = count($this->input->post('delete_data'));
            $delete_id = $this->input->post('delete_data');
            for ($i = 0; $i < $count_delete_data; $i++) {
                $this->Mod_detail_isr->delete($delete_id[$i]);
            }
        }

        if ($this->input->post('site_id') != null) {
            $count = count($this->input->post('site_id'));
            if ($this->input->post('id_detail_isr') != null) {
                $count_id = count($this->input->post('id_detail_isr'));
                $new_data = $count - $count_id;

                if ($new_data == 0) {
                    for ($i = 0; $i < $count; $i++) {
                        $id_detail_isr = $this->input->post('id_detail_isr');
                        $site_id = $this->input->post('site_id');
                        $rr = $this->input->post('rr');
                        $apl_id = $this->input->post('apl_id');
                        $isr_tx = $this->input->post('isr_tx');
                        $isr_rx = $this->input->post('isr_rx');
                        $actual_tx = $this->input->post('actual_tx');
                        $actual_rx = $this->input->post('actual_rx');
                        $dataISR = array(
                            'site_id' => $site_id[$i],
                            'rr' => $rr[$i],
                            'apl_id' => $apl_id[$i],
                            'isr_tx' => $isr_tx[$i],
                            'isr_rx' => $isr_rx[$i],
                            'actual_tx' => $actual_tx[$i],
                            'actual_rx' => $actual_rx[$i],
                        );

                        $this->Mod_detail_isr->update($id_detail_isr[$i], $dataISR);
                    }
                } else if ($new_data != 0) {
                    for ($i = 0; $i < $count_id; $i++) {
                        $id_detail_isr = $this->input->post('id_detail_isr');
                        $site_id = $this->input->post('site_id');
                        $rr = $this->input->post('rr');
                        $apl_id = $this->input->post('apl_id');
                        $isr_tx = $this->input->post('isr_tx');
                        $isr_rx = $this->input->post('isr_rx');
                        $actual_tx = $this->input->post('actual_tx');
                        $actual_rx = $this->input->post('actual_rx');
                        $dataISR = array(
                            'site_id' => $site_id[$i],
                            'rr' => $rr[$i],
                            'apl_id' => $apl_id[$i],
                            'isr_tx' => $isr_tx[$i],
                            'isr_rx' => $isr_rx[$i],
                            'actual_tx' => $actual_tx[$i],
                            'actual_rx' => $actual_rx[$i],
                        );

                        $this->Mod_detail_isr->update($id_detail_isr[$i], $dataISR);
                    }

                    for ($i = $new_data; $i < $count; $i++) {
                        $id = $this->input->post('id_isr');
                        $site_id = $this->input->post('site_id');
                        $rr = $this->input->post('rr');
                        $apl_id = $this->input->post('apl_id');
                        $isr_tx = $this->input->post('isr_tx');
                        $isr_rx = $this->input->post('isr_rx');
                        $actual_tx = $this->input->post('actual_tx');
                        $actual_rx = $this->input->post('actual_rx');
                        $dataISR = array(
                            'id_isr' => $id,
                            'site_id' => $site_id[$i],
                            'rr' => $rr[$i],
                            'apl_id' => $apl_id[$i],
                            'isr_tx' => $isr_tx[$i],
                            'isr_rx' => $isr_rx[$i],
                            'actual_tx' => $actual_tx[$i],
                            'actual_rx' => $actual_rx[$i],
                        );

                        $this->Mod_detail_isr->insert($dataISR);
                    }
                }
            } else {
                for ($i = 0; $i < $count; $i++) {
                    $id = $this->input->post('id_isr');
                    $site_id = $this->input->post('site_id');
                    $rr = $this->input->post('rr');
                    $apl_id = $this->input->post('apl_id');
                    $isr_tx = $this->input->post('isr_tx');
                    $isr_rx = $this->input->post('isr_rx');
                    $actual_tx = $this->input->post('actual_tx');
                    $actual_rx = $this->input->post('actual_rx');
                    $dataISR = array(
                        'id_isr' => $id,
                        'site_id' => $site_id[$i],
                        'rr' => $rr[$i],
                        'apl_id' => $apl_id[$i],
                        'isr_tx' => $isr_tx[$i],
                        'isr_rx' => $isr_rx[$i],
                        'actual_tx' => $actual_tx[$i],
                        'actual_rx' => $actual_rx[$i],
                    );

                    $this->Mod_detail_isr->insert($dataISR);
                }
            }
        }

        echo json_encode(array("status" => TRUE));
    }

    public function detail()
    {
        $id = trim($_POST['id_isr']);
        $data['isr'] = $this->Mod_isr->get_data_isr($id);
        $data['detail_isr'] = $this->Mod_detail_isr->get_data_detail_isr($id);
        // echo '<pre>';
        // print_r($data['detail_isr']);

        echo show_my_modal('isr/modal_detail_isr', $data);
    }

    public function delete()
    {
        $id = $this->input->post('id_isr');

        $this->Mod_isr->delete($id);
        echo json_encode(array("status" => TRUE));
    }

    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if ($this->input->post('induk_isr') == '') {
            $data['inputerror'][] = 'induk_isr';
            $data['error_string'][] = 'Induk ISR Tidak Boleh Kosong';
            $data['status'] = FALSE;
        }

        if ($this->input->post('cluster') == '') {
            $data['inputerror'][] = 'cluster';
            $data['error_string'][] = 'Cluster Tidak Boleh Kosong';
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