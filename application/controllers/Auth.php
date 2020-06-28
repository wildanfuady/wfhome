<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {

		parent::__construct();
		// memanggil Auth_model as $this->auth
        $this->load->model('Auth_model', 'auth');
    
    }

	public function index()
	{
		// cek apakah user sudah login atau belum, jika belum ...
        if($this->session->userdata('id') == null){
			// tampilkan halaman login di dalam template
			$this->load->view('v_login');
			
		} else { // jika sudah login langsung diredirect ke halaman mulai service order
			if($this->session->userdata('level') == "admin" && $this->session->userdata('status') == "activated"){
				redirect(base_url('admin/dashboard'));
			} else if($this->session->userdata('level') == "pengawas" && $this->session->userdata('status') == "activated"){
				redirect(base_url('pengawas/dashboard'));
			} else {
				//
			}
        }
	}
	
    public function login()
    {
        $email       = htmlentities(strip_tags(xssForMail($this->input->post('email'))));
        $password   = htmlentities(strip_tags(xss($this->input->post('password'))));

        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|min_length[5]|max_length[35]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]|max_length[15]|alpha_numeric_spaces');

        if($this->form_validation->run() == FALSE){

            $errors = $this->form_validation->error_array();
            $this->session->set_flashdata('errors', $errors);
            $this->session->set_flashdata('inputs', $this->input->post());
			redirect(base_url('/'));

        } else {

            $errors = [];

	    	// cek ke database berdasarkan username, email dan no hp
            $cek_login = $this->auth->cek_login($email);
             
			if(count($cek_login) == 0)
			{
				$errors = ['email' => 'Email yang Anda masukan salah'];
				$this->session->set_flashdata('errors', $errors);
				$this->session->set_flashdata('inputs', $this->input->post());
				redirect(base_url('/'));
			} 
			else {

				if(password_verify($password, $cek_login['password'])){

					$this->session->set_userdata('id', $cek_login['id']);
					$this->session->set_userdata('name', $cek_login['fullname']);
					$this->session->set_userdata('username', $cek_login['username']);
					$this->session->set_userdata('email', $cek_login['email']);
					$this->session->set_userdata('level', $cek_login['level']);
					$this->session->set_userdata('status', $cek_login['status']);

					if($cek_login['status'] == "activated" && $cek_login['level'] == "admin"){

						redirect(base_url('admin/dashboard')); 
					
					} else if($cek_login['status'] == "activated" && $cek_login['level'] == "pengawas"){

						redirect(base_url('pengawas/dashboard')); 

					} else if($cek_login['status'] == "activated" && $cek_login['level'] == "manajer"){

						redirect(base_url('manajer/manajer')); 

					} else {

						$errors = ['errors' => 'Email atau password yang Anda masukan salah'];
						$this->session->set_flashdata('errors', $errors);
						$this->session->set_flashdata('inputs', $this->input->post());
						redirect(base_url('/'));

					}

				} else {

					$errors = ['password' => 'Password yang Anda masukan salah'];
					$this->session->set_flashdata('errors', $errors);
					$this->session->set_flashdata('inputs', $this->input->post());
					redirect(base_url('/'));

				}
      		}

        }
    }

    public function logout()
	{
    	$this->session->sess_destroy();
		redirect(base_url());
	}
}
