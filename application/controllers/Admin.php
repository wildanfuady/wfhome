<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Admin extends CI_Controller {

	public function __construct() {

		parent::__construct();
        $this->cek_login_admin();
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
            'content'	=> 'admin/dashboard',
            'pekerjaan' => $this->pekerjaan->getPekerjaanForAdmin(),
            'pekerjaan_total'       => $this->pekerjaan->getCountPekerjaan(),
            'pekerjaan_selesai'     => $this->pekerjaan->getCountPekerjaan('Selesai'),
            'pekerjaan_progress'    => $this->pekerjaan->getCountPekerjaan('Progress'),
            'pekerjaan_reject'      => $this->pekerjaan->getCountPekerjaan('Reject'),
            'plugin_datatable'      => true
        ];
        
        $this->load->view('admin/template', $data);
    }

    public function pengawas()
    {
        $data = [
            'judul' 	=> 'Data Pengawas',
            'content'	=> 'admin/pengawas/index',
            'pengawas'  => $this->auth->getUsers('pengawas'),
            'plugin_datatable' => true
        ];
        
        $this->load->view('admin/template', $data);
    }

    public function tambah_pengawas()
    {
        $data = [
            'judul' 	=> 'Tambah Pengawas',
            'content'	=> 'admin/pengawas/create'
        ];
        
        $this->load->view('admin/template', $data);
    }

    public function store_pengawas()
    {
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
			redirect(base_url('admin/tambah-pengawas'));

        } else {

            $data = [
                'username'      => $username,
                'fullname'      => $fullname,
                'email'         => $email,
                'password'      => password_hash($password, PASSWORD_DEFAULT),
                'pass_show'     => $password,
                'level'         => 'pengawas',
                'status'        => 'activated',
                'created_at'    => date('Y-m-d H:i:s')
            ];

            $simpan   = $this->auth->insert($data);

            if($simpan == true){
                $this->session->set_flashdata('success', 'Berhasil Menambah Data Pengawas');
                redirect(base_url('admin/pengawas'));
            } else {
                $this->session->set_flashdata('error', 'Gagal Menambah Data Pengawas');
                redirect(base_url('admin/pengawas'));
            }

        }
    }

    public function edit_pengawas($id)
    {
        $pengawas       = $this->auth->getAccount($id);
        if(!empty($pengawas)){
            $data = [
                'judul' 	=> 'Edit Pengawas',
                'content'	=> 'admin/pengawas/edit',
                'pengawas'  => $pengawas
            ];
            $this->load->view('admin/template', $data);
        } else {
            $this->session->set_flashdata('error', 'Gagal Menampilkan Data Pengawas');
            redirect(base_url('admin/pengawas'));
        }
    }

    public function update_pengawas($id)
    {
        $pengawas       = $this->auth->getAccount($id);
        if(!empty($pengawas)){

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
                redirect(base_url('admin/edit-pengawas/'.$id));

            } else {

                $data = [
                    'username'      => $username,
                    'fullname'      => $fullname,
                    'email'         => $email,
                    'password'      => password_hash($password, PASSWORD_DEFAULT),
                    'pass_show'     => $password,
                    'created_at'    => date('Y-m-d H:i:s')
                ];

                $ubah   = $this->auth->update($data, $id);

                if($ubah == true){
                    $this->session->set_flashdata('info', 'Berhasil Mengubah Data Pengawas');
                    redirect(base_url('admin/pengawas'));
                } else {
                    $this->session->set_flashdata('error', 'Gagal Mengubah Data Pengawas');
                    redirect(base_url('admin/pengawas'));
                }

            }   

        } else {
            $this->session->set_flashdata('error', 'Gagal Menampilkan Data Pengawas');
            redirect(base_url('admin/pengawas'));
        }
    }

    public function hapus_pengawas($id = null)
    {
        $pengawas       = $this->auth->getAccount($id);

        if(!empty($pengawas)){

            $hapus   = $this->auth->delete($id);

            if($hapus == true){
                $this->session->set_flashdata('warning', 'Berhasil Menghapus Data Pengawas');
                redirect(base_url('admin/pengawas'));
            } else {
                $this->session->set_flashdata('error', 'Gagal Menghapus Data Pengawas');
                redirect(base_url('admin/pengawas'));
            }
        } else {
            $this->session->set_flashdata('error', 'Gagal Menampilkan Data Pengawas');
            redirect(base_url('admin/pengawas'));
        }
    }

    public function manajer()
    {
        $data = [
            'judul' 	=> 'Data Manajer',
            'content'	=> 'admin/manajer/index',
            'manajer'  => $this->auth->getUsers('manajer'),
            'plugin_datatable' => true
        ];
        
        $this->load->view('admin/template', $data);
    }

    public function tambah_manajer()
    {
        $data = [
            'judul' 	=> 'Tambah Manajer',
            'content'	=> 'admin/manajer/create'
        ];
        
        $this->load->view('admin/template', $data);
    }

    public function store_manajer()
    {
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
			redirect(base_url('admin/tambah-manajer'));

        } else {

            $data = [
                'username'      => $username,
                'fullname'      => $fullname,
                'email'         => $email,
                'password'      => password_hash($password, PASSWORD_DEFAULT),
                'pass_show'     => $password,
                'level'         => 'manajer',
                'status'        => 'activated',
                'created_at'    => date('Y-m-d H:i:s')
            ];

            $simpan   = $this->auth->insert($data);

            if($simpan == true){
                $this->session->set_flashdata('success', 'Berhasil Menambah Data Manajer');
                redirect(base_url('admin/manajer'));
            } else {
                $this->session->set_flashdata('error', 'Gagal Menambah Data Manajer');
                redirect(base_url('admin/manajer'));
            }

        }
    }

    public function edit_manajer($id)
    {
        $manajer       = $this->auth->getAccount($id);
        if(!empty($manajer)){
            $data = [
                'judul' 	=> 'Edit Manajer',
                'content'	=> 'admin/manajer/edit',
                'manajer'  => $manajer
            ];
            $this->load->view('admin/template', $data);
        } else {
            $this->session->set_flashdata('error', 'Gagal Menampilkan Data Manajer');
            redirect(base_url('admin/manajer'));
        }
    }

    public function update_manajer($id)
    {
        $manajer       = $this->auth->getAccount($id);
        if(!empty($manajer)){

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
                redirect(base_url('admin/edit-manajer/'.$id));

            } else {

                $data = [
                    'username'      => $username,
                    'fullname'      => $fullname,
                    'email'         => $email,
                    'password'      => password_hash($password, PASSWORD_DEFAULT),
                    'pass_show'     => $password,
                    'created_at'    => date('Y-m-d H:i:s')
                ];

                $ubah   = $this->auth->update($data, $id);

                if($ubah == true){
                    $this->session->set_flashdata('info', 'Berhasil Mengubah Data Manajer');
                    redirect(base_url('admin/manajer'));
                } else {
                    $this->session->set_flashdata('error', 'Gagal Mengubah Data Manajer');
                    redirect(base_url('admin/manajer'));
                }

            }   

        } else {
            $this->session->set_flashdata('error', 'Gagal Menampilkan Data Manajer');
            redirect(base_url('admin/manajer'));
        }
    }

    public function hapus_manajer($id = null)
    {
        $manajer       = $this->auth->getAccount($id);

        if(!empty($manajer)){

            $hapus   = $this->auth->delete($id);

            if($hapus == true){
                $this->session->set_flashdata('warning', 'Berhasil Menghapus Data Manajer');
                redirect(base_url('admin/manajer'));
            } else {
                $this->session->set_flashdata('error', 'Gagal Menghapus Data Manajer');
                redirect(base_url('admin/manajer'));
            }
        } else {
            $this->session->set_flashdata('error', 'Gagal Menampilkan Data Manajer');
            redirect(base_url('admin/manajer'));
        }
    }

    public function pekerjaan()
    {
        $data = [
            'judul' 	=> 'Data Pekerjaan',
            'content'	=> 'admin/pekerjaan',
            'pekerjaan' => $this->pekerjaan->getPekerjaanForAdmin(),
            'plugin_datatable' => true
        ];
        
        $this->load->view('admin/template', $data);
    }

    public function print_pekerjaan_with_pdf($id = null)
    {
        $tanggal = date('d-m-Y');
 
        $pdf = new \TCPDF();
        $pdf->AddPage('L', 'A3');
        $pdf->SetFont('', 'B', 20);
        $pdf->Cell(113, 0, "Laporan Pekerjaan - ".$tanggal, 0, 1, 'L');
        $pdf->SetAutoPageBreak(true, 0);
 
        // Add Header
        $pdf->Ln(10);
        $pdf->SetFont('', 'B', 12);
        $pdf->Cell(10, 8, "No", 1, 0, 'C');
        $pdf->Cell(55, 8, "Nama Pekerjaan", 1, 0, 'C');
        $pdf->Cell(35, 8, "Jumlah Unit", 1, 0, 'C');
        $pdf->Cell(55, 8, "Nama Kontraktor", 1, 0, 'C');
        $pdf->Cell(35, 8, "Jumlah Pekerja", 1, 0, 'C');
        $pdf->Cell(35, 8, "Tanggal Mulai", 1, 0, 'C');
        $pdf->Cell(35, 8, "Deadline", 1, 0, 'C');
        $pdf->Cell(135, 8, "Keterangan", 1, 1, 'C');
        $pdf->SetFont('', '', 12);
        if($id == null){
            $pekerjaan = $this->pekerjaan->getPekerjaanForAdmin();
            foreach($pekerjaan as $k => $item) {
                $this->addRow($pdf, $k+1, $item);
            }
        } else {
            $item = $this->pekerjaan->getPekerjaanForAdmin($id);
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
        $pdf->Cell(35, 8, $item['pekerjaan_unit']." ".$keterangan, 1, 0, '');
        $pdf->Cell(55, 8, $item['pekerjaan_kontraktor'], 1, 0, '');
        $pdf->Cell(35, 8, $item['pekerjaan_jumlah_pekerja']." karyawan", 1, 0, '');
        $pdf->Cell(35, 8, date('d-m-Y', strtotime($item['pekerjaan_tgl_mulai'])), 1, 0, 'C');
        $pdf->Cell(35, 8, date('d-m-Y', strtotime($item['pekerjaan_deadline'])), 1, 0, 'C');
        $pdf->Cell(135, 8, $item['pekerjaan_keterangan'], 1, 0, 'C');
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
                    ->setCellValue('B1', 'Jumlah Uit')
                    ->setCellValue('C1', 'Nama Kontraktor')
                    ->setCellValue('D1', 'Jumlah Pekerja')
                    ->setCellValue('E1', 'Tanggal Mulai')
                    ->setCellValue('F1', 'Deadline')
                    ->setCellValue('G1', 'Keterangan');
        // define kolom dan nomor
        $kolom = 2;
        $nomor = 1;
        // tambahkan data pekerjaan ke dalam file excel
        if($id == null){
            $pekerjaan = $this->pekerjaan->getPekerjaanForAdmin();
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
                            ->setCellValue('D' . $kolom, $data['pekerjaan_kontraktor'])
                            ->setCellValue('E' . $kolom, $data['pekerjaan_jumlah_pekerja'])
                            ->setCellValue('F' . $kolom, date('j F Y', strtotime($data['pekerjaan_tgl_mulai'])))
                            ->setCellValue('G' . $kolom, date('j F Y', strtotime($data['pekerjaan_deadline'])))
                            ->setCellValue('H' . $kolom, $data['pekerjaan_keterangan']);
                $kolom++;
                $nomor++;
            }
        } else {
            $pekerjaan = $this->pekerjaan->getPekerjaanForAdmin($id);
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
                                ->setCellValue('D' . $kolom, $pekerjaan['pekerjaan_unit'])
                                ->setCellValue('C' . $kolom, $pekerjaan['pekerjaan_kontraktor']." ".$keterangan)
                                ->setCellValue('E' . $kolom, $pekerjaan['pekerjaan_jumlah_pekerja'])
                                ->setCellValue('F' . $kolom, date('j F Y', strtotime($pekerjaan['pekerjaan_tgl_mulai'])))
                                ->setCellValue('G' . $kolom, date('j F Y', strtotime($pekerjaan['pekerjaan_deadline'])))
                                ->setCellValue('H' . $kolom, $pekerjaan['pekerjaan_keterangan']);
            } else {
                $this->session->set_flashdata('error', 'Gagal Membuat Laporan Pekerjaan');
                redirect(base_url('admin/pekerjaan'));
            }
        }
        // download spreadsheet dalam bentuk excel .xlsx
        $writer = new Xlsx($spreadsheet);
    
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Laporan_Pekerjaan_"'.$tanggal.'".xlsx"');
        header('Cache-Control: max-age=0');
    
        $writer->save('php://output');
    }

    public function akun()
    {
        $id = $this->session->userdata('id');

        $account = $this->auth->getAccount($id);

        $data = [
            'judul' 	=> 'Akun',
            'content'	=> 'admin/akun',
            'akun'      => $account
        ];
        
        $this->load->view('admin/template', $data);

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
			redirect(base_url('admin/akun'));

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
                redirect(base_url('admin/akun'));
            } else {
                $this->session->set_flashdata('error', 'Gagal Mengubah Akun');
                redirect(base_url('admin/akun'));
            }

        }
    }
}