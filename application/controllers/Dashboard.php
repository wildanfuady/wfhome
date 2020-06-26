<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct() {

		parent::__construct();
        $this->cek_login_admin();
    
    }

    public function index()
    {
        $data = [
            'judul' 	=> 'Home',
            'content'	=> 'admin/dashboard'
        ];
        $this->load->view('admin/template', $data);
    }
}