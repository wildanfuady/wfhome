<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Product_model', 'product');
		$this->load->model('Category_model', 'category');
		$this->load->library('pagination');
	}
	
	public function index()
	{
		$per_page = 8; 
		$config['base_url'] = base_url().'produk/index/'; 
		$config['total_rows'] = $this->db->get_where('products', ['product_label' => 'Terbaru'])->num_rows(); 
		$config['per_page'] = $per_page; 

		$config["uri_segment"]      = 3; 
		$config['first_link']       = 'First'; 
		$config['last_link']        = 'Last'; 
		$config['next_link']        = 'Next'; 
		$config['prev_link']        = 'Prev'; 
		$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination">'; 
		$config['full_tag_close']   = '</ul></nav></div>'; 
		$config['num_tag_open']     = '<li class="page-item"><span class="page-link">'; 
		$config['num_tag_close']    = '</span></li>'; 
		$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">'; 
		$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>'; 
		$config['next_tag_open']    = '<li class="page-item"><span class="page-link">'; 
		$config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>'; 
		$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">'; 
		$config['prev_tagl_close']  = '</span>Next</li>'; 
		$config['first_tag_open']   = '<li class="page-item"><span class="page-link">'; 
		$config['first_tagl_close'] = '</span></li>'; 
		$config['last_tag_open']    = '<li class="page-item"><span class="page-link">'; 
		$config['last_tagl_close']  = '</span></li>'; 
		$config['reuse_query_string']  = TRUE;

		$this->pagination->initialize($config);

		if($this->uri->segment(3)){
			$page = $this->uri->segment(3);
		} else {
			$page = 0;
		}

		$product_baru = $this->product->getProductBaruPaginate($per_page, $page);
		$data = [
            'judul'     => 'Product',
			'content'	=> 'produk/index',
			'page' 		=> true,
			'seo'		=> 'product_index',
			'product_laris' => $this->product->getProductBy('Laris'),
			'total_product_laris' => $this->db->get_where('products', ['product_label' => 'Laris'])->num_rows(),
			'total_product_baru' => $this->db->where('product_label', 'Terbaru')->get("products")->num_rows(),
			'product_baru' 	=> $product_baru
		];
		$this->load->view('template', $data);
	}
	
    public function beli($slug = null)
	{
		$product = $this->product->getProductBySlug($slug);

		if(!empty($product['product_discount'])){
			$diskon = $product['product_price'] * $product['product_discount'] / 100;
			$harga = intval($product['product_price'] - $diskon);
		} else {
			$harga = $product['product_price'];
		}

		// var_dump($product);
		if($product > 0){

			$cart = array(
				'id'		=> $product['product_id'],
				'qty'     	=> 1,
				'price'   	=> $harga,
				'name'    	=> $product['product_name'],
				'image' 	=> $product['product_image'],
				'catatan'	=> ''
			);
		
			$this->cart->insert($cart);
			redirect(base_url('cart'));
			
		} else {
			redirect(base_url('error_404'));
		}
	}
    public function detail($slug = null)
	{
		$product = $this->product->getProductBySlug($slug);

		if($product > 0){
			
			$id 	= $product['product_id'];
			$view 	= $product['product_view'];
			
			$view_plus = [
				'product_view' => $view + 1
			];
			
			$this->product->update($view_plus, $id);

			$data = [
				'judul'     => "Jual ".$product['product_name'],
				'content'	=> 'produk/detail',
				'product'	=> $product,
				'page' 		=> true,
				'seo'		=> 'product_detail'
			];
			$this->load->view('template', $data);
		} else {
			redirect(base_url('error_404'));
		}
	}

	public function kategori($slug = null)
	{
		$category = $this->category->getCategoryBySlug($slug);

		if(!empty($category)){
			
			$id 			= $category['category_id'];

			$product_laris 	= $this->product->getProductLarisByCategory($id);

			$per_page = 8; 
			$config['base_url'] = base_url().'kategori/'.$category['category_slug'].'/index/'; 
			$config['total_rows'] = $this->db->get_where('products', ['category_id' => $id, 'product_label' => 'Terbaru'])->num_rows(); 
			$config['per_page'] = $per_page; 

			$config["uri_segment"]      = 4; 
			$config['first_link']       = 'First'; 
			$config['last_link']        = 'Last'; 
			$config['next_link']        = 'Next'; 
			$config['prev_link']        = 'Prev'; 
			$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination">'; 
			$config['full_tag_close']   = '</ul></nav></div>'; 
			$config['num_tag_open']     = '<li class="page-item"><span class="page-link">'; 
			$config['num_tag_close']    = '</span></li>'; 
			$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">'; 
			$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>'; 
			$config['next_tag_open']    = '<li class="page-item"><span class="page-link">'; 
			$config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>'; 
			$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">'; 
			$config['prev_tagl_close']  = '</span>Next</li>'; 
			$config['first_tag_open']   = '<li class="page-item"><span class="page-link">'; 
			$config['first_tagl_close'] = '</span></li>'; 
			$config['last_tag_open']    = '<li class="page-item"><span class="page-link">'; 
			$config['last_tagl_close']  = '</span></li>'; 
			$config['reuse_query_string']  = TRUE;

			$this->pagination->initialize($config);

			if($this->uri->segment(4)){
				$page = $this->uri->segment(4);
			} else {
				$page = 0;
			}

			$product_baru 	= $this->product->getProductBaruByCategory($id, $per_page, $page);

			$data = [
				'judul'     => "Kategori ".$category['category_name'],
				'content'	=> 'kategori/detail',
				'product_baru'=> $product_baru,
				'product_laris'=> $product_laris,
				'page' 		=> true,
				'seo'		=> 'kategori_detail',
				'category' => $category,
				'total_product_laris' => $this->db->get_where('products', ['product_label' => 'Laris'])->num_rows(),
				'total_product_baru' => $this->db->where(['product_label' => 'Terbaru', 'category_id' => $id])->get("products")->num_rows(),
			];
			$this->load->view('template', $data);
		} else {
			redirect(base_url('error_404'));
		}
	}

	public function search()
	{
		$keyword= $this->input->get('q');
			

			$product_laris 	= $this->db->get_where('products', ['product_label' => 'Laris'])->result_array(); 

			$per_page = 8; 
			$config['base_url'] = base_url().'search/index/'; 
			$config['total_rows'] = $this->db->get_where('products', ['product_label' => 'Terbaru'])->num_rows(); 
			$config['per_page'] = $per_page; 

			$config["uri_segment"]      = 3; 
			$config['first_link']       = 'First'; 
			$config['last_link']        = 'Last'; 
			$config['next_link']        = 'Next'; 
			$config['prev_link']        = 'Prev'; 
			$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination">'; 
			$config['full_tag_close']   = '</ul></nav></div>'; 
			$config['num_tag_open']     = '<li class="page-item"><span class="page-link">'; 
			$config['num_tag_close']    = '</span></li>'; 
			$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">'; 
			$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>'; 
			$config['next_tag_open']    = '<li class="page-item"><span class="page-link">'; 
			$config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>'; 
			$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">'; 
			$config['prev_tagl_close']  = '</span>Next</li>'; 
			$config['first_tag_open']   = '<li class="page-item"><span class="page-link">'; 
			$config['first_tagl_close'] = '</span></li>'; 
			$config['last_tag_open']    = '<li class="page-item"><span class="page-link">'; 
			$config['last_tagl_close']  = '</span></li>'; 
			$config['reuse_query_string']  = TRUE;

			$this->pagination->initialize($config);

			if($this->uri->segment(3)){
				$page = $this->uri->segment(3);
			} else {
				$page = 0;
			}

			$product_baru 	= $this->product->getProductBaruByKeyword($keyword, $per_page, $page);

			$data = [
				'judul'     => "Hasil Pencarian Produk: ".$keyword,
				'content'	=> 'produk/search',
				'product_baru'=> $product_baru,
				'product_laris'=> $product_laris,
				'page' 		=> true,
				'total_product_baru' => $this->db->where('product_label', 'Terbaru')
					->like('product_name', $keyword)
					->or_like('product_code', $keyword)
					->or_like('product_keyword', $keyword)
					->or_like('product_desc', $keyword)
					->or_like('product_content', $keyword)
					->get('products')
					->num_rows(),
				'total_product_laris' => $this->db->get_where('products', ['product_label' => 'Laris'])->num_rows(),
			];
			$this->load->view('template', $data);
		
	}
}
