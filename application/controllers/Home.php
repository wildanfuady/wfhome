<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct() {

		parent::__construct();
		// memanggil Auth_model as $this->auth
        $this->load->model('Auth_model', 'auth');
        $this->load->model('Category_model', 'category');
        $this->load->model('Product_model', 'product');
    
	}
	
	public function index()
	{
		$data = [
			'content'	=> 'home',
			'seo'		=> 'home',
			'categories' => $this->category->getCategoryInThumbnail(),
			'product_laris' => $this->product->getProductBy('Laris'),
			'product_baru' 	=> $this->product->getProductBy('Terbaru')
		];
		$this->load->view('template', $data);
	}
}
