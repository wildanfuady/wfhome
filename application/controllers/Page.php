<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller {

	public function __construct() {

		parent::__construct();
        $this->load->model('Page_model', 'page');
        $this->load->model('Category_model', 'category');
    
	}
	
	public function detail($slug = null)
	{
		$page = $this->page->getPageBySlug($slug);

		$data = [
            'judul'     => 'Halaman '.$page['page_title'],
			'content'	=> 'page/detail',
			'page' 		=> $page,
			'seo'		=> 'page_detail',
		];
		$this->load->view('template', $data);
	}
}
