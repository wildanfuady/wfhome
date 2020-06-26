<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Sitemap extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Sitemap_model', 'sitemap');
	}

    public function index(){

        $product    = $this->db->order_by('updated_at', 'desc')->get('products')->row_array();
        $category   = $this->db->order_by('updated_at', 'desc')->get('categories')->row_array();
        $page       = $this->db->order_by('updated_at', 'desc')->get('pages')->row_array();

        $data = [
            'product'   => $product,
            'category'  => $category,
            'page'      => $page
        ];
            
        $this->load->view('sitemap/index', $data);
    
    }

    public function product(){
            
        $data['products'] = $this->sitemap->create_product();
            
        $this->load->view('sitemap/product', $data);
    
    }

    public function category(){
            
        $data['categories'] = $this->sitemap->create_category();
            
        $this->load->view('sitemap/category', $data);
    
    }

    public function page(){
            
        $data['pages'] = $this->sitemap->create_page();
            
        $this->load->view('sitemap/page', $data);
    
    }

}
?>