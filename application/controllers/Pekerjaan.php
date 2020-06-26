<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pekerjaan extends CI_Controller {

	public function __construct() {

		parent::__construct();
        $this->cek_login_admin();
    
    }

    public function admin()
    {
        $data = [
            'judul' 	=> 'Data Pekerjaan',
            'content'	=> 'admin/pekerjaan'
        ];
        
        $this->load->view('admin/template', $data);
    }
}