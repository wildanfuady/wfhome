<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lupa_password extends CI_Controller {

    public function __construct() {

		parent::__construct();
		// memanggil Auth_model as $this->auth
        $this->load->model('Auth_model', 'auth');
    
    }

	public function index()
	{
		// cek apakah user sudah login atau belum, jika belum ...
        if($this->session->userdata('id') != null && $this->session->userdata('level') == "user"){

            redirect(base_url('user/dashboard'));

        }

        if($this->session->flashdata('success_cek_email') ==  'Ya'){
            $this->load->view('v_ubah_password');
        } else {
        
            $this->load->view('v_lupa_password');

        }

	}
	
    public function cek()
    {
        $email       	= xssForMail($this->input->post('email'));

        $this->form_validation->set_rules('email', 'Email', 'required|min_length[3]|max_length[45]|valid_email');

        if ($this->form_validation->run() == FALSE) {

            $errors = $this->form_validation->error_array();
            $this->session->set_flashdata('errors', $errors);
            redirect('lupa-password');

        } else {

            $errors = [];

            // cek ke database berdasarkan username, email dan no hp
            $cek_login = $this->auth->cek_login_user_where_email($email);
                
            if(count($cek_login) == 0)
            {
                $errors = ['' => 'Email yang Anda masukan tidak ditemukan'];
                $this->session->set_flashdata('errors', $errors);
                $this->session->set_flashdata('inputs', $this->input->post());
                redirect(base_url('lupa-password'));

            } else {

                $this->session->set_userdata('email_session', $cek_login['email']);
                $this->session->set_flashdata('email', $cek_login['email']);
                $this->session->set_flashdata('success_cek_email', 'Ya');
                redirect(base_url('lupa-password'));

            }
        }
    }
    
    public function new()
    {
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
		$this->form_validation->set_rules('confrim_password', 'Konfirmasi Password', 'required|trim|matches[password]');
			
        if ($this->form_validation->run() == FALSE) {

            $errors = $this->form_validation->error_array();
            $this->session->set_flashdata('errors', $errors);
            redirect(base_url('lupa-password'));

        } else {

            $email = $this->session->userdata('email_session');

            // echo $email;

            $getClient = $this->auth->get_login_user_where_email($email);

            // var_dump($getClient);

            // echo $email;

            if(!empty($getClient)){

                $password 	= $this->input->post('password');
                $pass 		= password_hash($password, PASSWORD_DEFAULT);
                    
                $data = [
                    'password' 	    => $pass,
                    'pass_show'     => $password,
                    'updated_at'    => date('Y-m-d H:i:s')
                ];

                $update = $this->auth->update($data, $getClient['id']);

                if($update){
                    
                    $this->session->sess_destroy();
                    echo '<script>alert("Sukses! Anda berhasil melakukan update password. Silahkan login untuk mengakses data.");window.location.href="'.base_url('/').'";</script>';
                
                }

            } else {

                $this->session->set_flashdata('errors', ['' => 'Gagal mengupdate password. Silahkan mencoba beberapa saat lagi.']);
                redirect(base_url('lupa-password'));

            }

            
        }
    }
	
}
