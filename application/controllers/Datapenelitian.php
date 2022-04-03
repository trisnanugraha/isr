<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Row;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Datapenelitian extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mod_data_penelitian');
        $this->load->model('Mod_ajuan_penelitian');
        $this->load->model('Mod_priode');
        $this->load->model('Mod_skema_penelitian');
        $this->load->model('Mod_user');
        $this->load->model('Mod_userlevel');
    }

    public function index()
    {
        $this->_cek_status();
        $reviewer = $this->Mod_userlevel->getId('Reviewer');
        $idReviewer = $reviewer->id_level;
        $data['judul'] = "Data Penelitian";
        $data['priode'] = $this->Mod_priode->get_all();
        $data['skema'] = $this->Mod_skema_penelitian->get_all();
        $data['user'] = $this->Mod_user->get_all();
        $data['reviewer'] = $this->Mod_user->get_all($idReviewer);
        $data['modal_detail_data_penelitian'] = show_my_modal('data_penelitian/modal_detail_data_penelitian', $data);
        $data['modal_print_data_penelitian'] = show_my_modal('data_penelitian/modal_print_data_penelitian', $data['priode']);
        $js = $this->load->view('data_penelitian/data-penelitian-js', null, true);
        $this->template->views('data_penelitian/home', $data, $js);
    }

    public function ajax_list()
    {
        $this->_cek_status();
        ini_set('memory_limit', '512M');
        set_time_limit(3600);
        $list = $this->Mod_data_penelitian->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $ajuan) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $ajuan->full_name;
            $row[] = $ajuan->judul_penelitian;
            $row[] = $ajuan->nama_skema;
            $row[] = $ajuan->status;
            $row[] = $ajuan->status_reviewer;
            $row[] = $ajuan->id_ajuan_penelitian;
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
            "recordsTotal" => $this->Mod_data_penelitian->count_all(),
            "recordsFiltered" => $this->Mod_data_penelitian->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function edit($id)
    {
        $this->_cek_status();
        $idReviewer = $this->Mod_data_penelitian->check_reviewer($id);

        $list_anggota = array();
        for ($i = 1; $i <= 5; $i++) {
            $get_value = $this->Mod_data_penelitian->get_anggota($id, $i);

            if ($get_value == null || $get_value == '') {
                $list_anggota["anggota{$i}"] = null;
            } else {
                $list_anggota["anggota{$i}"] = $get_value->full_name;
            }
        }
        // $data['anggota'] = $list_anggota;

        if ($idReviewer->id_reviewer == '' || $idReviewer->id_reviewer == null) {
            $data = $this->Mod_data_penelitian->get_new_data($id);
        } else {
            $data = $this->Mod_data_penelitian->get_data($id);
        }
        $data->anggaran =  'Rp ' . rupiah($data->anggaran);
        $data->anggota1 = $list_anggota['anggota1'];
        $data->anggota2 = $list_anggota['anggota2'];
        $data->anggota3 = $list_anggota['anggota3'];
        $data->anggota4 = $list_anggota['anggota4'];
        $data->anggota5 = $list_anggota['anggota5'];

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

        // $data = $this->Mod_data_penelitian->get_data($id);
        echo json_encode($data);
        // echo json_encode($data['anggota']);

    }

    public function update()
    {
        $this->_cek_status();
        $this->_validate();
        $id      = $this->input->post('id_ajuan_penelitian');
        $status_reviewer = $this->Mod_data_penelitian->get_status_reviewer($id);

        if ($status_reviewer->status_reviewer == "Approve" && $this->input->post('status') == "Approve") {
            $save  = array(
                'status' => $this->input->post('status'),
                'komentar_lppm' => $this->input->post('komentar_lppm'),
                'id_reviewer' => $this->input->post('reviewer'),
                'tgl_validasi_lppm' => date('Y-m-d H:i:s'),
                'status_pengusul' => "Pengajuan Diterima"
            );
        } else {
            $save  = array(
                'status' => $this->input->post('status'),
                'komentar_lppm' => $this->input->post('komentar_lppm'),
                'id_reviewer' => $this->input->post('reviewer'),
                'tgl_validasi_lppm' => date('Y-m-d H:i:s')
            );
        }
        $this->Mod_data_penelitian->update($id, $save);
        echo json_encode(array("status" => TRUE));
    }

    public function delete()
    {
        $this->_cek_status();
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

        if ($this->input->post('status') == '') {
            $data['inputerror'][] = 'status';
            $data['error_string'][] = 'Status Tidak Boleh Kosong';
            $data['status'] = FALSE;
        }

        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }

    public function print()
    {
        $this->_cek_status();
        $record = array();
        $id = $this->input->post('priode');
        $tipe = $this->input->post('tipeFile');
        if ($id != "all") {
            $dataPenelitian = $this->Mod_data_penelitian->get_by_priode($id)->result();
            $count = $this->Mod_data_penelitian->count_by_priode($id);
        } else {
            $dataPenelitian = $this->Mod_data_penelitian->getAll()->result();
            $count = $this->Mod_data_penelitian->count_all();
        }

        if ($count > 0) {
            if ($tipe == "PDF") {
                $this->_pdf($dataPenelitian);
            } else if ($tipe == "Excel") {
                $this->_excel($dataPenelitian);
            }
        } else {
            echo "Data Masih Kosong";
        }
    }

    private function _pdf($records)
    {
        foreach ($records as $data) {
            $row = array();
            $anggota1 = '';
            $anggota2 = '';
            $anggota3 = '';
            $anggota4 = '';
            $anggota5 = '';
            $ketua = $this->Mod_user->getUser($data->id_ketua);
            $skema = $this->Mod_skema_penelitian->get_skema($data->id_skema);

            if ($data->id_anggota_1 != null || $data->id_anggota_1 != 0) {
                $anggota1 = $this->Mod_user->getUser($data->id_anggota_1);
                $anggota1 = $anggota1->full_name;
            }
            if ($data->id_anggota_2 != null || $data->id_anggota_2 != 0) {
                $anggota2 = $this->Mod_user->getUser($data->id_anggota_2);
                $anggota2 = $anggota2->full_name;
            }
            if ($data->id_anggota_3 != null || $data->id_anggota_3 != 0) {
                $anggota3 = $this->Mod_user->getUser($data->id_anggota_3);
                $anggota3 = $anggota3->full_name;
            }
            if ($data->id_anggota_4 != null || $data->id_anggota_4 != 0) {
                $anggota4 = $this->Mod_user->getUser($data->id_anggota_4);
                $anggota4 = $anggota4->full_name;
            }
            if ($data->id_anggota_5 != null || $data->id_anggota_5 != 0) {
                $anggota5 = $this->Mod_user->getUser($data->id_anggota_5);
                $anggota5 = $anggota5->full_name;
            }

            $row = [
                'ketua' => $ketua->full_name,
                'skema' => $skema->nama_skema,
                'judul_penelitian' => $data->judul_penelitian,
                'anggota1' => $anggota1,
                'anggota2' => $anggota2,
                'anggota3' => $anggota3,
                'anggota4' => $anggota4,
                'anggota5' => $anggota5,
                'komentar_lppm' => $data->komentar_lppm,
                'komentar_reviewer' => $data->komentar_reviewer,
            ];
            $record['penelitian'][] = $row;
            // echo '<pre>';
            // print_r($record);
        }
        $format = "%Y-%M-%d--%H-%i";
        $this->load->library('pdf');
        $this->pdf->setPaper('legal', 'landscape');
        $this->pdf->filename = "Laporan Data Penelitian -- " . mdate($format) . ".pdf";
        $this->pdf->load_view('data_penelitian/print-layout', $record);
    }

    private function _excel($data)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $styleArray = [
            'font' => [
                'bold'  =>  true,
                'size'  =>  10,
                'name'  =>  'Arial'
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgb' => '000000']
                ]
            ]
        ];
        $styleData = [
            'alignment' => [
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgb' => '000000']
                ]
            ]
        ];
        $sheet->getStyle('A')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('N')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('Q')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('T')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('Y')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('Z')->getAlignment()->setHorizontal('center');
        $sheet->getColumnDimension('A')->setWidth(10);
        foreach (range('B', 'Z') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
            $sheet->getDefaultRowDimension($col)->setRowHeight(25);
        }
        $sheet->getStyle('A1:Z1')->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setRGB('bfb8b8');
        $sheet->getStyle('A1:Z1')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A1:Z1')->applyFromArray($styleArray);

        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Priode');
        $sheet->setCellValue('C1', 'Judul Penelitian');
        $sheet->setCellValue('D1', 'Skema');
        $sheet->setCellValue('E1', 'Ketua Peneliti');
        $sheet->setCellValue('F1', 'Anggota 1');
        $sheet->setCellValue('G1', 'Anggota 2');
        $sheet->setCellValue('H1', 'Anggota 3');
        $sheet->setCellValue('I1', 'Anggota 4');
        $sheet->setCellValue('J1', 'Anggota 5');
        $sheet->setCellValue('K1', 'Anggaran');
        $sheet->setCellValue('L1', 'Lokasi');
        $sheet->setCellValue('M1', 'Nama Jurnal');
        $sheet->setCellValue('N1', 'Peringkat Jurnal');
        $sheet->setCellValue('O1', 'Link Jurnal');
        $sheet->setCellValue('P1', 'E-ISSN');
        $sheet->setCellValue('Q1', 'Status LPPM');
        $sheet->setCellValue('R1', 'Komentar LPPM');
        $sheet->setCellValue('S1', 'Reviewer');
        $sheet->setCellValue('T1', 'Status Reviewer');
        $sheet->setCellValue('U1', 'Komentar Reviewer');
        $sheet->setCellValue('V1', 'Berkas Laporan');
        $sheet->setCellValue('W1', 'Berkas Jurnal');
        $sheet->setCellValue('X1', 'Berkas Reviewer');
        $sheet->setCellValue('Y1', 'Tanggal Dibuat');
        $sheet->setCellValue('Z1', 'Terakhir Diubah');

        $records = $data;
        $no = 1;
        $x = 2;
        foreach ($records as $row) {
            $sheet->getStyle("A{$x}:Z{$x}")->applyFromArray($styleData);
            $priode = $this->Mod_priode->get_priode($row->id_priode);
            $skema = $this->Mod_skema_penelitian->get_skema($row->id_skema);
            $ketua = $this->Mod_user->getUser($row->id_ketua);
            $sheet->setCellValue('A' . $x, $no++);
            $sheet->setCellValue('B' . $x, $priode->judul);
            $sheet->setCellValue('C' . $x, $row->judul_penelitian);
            $sheet->setCellValue('D' . $x, $skema->nama_skema);
            $sheet->setCellValue('E' . $x, $ketua->full_name);
            if ($row->id_anggota_1 != null) {
                $anggota1 = $this->Mod_user->getUser($row->id_anggota_1);
                $sheet->setCellValue('F' . $x, $anggota1->full_name);
            }
            if ($row->id_anggota_2 != null) {
                $anggota2 = $this->Mod_user->getUser($row->id_anggota_2);
                $sheet->setCellValue('G' . $x, $anggota2->full_name);
            }
            if ($row->id_anggota_3 != null) {
                $anggota3 = $this->Mod_user->getUser($row->id_anggota_3);
                $sheet->setCellValue('H' . $x, $anggota3->full_name);
            }
            if ($row->id_anggota_4 != null) {
                $anggota4 = $this->Mod_user->getUser($row->id_anggota_4);
                $sheet->setCellValue('I' . $x, $anggota4->full_name);
            }
            if ($row->id_anggota_5 != null) {
                $anggota5 = $this->Mod_user->getUser($row->id_anggota_5);
                $sheet->setCellValue('J' . $x, $anggota5->full_name);
            }
            $sheet->setCellValue('K' . $x, 'Rp. ' . rupiah($row->anggaran));
            $sheet->setCellValue('L' . $x, $row->lokasi);
            $sheet->setCellValue('M' . $x, $row->nama_jurnal);
            $sheet->setCellValue('N' . $x, $row->peringkat_jurnal);
            $sheet->setCellValue('O' . $x, $row->link_jurnal);
            $sheet->getCell('O' . $x)->getHyperlink()->setUrl($row->link_jurnal);
            $sheet->setCellValue('P' . $x, $row->e_issn);
            $sheet->setCellValue('Q' . $x, $row->status);
            $sheet->setCellValue('R' . $x, $row->komentar_lppm);
            if ($row->id_reviewer != null) {
                $reviewer = $this->Mod_user->getUser($row->id_reviewer);
                $sheet->setCellValue('S' . $x, $reviewer->full_name);
            }
            $sheet->setCellValue('T' . $x, $row->status_reviewer);
            $sheet->setCellValue('U' . $x, $row->komentar_reviewer);
            if ($row->berkas_laporan != null) {
                $sheet->setCellValue('V' . $x, base_url('upload/penelitian/laporan/') . $row->berkas_laporan);
                $sheet->getCell('V' . $x)->getHyperlink()->setUrl(base_url('upload/penelitian/laporan/') . $row->berkas_laporan);
            }
            if ($row->berkas_jurnal != null) {
                $sheet->setCellValue('W' . $x, base_url('upload/penelitian/jurnal/') . $row->berkas_jurnal);
                $sheet->getCell('W' . $x)->getHyperlink()->setUrl(base_url('upload/penelitian/jurnal/') . $row->berkas_jurnal);
            }
            if ($row->berkas_review != null) {
                $sheet->setCellValue('X' . $x, base_url('upload/review/penelitian/') . $row->berkas_review);
                $sheet->getCell('X' . $x)->getHyperlink()->setUrl(base_url('upload/review/penelitian/') . $row->berkas_review);
            }
            $sheet->setCellValue('Y' . $x, tgl_indonesia($row->tgl_dibuat));
            if ($row->tgl_diubah != null) {
                $sheet->setCellValue('Z' . $x, tgl_indonesia($row->tgl_diubah));
            }
            $x++;
        }
        $format = "%Y-%M-%d--%H-%i";
        $writer = new Xlsx($spreadsheet);
        $filename = 'Data-Penelitian' . ' -- ' . mdate($format);

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    private function _cek_status()
    {
        $is_login = $this->session->userdata('logged_in');
        $hak_akses = $this->session->userdata('hak_akses');
        $this->fungsi->validasiAkses($is_login, $hak_akses);
    }
}

/* End of file DataPenelitian.php */