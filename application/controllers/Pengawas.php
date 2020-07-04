<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Pengawas extends CI_Controller {

	public function __construct() {

		parent::__construct();
        $this->cek_login_pengawas();
        $this->load->model('Auth_model', 'auth');
        $this->load->model('Pekerjaan_model', 'pekerjaan');
    }

    public function index()
    {
        return $this->dashboard();
    }

    public function dashboard()
    {
        $data = [
            'judul' 	=> 'Home',
            'content'	=> 'pengawas/dashboard',
            'pekerjaan' => $this->pekerjaan->getPekerjaan(),
            'pekerjaan_total'       => $this->pekerjaan->getCountPekerjaan(),
            'pekerjaan_selesai'     => $this->pekerjaan->getCountPekerjaan('Selesai'),
            'pekerjaan_progress'    => $this->pekerjaan->getCountPekerjaan('Progress'),
            'pekerjaan_reject'      => $this->pekerjaan->getCountPekerjaan('Reject')
        ];
        
        $this->load->view('pengawas/template', $data);
    }

    public function pekerjaan()
    {
        $data = [
            'judul' 	=> 'Data Pekerjaan',
            'content'	=> 'pengawas/pekerjaan/index',
            'pekerjaan' => $this->pekerjaan->getPekerjaan(),
            'plugin_datatable' => true
        ];
        
        $this->load->view('pengawas/template', $data);
    }

    public function print_pekerjaan_with_pdf($id = null)
    {
        $tanggal = date('d-m-Y');
 
        $pdf = new \TCPDF();
        $pdf->AddPage('L', 'A3');
        $pdf->SetFont('', 'B', 20);
        $pdf->Cell(203, 0, "Laporan Pekerjaan - ".$tanggal, 0, 1, 'L');
        $pdf->SetAutoPageBreak(true, 0);
 
        // Add Header
        $pdf->Ln(10);
        $pdf->SetFont('', 'B', 12);
        $pdf->Cell(10, 8, "No", 1, 0, 'C');
        $pdf->Cell(55, 8, "Nama Pekerjaan", 1, 0, 'C');
        $pdf->Cell(30, 8, "Jumlah Unit", 1, 0, 'C');
        $pdf->Cell(55, 8, "Nama Kontraktor", 1, 0, 'C');
        $pdf->Cell(35, 8, "Jumlah Pekerja", 1, 0, 'C');
        $pdf->Cell(35, 8, "Tanggal Mulai", 1, 0, 'C');
        $pdf->Cell(35, 8, "Deadline", 1, 0, 'C');
        $pdf->Cell(145, 8, "Keterangan", 1, 1, 'C');
        $pdf->SetFont('', '', 12);
        if($id == null){
            $pekerjaan = $this->pekerjaan->getPekerjaan();
            foreach($pekerjaan as $k => $item) {
                $this->addRow($pdf, $k+1, $item);
            }
        } else {
            $item = $this->pekerjaan->getPekerjaan($id);
            $this->addRow($pdf, 1, $item);
        }
        $pdf->Output('Laporan Pekerjaan - '.$tanggal.'.pdf'); 
    }
 
    private function addRow($pdf, $no, $item) {
        if($item['pekerjaan_nama'] == 1){
            $tipe = "Kormersil (Type 32) Rumah";
            $keterangan = " unit";
        } else if($item['pekerjaan_nama'] == 2){
            $tipe = "Subsidi (Type 25) Rumah";
        } else {
            $tipe = "Sarana dan Prasarana";
            $keterangan = " /m<sup>2</sup>";
        }
        $pdf->Cell(10, 8, $no, 1, 0, 'C');
        $pdf->Cell(55, 8, $tipe, 1, 0, '');
        $pdf->Cell(30, 8, $item['pekerjaan_unit']. " ". $keterangan, 1, 0, 'C');
        $pdf->Cell(55, 8, $item['pekerjaan_kontraktor'], 1, 0, '');
        $pdf->Cell(35, 8, $item['pekerjaan_jumlah_pekerja']." karyawan", 1, 0, '');
        $pdf->Cell(35, 8, date('d-m-Y', strtotime($item['pekerjaan_tgl_mulai'])), 1, 0, 'C');
        $pdf->Cell(35, 8, date('d-m-Y', strtotime($item['pekerjaan_deadline'])), 1, 0, 'C');
        $pdf->Cell(145, 8, $item['pekerjaan_keterangan'], 1, 0, '');
    }

    public function print_pekerjaan_with_excel($id = null)
    {
        $tanggal = date('d-m-Y');
        // panggil class Sreadsheet baru
        $spreadsheet = new Spreadsheet;
        // Buat custom header pada file excel
        $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'No')
                    ->setCellValue('B1', 'Nama Pekerjaan')
                    ->setCellValue('C1', 'Jumlah Unit')
                    ->setCellValue('D1', 'Nama Kontraktor')
                    ->setCellValue('E1', 'Jumlah Pekerja')
                    ->setCellValue('F1', 'Tanggal Mulai')
                    ->setCellValue('G1', 'Deadline')
                    ->setCellValue('H1', 'Keterangan');
        // define kolom dan nomor
        $kolom = 2;
        $nomor = 1;
        // tambahkan data pekerjaan ke dalam file excel
        if($id == null){
            $pekerjaan = $this->pekerjaan->getPekerjaan();
            foreach($pekerjaan as $data) {
                if($data['pekerjaan_nama'] == 1){
                    $tipe = "Kormersil (Type 32) Rumah";
                    $keterangan = " unit";
                } else if($data['pekerjaan_nama'] == 2){
                    $tipe = "Subsidi (Type 25) Rumah";
                } else {
                    $tipe = "Sarana dan Prasarana";
                    $keterangan = " /m<sup>2</sup>";
                }
                $spreadsheet->setActiveSheetIndex(0)
                            ->setCellValue('A' . $kolom, $nomor)
                            ->setCellValue('B' . $kolom, $tipe)
                            ->setCellValue('C' . $kolom, $data['pekerjaan_unit']." ".$keterangan)
                            ->setCellValue('D' . $kolom, $data['pekerjaan_kontaktor'])
                            ->setCellValue('E' . $kolom, $data['pekerjaan_jumlah_pekerja'])
                            ->setCellValue('F' . $kolom, date('j F Y', strtotime($data['pekerjaan_tgl_mulai'])))
                            ->setCellValue('G' . $kolom, date('j F Y', strtotime($data['pekerjaan_deadline'])))
                            ->setCellValue('H' . $kolom, $data['pekerjaan_keterangan']);
                $kolom++;
                $nomor++;
            }
        } else {
            $pekerjaan = $this->pekerjaan->getPekerjaan($id);
            if(!empty($pekerjaan)){
                if($pekerjaan['pekerjaan_nama'] == 1){
                    $tipe = "Kormersil (Type 32) Rumah";
                    $keterangan = " unit";
                } else if($pekerjaan['pekerjaan_nama'] == 2){
                    $tipe = "Subsidi (Type 25) Rumah";
                } else {
                    $tipe = "Sarana dan Prasarana";
                    $keterangan = " /m<sup>2</sup>";
                }
                $spreadsheet->setActiveSheetIndex(0)
                            ->setCellValue('A' . $kolom, $nomor)
                            ->setCellValue('B' . $kolom, $tipe)
                            ->setCellValue('C' . $kolom, $data['pekerjaan_unit']." ".$keterangan)
                            ->setCellValue('D' . $kolom, $data['pekerjaan_kontaktor'])
                            ->setCellValue('E' . $kolom, $data['pekerjaan_jumlah_pekerja'])
                            ->setCellValue('F' . $kolom, date('j F Y', strtotime($data['pekerjaan_tgl_mulai'])))
                            ->setCellValue('G' . $kolom, date('j F Y', strtotime($data['pekerjaan_deadline'])))
                            ->setCellValue('H' . $kolom, $data['pekerjaan_keterangan']);
            } else {
                $this->session->set_flashdata('error', 'Gagal Membuat Laporan Pekerjaan');
                redirect(base_url('pengawas/pekerjaan'));
            }
        }
        // download spreadsheet dalam bentuk excel .xlsx
        $writer = new Xlsx($spreadsheet);
    
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Laporan_Pekerjaan.xlsx"');
        header('Cache-Control: max-age=0');
    
        $writer->save('php://output');
    }

    public function tambah_pekerjaan()
    {

        $data = [
            'judul' 	=> 'Tambah Pekerjaan',
            'content'	=> 'pengawas/pekerjaan/create',
            'plugin_datepicker' => true
        ];
        
        $this->load->view('pengawas/template', $data);

    }

    public function store_pekerjaan()
    {
        $this->form_validation->set_rules('pekerjaan_tipe', 'Tipe Pekerjaan', 'required');
        $this->form_validation->set_rules('pekerjaan_unit', 'Jumlah Unit Rumah / Luas Sarana dan Prasarana', 'required|numeric');
        $this->form_validation->set_rules('pekerjaan_kontraktor', 'Nama Kontraktor', 'required|alpha_numeric_spaces|min_length[5]|max_length[100]');
        $this->form_validation->set_rules('pekerjaan_tgl_mulai', 'Tanggal Mulai', 'required');
        $this->form_validation->set_rules('pekerjaan_deadline', 'Tanggal Deadline', 'required');
        $this->form_validation->set_rules('pekerjaan_progress', 'Progress', 'required|min_length[1]|max_length[50]');
        $this->form_validation->set_rules('pekerjaan_keterangan', 'Keterangan', 'required|min_length[5]|max_length[50]');

        $tipe           = htmlspecialchars(strip_tags(xss($this->input->post('pekerjaan_tipe'))));
        $unit           = htmlspecialchars(strip_tags(xss($this->input->post('pekerjaan_unit'))));
        $kontraktor     = htmlspecialchars(strip_tags(xss($this->input->post('pekerjaan_kontraktor'))));
        $mulai          = $this->input->post('pekerjaan_tgl_mulai');
        $deadline       = $this->input->post('pekerjaan_deadline');
        $progress       = htmlspecialchars(strip_tags(xss($this->input->post('pekerjaan_progress'))));
        $keterangan     = htmlspecialchars(strip_tags(xss($this->input->post('pekerjaan_keterangan'))));

        if($this->form_validation->run() == FALSE){

            $errors = $this->form_validation->error_array();
            $this->session->set_flashdata('errors', $errors);
            $this->session->set_flashdata('inputs', $this->input->post());
			redirect(base_url('pengawas/tambah-pekerjaan'));

        } else {
            // mengambil selisih hari antara mulai dan tanggal deadline
            $a = new DateTime($mulai);
            $b = new DateTime($deadline);
            $selisih = $b->diff($a)->days + 1;
            $jumlah_pekerja = 0;
            if($tipe == 1){ // rumah komersial
                $jumlah_pekerja = (200 * $unit) / $selisih;
            } else if($tipe == 2){ // rumah subsidi
                $jumlah_pekerja = (50 * 1 * $unit) / $selisih;
            } else { // sarana dan pra sarana
                $jumlah_pekerja = (1 * $unit) / $selisih;
            }

            echo $selisih;

            $data = [
                'pekerjaan_nama'            => $tipe,
                'pekerjaan_unit'            => $unit,
                'pekerjaan_kontraktor'      => $kontraktor,
                'pekerjaan_jumlah_pekerja'  => $jumlah_pekerja,
                'pekerjaan_tgl_mulai'       => date('Y-m-d H:i:s', strtotime($mulai)),
                'pekerjaan_deadline'        => date('Y-m-d H:i:s', strtotime($deadline)),
                'pekerjaan_progress'        => $progress,
                'pekerjaan_keterangan'      => $keterangan,
                'pekerjaan_status'          => 'Pekerjaan Baru'
            ];

            $simpan   = $this->pekerjaan->insert($data);

            if($simpan == true){
                $this->session->set_flashdata('success', 'Berhasil Menambah Pekerjaan Baru');
                redirect(base_url('pengawas/pekerjaan'));
            } else {
                $this->session->set_flashdata('error', 'Gagal Menambah Pekerjaan Baru');
                redirect(base_url('pengawas/pekerjaan'));
            }

        }
    }

    public function edit_pekerjaan($id = null)
    {
        $pekerjaan = $this->pekerjaan->getPekerjaan($id);

        if(!empty($pekerjaan)){

            $data = [
                'judul' 	=> 'Edit Pekerjaan',
                'content'	=> 'pengawas/pekerjaan/edit',
                'pekerjaan' => $pekerjaan
            ];
            
            $this->load->view('pengawas/template', $data);
        } else {
            echo "Tidak ada data";
        }
    }

    public function update_pekerjaan($id = null)
    {
        $pekerjaan = $this->pekerjaan->getPekerjaan($id);

        if(!empty($pekerjaan)){
            $this->form_validation->set_rules('pekerjaan_tipe', 'Tipe Pekerjaan', 'required');
            $this->form_validation->set_rules('pekerjaan_unit', 'Jumlah Unit Rumah / Luas Sarana dan Prasarana', 'required|numeric');
            $this->form_validation->set_rules('pekerjaan_kontraktor', 'Nama Kontraktor', 'required|alpha_numeric_spaces|min_length[5]|max_length[100]');
            $this->form_validation->set_rules('pekerjaan_tgl_mulai', 'Tanggal Mulai', 'required');
            $this->form_validation->set_rules('pekerjaan_deadline', 'Tanggal Deadline', 'required');
            $this->form_validation->set_rules('pekerjaan_progress', 'Progress', 'required|min_length[1]|max_length[50]');
            $this->form_validation->set_rules('pekerjaan_keterangan', 'Keterangan', 'required|min_length[5]|max_length[50]');

            $tipe           = htmlspecialchars(strip_tags(xss($this->input->post('pekerjaan_tipe'))));
            $unit           = htmlspecialchars(strip_tags(xss($this->input->post('pekerjaan_unit'))));
            $kontraktor     = htmlspecialchars(strip_tags(xss($this->input->post('pekerjaan_kontraktor'))));
            $mulai          = $this->input->post('pekerjaan_tgl_mulai');
            $deadline       = $this->input->post('pekerjaan_deadline');
            $progress       = htmlspecialchars(strip_tags(xss($this->input->post('pekerjaan_progress'))));
            $keterangan     = htmlspecialchars(strip_tags(xss($this->input->post('pekerjaan_keterangan'))));

            if($this->form_validation->run() == FALSE){

                $errors = $this->form_validation->error_array();
                $this->session->set_flashdata('errors', $errors);
                $this->session->set_flashdata('inputs', $this->input->post());
                redirect(base_url('pengawas/tambah-pekerjaan'));

            } else {
                // mengambil selisih hari antara mulai dan tanggal deadline
                $a = new DateTime($mulai);
                $b = new DateTime($deadline);
                $selisih = $b->diff($a)->days + 1;
                $jumlah_pekerja = 0;
                if($tipe == 1){ // rumah komersial
                    $jumlah_pekerja = (200 * $unit) / $selisih;
                } else if($tipe == 2){ // rumah subsidi
                    $jumlah_pekerja = (50 * 1 * $unit) / $selisih;
                } else { // sarana dan pra sarana
                    $jumlah_pekerja = (1 * $unit) / $selisih;
                }

                echo $selisih;

                $data = [
                    'pekerjaan_nama'            => $tipe,
                    'pekerjaan_unit'            => $unit,
                    'pekerjaan_kontraktor'      => $kontraktor,
                    'pekerjaan_jumlah_pekerja'  => $jumlah_pekerja,
                    'pekerjaan_tgl_mulai'       => date('Y-m-d H:i:s', strtotime($mulai)),
                    'pekerjaan_deadline'        => date('Y-m-d H:i:s', strtotime($deadline)),
                    'pekerjaan_progress'        => $progress,
                    'pekerjaan_keterangan'      => $keterangan,
                    'pekerjaan_status'          => 'Pekerjaan Baru'
                ];

                $ubah   = $this->pekerjaan->update($data, $id);

                if($ubah == true){
                    $this->session->set_flashdata('info', 'Berhasil Mengubah Pekerjaan Baru');
                    redirect(base_url('pengawas/pekerjaan'));
                } else {
                    $this->session->set_flashdata('error', 'Gagal Mengubah Pekerjaan Baru');
                    redirect(base_url('pengawas/pekerjaan'));
                }

            }
        }
    }

    public function akun()
    {
        $id = $this->session->userdata('id');

        $account = $this->auth->getAccount($id);

        $data = [
            'judul' 	=> 'Akun',
            'content'	=> 'pengawas/akun',
            'akun'      => $account
        ];
        
        $this->load->view('pengawas/template', $data);

    }

    public function update_akun()
    {
        $id = $this->session->userdata('id');
        $this->form_validation->set_rules('username', 'Username', 'required|alpha_numeric|min_length[5]|max_length[35]');
        $this->form_validation->set_rules('fullname', 'Fullname', 'required|alpha_numeric_spaces|min_length[5]|max_length[35]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|min_length[5]|max_length[50]');
        $this->form_validation->set_rules('password', 'password', 'required|min_length[5]|max_length[50]');

        $username        = htmlspecialchars(strip_tags(xss($this->input->post('username'))));
        $fullname        = htmlspecialchars(strip_tags(xss($this->input->post('fullname'))));
        $email           = htmlspecialchars(strip_tags(xssForMail($this->input->post('email'))));
        $password        = htmlspecialchars(strip_tags(xss($this->input->post('password'))));

        if($this->form_validation->run() == FALSE){

            $errors = $this->form_validation->error_array();
            $this->session->set_flashdata('errors', $errors);
            $this->session->set_flashdata('inputs', $this->input->post());
			redirect(base_url('pengawas/akun'));

        } else {

            $data = [
                'username'      => $username,
                'fullname'      => $fullname,
                'email'         => $email,
                'password'      => password_hash($password, PASSWORD_DEFAULT),
                'pass_show'     => $password
            ];

            $ubah   = $this->auth->update($data, $id);

            if($ubah == true){
                $this->session->set_flashdata('info', 'Berhasil Mengubah Akun');
                redirect(base_url('pengawas/akun'));
            } else {
                $this->session->set_flashdata('error', 'Gagal Mengubah Akun');
                redirect(base_url('pengawas/akun'));
            }

        }
    }
}