<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin90 extends CI_Controller {

    public function __construct() {

		parent::__construct();
		// memanggil Auth_model as $this->auth
        $this->load->model('Auth_model', 'auth');
        $this->load->model('Category_model', 'category');
        $this->load->model('Product_model', 'product');
        $this->load->model('Order_model', 'order');
        $this->load->model('Invoice_model', 'invoice');
        $this->load->model('Page_model', 'page');
        $this->load->model('Admin_model', 'admin');
    
    }

    // MODUL DASHBOARD

    public function index()
    {
        if($this->session->userdata('status') != "Y" && $this->session->userdata('level') != 1 && $this->session->userdata('verified') != 1){
            // redirect 404
            redirect(base_url('error-404'));
        }

        $data = [
            'content'	    => 'admin99/dashboard',
            'order_baru'    => $this->order->countOrderBaru(),
            'category'      => $this->category->countCategory(),
            'product'       => $this->product->countProduct(),
            'seller'        => $this->order->countOrderSelesai(),
            'orders'        => $this->order->getOrderBaru('order_id', 'desc'),
            'plugin_datatable' => true
        ];
        // var_dump($data['order_baru']);
        $this->load->view('admin99/template', $data);
    }

    public function dashboard()
    {
        if($this->session->userdata('status') != "Y" && $this->session->userdata('level') != 1 && $this->session->userdata('verified') != 1){
            // redirect 404
            redirect(base_url('error-404'));
        }

        $data = [
            'content'	    => 'admin99/dashboard',
            'order_baru'    => $this->order->countOrderBaru(),
            'category'      => $this->category->countCategory(),
            'product'       => $this->product->countProduct(),
            'seller'        => $this->order->countOrderSelesai(),
            'orders'        => $this->order->getOrderBaru('order_id', 'desc'),
            'plugin_datatable' => true
        ];
        // var_dump($data['kategori']);
        $this->load->view('admin99/template', $data);
    }

    // MODUL KATEGORI

    public function kategori()
    {
        if($this->session->userdata('status') != "Y" && $this->session->userdata('level') != 1 && $this->session->userdata('verified') != 1){
            // redirect 404
            redirect(base_url('error-404'));
        }

        $data = [
            'judul' 	=> 'Modul Kategori',
            'content'	=> 'admin99/kategori/index',
            'kategori'  => $this->category->getCategory(),
            'plugin_datatable' => true
        ];
        $this->load->view('admin99/template', $data);
    }

    public function tambah_kategori()
    {
        if($this->session->userdata('status') != "Y" && $this->session->userdata('level') != 1 && $this->session->userdata('verified') != 1){
            // redirect 404
            redirect(base_url('error-404'));
        }

        $data = [
            'judul' 	=> 'Tambah Kategori',
            'content'	=> 'admin99/kategori/create'
        ];
        $this->load->view('admin99/template', $data);
    }

    public function store_kategori()
    {
        $name           = $this->input->post('category_name');
        $slug           = set_linkurl($name);
        $status         = $this->input->post('category_status');
        $keyword        = $this->input->post('category_keyword');
        $desc           = $this->input->post('category_desc');
        $thumbnail      = $this->input->post('category_thumbnail');

        $data = [
            'category_name'     => $name,
            'category_slug'     => $slug,
            'category_status'   => $status,
            'category_keyword'  => $keyword,
            'category_desc'     => $desc,
            'category_thumbnail'=> $thumbnail,
            'created_at'        => date('Y-m-d H:i:s')
        ];

        $simpan = $this->category->insert($data);

        if($simpan == true){
            $this->session->set_flashdata('success', 'Berhasil Menyimpan Data Kategori');
            redirect(base_url('admin90/kategori'));
        } else {
            $this->session->set_flashdata('error', 'Gagal Menyimpan Data Kategori');
            redirect(base_url('admin90/kategori'));
        }
    }

    public function edit_kategori($id = null)
    {
        if($this->session->userdata('status') != "Y" && $this->session->userdata('level') != 1 && $this->session->userdata('verified') != 1){
            // redirect 404
            redirect(base_url('error-404'));
        }

        $category       = $this->category->getCategory($id);

        if($category == NULL OR empty($category)){
            $this->session->set_flashdata('error', 'Gagal Memuat Data Kategori');
            redirect(base_url('admin90/kategori'));
        }

        $data = [
            'judul' 	=> 'Edit Kategori',
            'content'	=> 'admin99/kategori/edit',
            'category'  => $category
        ];
        $this->load->view('admin99/template', $data);
    }

    public function detail_kategori($id = null)
    {
        if($this->session->userdata('status') != "Y" && $this->session->userdata('level') != 1 && $this->session->userdata('verified') != 1){
            // redirect 404
            redirect(base_url('error-404'));
        }

        $category       = $this->category->getCategory($id);

        if($category == NULL OR empty($category)){
            $this->session->set_flashdata('error', 'Gagal Memuat Data Kategori');
            redirect(base_url('admin90/kategori'));
        }

        $data = [
            'judul' 	=> 'Detail Kategori',
            'content'	=> 'admin99/kategori/show',
            'category'  => $category
        ];
        $this->load->view('admin99/template', $data);
    }

    public function update_kategori($id = null)
    {
        if($this->session->userdata('status') != "Y" && $this->session->userdata('level') != 1 && $this->session->userdata('verified') != 1){
            // redirect 404
            redirect(base_url('error-404'));
        }

        $category       = $this->category->getCategory($id);

        if($category == NULL OR empty($category)){
            $this->session->set_flashdata('error', 'Gagal Memuat Data Kategori');
            redirect(base_url('admin90/kategori'));
        }

        $name           = $this->input->post('category_name');
        $slug           = set_linkurl($name);
        $status         = $this->input->post('category_status');
        $keyword        = $this->input->post('category_keyword');
        $desc           = $this->input->post('category_desc');
        $thumbnail      = $this->input->post('category_thumbnail');

        $data = [
            'category_name'     => $name,
            'category_slug'     => $slug,
            'category_status'   => $status,
            'category_keyword'  => $keyword,
            'category_desc'     => $desc,
            'category_thumbnail'=> $thumbnail,
            'updated_at'        => date('Y-m-d H:i:s')
        ];

        $ubah = $this->category->update($data, $id);

        if($ubah == true){
            $this->session->set_flashdata('info', 'Berhasil Mengubah Data Kategori');
            redirect(base_url('admin90/kategori'));
        } else {
            $this->session->set_flashdata('error', 'Gagal Menyimpan Data Kategori');
            redirect(base_url('admin90/kategori'));
        }
    }

    public function delete_kategori($id = null)
    {
        if($this->session->userdata('status') != "Y" && $this->session->userdata('level') != 1 && $this->session->userdata('verified') != 1){
            // redirect 404
            redirect(base_url('error-404'));
        }

        $category       = $this->category->getCategory($id);

        if($category == NULL OR empty($category)){
            $this->session->set_flashdata('error', 'Gagal Memuat Data Kategori');
            redirect(base_url('admin90/kategori'));
        }

        $hapus = $this->category->delete($id);

        if($hapus == true){
            $this->session->set_flashdata('warning', 'Berhasil Menghapus Data Kategori');
            redirect(base_url('admin90/kategori'));
        } else {
            $this->session->set_flashdata('error', 'Gagal Menyimpan Data Kategori');
            redirect(base_url('admin90/kategori'));
        }
    }

    // MODUL PRODUK

    public function produk()
    {
        if($this->session->userdata('status') != "Y" && $this->session->userdata('level') != 1 && $this->session->userdata('verified') != 1){
            // redirect 404
            redirect(base_url('error-404'));
        }

        $data = [
            'judul' 	=> 'Modul Produk',
            'content'	=> 'admin99/produk/index',
            'product'   => $this->product->getProduct(),
            'plugin_datatable' => true
        ];
        $this->load->view('admin99/template', $data);
    }

    public function tambah_produk()
    {
        if($this->session->userdata('status') != "Y" && $this->session->userdata('level') != 1 && $this->session->userdata('verified') != 1){
            // redirect 404
            redirect(base_url('error-404'));
        }

        $categories = $this->category->getCategory();
        $categories = ['' => 'Pilih Kategori'] + array_column($categories, 'category_name', 'category_id');
        $data = [
            'judul' 	=> 'Tambah Produk',
            'content'	=> 'admin99/produk/create',
            'categories'=> $categories,
            'plugin_upload' => true,
            'plugin_summernote' => true
        ];
        $this->load->view('admin99/template', $data);
    }

    public function store_produk()
    {
        if($this->session->userdata('status') != "Y" && $this->session->userdata('level') != 1 && $this->session->userdata('verified') != 1){
            // redirect 404
            redirect(base_url('error-404'));
        }

        $this->form_validation->set_rules('product_code', 'Kode Produk', 'required');
        $this->form_validation->set_rules('product_name', 'Nama Produk', 'required');
        $this->form_validation->set_rules('product_price', 'Harga Produk', 'required');
        $this->form_validation->set_rules('product_stok', 'Stok Produk', 'required');
        $this->form_validation->set_rules('product_weight', 'Berat Produk', 'required');
        // $this->form_validation->set_rules('product_discount', 'Diskon Produk', 'required');
        $this->form_validation->set_rules('product_keyword', 'Keyword Produk', 'required');
        $this->form_validation->set_rules('product_desc', 'Deskripsi Produk', 'required');
        $this->form_validation->set_rules('product_label', 'Label Produk', 'required');
        $this->form_validation->set_rules('category_id', 'Kategori Produk', 'required');
        // $this->form_validation->set_rules('product_ragam_warna', 'Kode Produk', 'required');
        // $this->form_validation->set_rules('product_ragam_ukuran', 'Kode Produk', 'required');
        $this->form_validation->set_rules('product_content', 'Konten Produk', 'required');
        // $this->form_validation->set_rules('product_image', 'Gambar Produk', 'required');

        $code           = $this->input->post('product_code');
        $name           = $this->input->post('product_name');
        $price          = $this->input->post('product_price');
        $stok           = $this->input->post('product_stok');
        $weight         = $this->input->post('product_weight');
        $discount       = $this->input->post('product_discount');
        $keyword        = $this->input->post('product_keyword');
        $desc           = $this->input->post('product_desc');
        $label          = $this->input->post('product_label');
        $category       = $this->input->post('category_id');
        $warna          = $this->input->post('product_ragam_warna');
        $ukuran         = $this->input->post('product_ragam_ukuran');
        $content        = $this->input->post('product_content');
        $slug           = set_linkurl($name);

        if($this->form_validation->run() == FALSE){

            $errors = $this->form_validation->error_array();
            $this->session->set_flashdata('errors', $errors);
            $this->session->set_flashdata('inputs', $this->input->post());
			redirect(base_url('admin90/produk/tambah'));

        } else {

            if(!empty($_FILES['product_image']['name'])){ // Jika terjadi upload gambar
                    
                // upload gambar baru
                $config['upload_path'] = "./assets/img/product/";
                $config['allowed_types'] = "gif|jpg|png|jpeg";
                $config['max_size'] = "3000"; // format kb
                $config['max_width'] = "3000"; // width = 1000px
                $config['max_height'] = "3000"; // height = 800px

                $this->load->library('upload', $config);

                $this->upload->initialize($config);

                if(!$this->upload->do_upload('product_image')){
                    // tampilkan pesan error
                    $errors = array('errors' => $this->upload->display_errors());
                    $this->session->set_flashdata('errors', $errors);
                    $this->session->set_flashdata('inputs', $this->input->post());

                    redirect('admin90/produk/tambah');
                
                } else { // jika berhasil melewati validasi gambar

                    $image 			= $this->upload->data('file_name');

                    $data = [
                        'product_code'          => $code,
                        'product_name'          => $name,
                        'product_slug'          => $slug,
                        'product_price'         => $price,
                        'product_stok'          => $stok,
                        'product_weight'        => $weight,
                        'product_discount'      => $discount,
                        'product_keyword'       => $keyword,
                        'product_desc'          => $desc,
                        'product_label'         => $label,
                        'category_id'           => $category,
                        'product_ragam_warna'   => $warna,
                        'product_ragam_ukuran'  => $ukuran,
                        'product_content'       => $content,
                        'product_image'         => $image,
                        'product_view'          => 0,
                        'created_at'            => date('Y-m-d H:i:s')
                    ];
                
                }
            } else {
                $data = [
                    'product_code'          => $code,
                    'product_name'          => $name,
                    'product_slug'          => $slug,
                    'product_price'         => $price,
                    'product_stok'          => $stok,
                    'product_weight'        => $weight,
                    'product_discount'      => $discount,
                    'product_keyword'       => $keyword,
                    'product_desc'          => $desc,
                    'product_label'         => $label,
                    'category_id'           => $category,
                    'product_ragam_warna'   => $warna,
                    'product_ragam_ukuran'  => $ukuran,
                    'product_content'       => $content,
                    'product_image'         => 'no-product.jpg',
                    'product_view'          => 0,
                    'created_at'            => date('Y-m-d H:i:s')
                ];

            }

            $simpan = $this->product->insert($data);

            if($simpan == true){
                $this->session->set_flashdata('success', 'Berhasil Menyimpan Data produk');
                redirect(base_url('admin90/produk'));
            } else {
                $this->session->set_flashdata('error', 'Gagal Menyimpan Data produk');
                redirect(base_url('admin90/produk'));
            }

        } // end validation
    }

    public function edit_produk($id = null)
    {
        if($this->session->userdata('status') != "Y" && $this->session->userdata('level') != 1 && $this->session->userdata('verified') != 1){
            // redirect 404
            redirect(base_url('error-404'));
        }

        $product       = $this->product->getProduct($id);

        if($product == NULL OR empty($product)){
            $this->session->set_flashdata('error', 'Gagal Memuat Data produk');
            redirect(base_url('admin90/produk'));
        }

        $categories = $this->category->getCategory();
        $categories = ['' => 'Pilih Kategori'] + array_column($categories, 'category_name', 'category_id');

        $data = [
            'judul' 	=> 'Edit Produk',
            'content'	=> 'admin99/produk/edit',
            'product'   => $product,
            'categories'=> $categories,
            'plugin_summernote' => true
        ];
        $this->load->view('admin99/template', $data);
    }

    public function detail_produk($id = null)
    {
        if($this->session->userdata('status') != "Y" && $this->session->userdata('level') != 1 && $this->session->userdata('verified') != 1){
            // redirect 404
            redirect(base_url('error-404'));
        }

        $product       = $this->product->getProduct($id);

        if($product == NULL OR empty($product)){
            $this->session->set_flashdata('error', 'Gagal Memuat Data produk');
            redirect(base_url('admin90/produk'));
        }

        $categories = $this->category->getCategory();
        $categories = ['' => 'Pilih Kategori'] + array_column($categories, 'category_name', 'category_id');

        $data = [
            'judul' 	=> 'Edit Produk',
            'content'	=> 'admin99/produk/show',
            'product'   => $product,
            'categories'=> $categories
        ];
        $this->load->view('admin99/template', $data);
    }

    public function update_produk($id = null)
    {
        if($this->session->userdata('status') != "Y" && $this->session->userdata('level') != 1 && $this->session->userdata('verified') != 1){
            // redirect 404
            redirect(base_url('error-404'));
        }

        $this->form_validation->set_rules('product_code', 'Kode Produk', 'required');
        $this->form_validation->set_rules('product_name', 'Nama Produk', 'required');
        $this->form_validation->set_rules('product_price', 'Harga Produk', 'required');
        $this->form_validation->set_rules('product_stok', 'Stok Produk', 'required');
        $this->form_validation->set_rules('product_weight', 'Berat Produk', 'required');
        // $this->form_validation->set_rules('product_discount', 'Diskon Produk', 'required');
        $this->form_validation->set_rules('product_keyword', 'Keyword Produk', 'required');
        $this->form_validation->set_rules('product_desc', 'Deskripsi Produk', 'required');
        $this->form_validation->set_rules('product_label', 'Label Produk', 'required');
        $this->form_validation->set_rules('category_id', 'Kategori Produk', 'required');
        // $this->form_validation->set_rules('product_ragam_warna', 'Kode Produk', 'required');
        // $this->form_validation->set_rules('product_ragam_ukuran', 'Kode Produk', 'required');
        $this->form_validation->set_rules('product_content', 'Konten Produk', 'required');
        // $this->form_validation->set_rules('product_image', 'Gambar Produk', 'required');

        $code           = $this->input->post('product_code');
        $name           = $this->input->post('product_name');
        $price          = $this->input->post('product_price');
        $stok           = $this->input->post('product_stok');
        $weight         = $this->input->post('product_weight');
        $discount       = $this->input->post('product_discount');
        $keyword        = $this->input->post('product_keyword');
        $desc           = $this->input->post('product_desc');
        $label          = $this->input->post('product_label');
        $category       = $this->input->post('category_id');
        $warna          = $this->input->post('product_ragam_warna');
        $ukuran         = $this->input->post('product_ragam_ukuran');
        $content        = $this->input->post('product_content');
        $slug           = set_linkurl($name);

        if($this->form_validation->run() == FALSE){

            $errors = $this->form_validation->error_array();
            $this->session->set_flashdata('errors', $errors);
            $this->session->set_flashdata('inputs', $this->input->post());
			redirect(base_url('admin90/produk/tambah'));

        } else {

            if(!empty($_FILES['product_image']['name'])){ // Jika terjadi upload gambar
                    
                // upload gambar baru
                $config['upload_path'] = "./assets/img/product/";
                $config['allowed_types'] = "gif|jpg|png|jpeg";
                $config['max_size'] = "3000"; // format kb
                $config['max_width'] = "3000"; // width = 1000px
                $config['max_height'] = "3000"; // height = 800px

                $this->load->library('upload', $config);

                $this->upload->initialize($config);

                if(!$this->upload->do_upload('product_image')){
                    // tampilkan pesan error
                    $errors = array('errors' => $this->upload->display_errors());
                    $this->session->set_flashdata('errors', $errors);
                    $this->session->set_flashdata('inputs', $this->input->post());

                    redirect('admin90/produk/tambah');
                
                } else { // jika berhasil melewati validasi gambar

                    $image 			= $this->upload->data('file_name');

                    $data = [
                        'product_code'          => $code,
                        'product_name'          => $name,
                        'product_slug'          => $slug,
                        'product_price'         => $price,
                        'product_stok'          => $stok,
                        'product_weight'        => $weight,
                        'product_discount'      => $discount,
                        'product_keyword'       => $keyword,
                        'product_desc'          => $desc,
                        'product_label'         => $label,
                        'category_id'           => $category,
                        'product_ragam_warna'   => $warna,
                        'product_ragam_ukuran'  => $ukuran,
                        'product_content'       => $content,
                        'product_image'         => $image,
                        'product_view'          => 0,
                        'created_at'            => date('Y-m-d H:i:s')
                    ];
                
                }
            } else {
                $data = [
                    'product_code'          => $code,
                    'product_name'          => $name,
                    'product_slug'          => $slug,
                    'product_price'         => $price,
                    'product_stok'          => $stok,
                    'product_weight'        => $weight,
                    'product_discount'      => $discount,
                    'product_keyword'       => $keyword,
                    'product_desc'          => $desc,
                    'product_label'         => $label,
                    'category_id'           => $category,
                    'product_ragam_warna'   => $warna,
                    'product_ragam_ukuran'  => $ukuran,
                    'product_content'       => $content,
                    'product_view'          => 0,
                    'created_at'            => date('Y-m-d H:i:s')
                ];

            }

            $ubah = $this->product->update($data, $id);

            if($ubah == true){
                $this->session->set_flashdata('info', 'Berhasil Mengubah Data produk');
                redirect(base_url('admin90/produk'));
            } else {
                $this->session->set_flashdata('error', 'Gagal Mengubah Data produk');
                redirect(base_url('admin90/produk'));
            }

        } // end validation
    }

    public function delete_produk($id = null)
    {
        if($this->session->userdata('status') != "Y" && $this->session->userdata('level') != 1 && $this->session->userdata('verified') != 1){
            // redirect 404
            redirect(base_url('error-404'));
        }

        $product       = $this->product->getProduct($id);

        if($product == NULL OR empty($product)){
            $this->session->set_flashdata('error', 'Gagal Memuat Data produk');
            redirect(base_url('admin90/produk'));
        }

        $hapus = $this->product->delete($id);

        if($hapus == true){
            $this->session->set_flashdata('warning', 'Berhasil Menghapus Data produk');
            redirect(base_url('admin90/produk'));
        } else {
            $this->session->set_flashdata('error', 'Gagal Menyimpan Data produk');
            redirect(base_url('admin90/produk'));
        }
    }

    // MODUL PAGE

    public function page()
    {
        if($this->session->userdata('status') != "Y" && $this->session->userdata('level') != 1 && $this->session->userdata('verified') != 1){
            // redirect 404
            redirect(base_url('error-404'));
        }

        $data = [
            'judul' 	=> 'Modul Page',
            'content'	=> 'admin99/page/index',
            'pages'     => $this->page->getPage(),
            'plugin_datatable' => true
        ];
        $this->load->view('admin99/template', $data);
    }

    public function tambah_page()
    {
        if($this->session->userdata('status') != "Y" && $this->session->userdata('level') != 1 && $this->session->userdata('verified') != 1){
            // redirect 404
            redirect(base_url('error-404'));
        }

        $data = [
            'judul' 	=> 'Tambah Page',
            'content'	=> 'admin99/page/create',
            'plugin_tiny' => true
        ];
        $this->load->view('admin99/template', $data);
    }

    public function store_page()
    {
        if($this->session->userdata('status') != "Y" && $this->session->userdata('level') != 1 && $this->session->userdata('verified') != 1){
            // redirect 404
            redirect(base_url('error-404'));
        }

        $title          = $this->input->post('page_title');
        $slug           = set_linkurl($title);
        $keyword        = $title.", page ".$title.", halaman ".$title;
        $desc           = "Halaman ".$title." di DezidMom90.com";
        $content        = $this->input->post('page_content');

        $data = [
            'page_title'     => $title,
            'page_slug'      => $slug,
            'page_keyword'   => $keyword,
            'page_desc'      => $desc,
            'page_content'   => $content,
            'created_at'        => date('Y-m-d H:i:s')
        ];

        $simpan = $this->page->insert($data);

        if($simpan == true){
            $this->session->set_flashdata('success', 'Berhasil Menyimpan Data Page');
            redirect(base_url('admin90/page'));
        } else {
            $this->session->set_flashdata('error', 'Gagal Menyimpan Data Page');
            redirect(base_url('admin90/page'));
        }
    }

    public function edit_page($id = null)
    {
        if($this->session->userdata('status') != "Y" && $this->session->userdata('level') != 1 && $this->session->userdata('verified') != 1){
            // redirect 404
            redirect(base_url('error-404'));
        }

        $page       = $this->page->getpage($id);

        if($page == NULL OR empty($page)){
            $this->session->set_flashdata('error', 'Gagal Memuat Data Page');
            redirect(base_url('admin90/page'));
        }

        $data = [
            'judul' 	=> 'Edit Page',
            'content'	=> 'admin99/page/edit',
            'page'      => $page,
            'plugin_tiny' => true
        ];
        $this->load->view('admin99/template', $data);
    }

    public function update_page($id = null)
    {
        if($this->session->userdata('status') != "Y" && $this->session->userdata('level') != 1 && $this->session->userdata('verified') != 1){
            // redirect 404
            redirect(base_url('error-404'));
        }

        $title          = $this->input->post('page_title');
        $slug           = set_linkurl($title);
        $keyword        = $title.", page ".$title.", halaman ".$page;
        $desc           = "Halaman ".$title." di DezidMom90.com";
        $content        = $this->input->post('page_content');

        $data = [
            'page_title'     => $title,
            'page_slug'      => $slug,
            'page_keyword'   => $keyword,
            'page_desc'      => $desc,
            'page_content'   => $content,
            'updated_at'     => date('Y-m-d H:i:s')
        ];

        $ubah = $this->page->update($data, $id);

        if($ubah == true){
            $this->session->set_flashdata('info', 'Berhasil Mengubah Data Page');
            redirect(base_url('admin90/page'));
        } else {
            $this->session->set_flashdata('error', 'Gagal Mengubah Data Page');
            redirect(base_url('admin90/page'));
        }
    }

    public function delete_page($id = null)
    {
        if($this->session->userdata('status') != "Y" && $this->session->userdata('level') != 1 && $this->session->userdata('verified') != 1){
            // redirect 404
            redirect(base_url('error-404'));
        }

        $page       = $this->page->getpage($id);

        if($page == NULL OR empty($page)){
            $this->session->set_flashdata('error', 'Gagal Memuat Data Page');
            redirect(base_url('admin90/page'));
        }

        $hapus = $this->page->delete($id);

        if($hapus == true){
            $this->session->set_flashdata('warning', 'Berhasil Menghapus Data Page');
            redirect(base_url('admin90/page'));
        } else {
            $this->session->set_flashdata('error', 'Gagal Menyimpan Data Page');
            redirect(base_url('admin90/page'));
        }
    }

    // MODUL ORDER

    public function order()
    {
        if($this->session->userdata('status') != "Y" && $this->session->userdata('level') != 1 && $this->session->userdata('verified') != 1){
            // redirect 404
            redirect(base_url('error-404'));
        }

        $data = [
            'judul' 	=> 'Modul Order',
            'content'	=> 'admin99/order/index',
            'order'     => $this->order->getOrder(),
            'plugin_datatable' => true
        ];
        $this->load->view('admin99/template', $data);
    }

    public function order_detail($id = null)
    {
        if($this->session->userdata('status') != "Y" && $this->session->userdata('level') != 1 && $this->session->userdata('verified') != 1){
            // redirect 404
            redirect(base_url('error-404'));
        }

        $data_order = $this->order->getOrder($id);

        if($data_order != null){

            $inv = $data_order['order_invoice'];
            $data_invoice = $this->invoice->getInvoiceByInv($inv);
        
        }

        $data = [
            'judul' 	=> 'Modul Order',
            'content'	=> 'admin99/order/show',
            'order'     => $data_order,
            'invoice'   => $data_invoice,
            'plugin_datatable' => true
        ];
        $this->load->view('admin99/template', $data);
    }

    public function order_edit($id = null)
    {
        if($this->session->userdata('status') != "Y" && $this->session->userdata('level') != 1 && $this->session->userdata('verified') != 1){
            // redirect 404
            redirect(base_url('error-404'));
        }

        $data_order = $this->order->getOrder($id);

        $data = [
            'judul' 	=> 'Modul Order',
            'content'	=> 'admin99/order/edit',
            'order'     => $data_order
        ];
        $this->load->view('admin99/template', $data);
    }

    public function order_update($id = null)
    {
        if($this->session->userdata('status') != "Y" && $this->session->userdata('level') != 1 && $this->session->userdata('verified') != 1){
            // redirect 404
            redirect(base_url('error-404'));
        }

        $status         = $this->input->post('order_status');
        $resi           = $this->input->post('order_resi');
        $shipping       = $this->input->post('order_shipping');

        $data = [
            'order_status'      => $status,
            'order_resi'        => $resi,
            'order_shipping'    => $shipping
        ];

        $ubah = $this->order->update($data, $id);

        if($ubah == true){
            $this->session->set_flashdata('info', 'Berhasil Mengubah Data Order');
            redirect(base_url('admin90/order'));
        } else {
            $this->session->set_flashdata('error', 'Gagal Mengubah Data Order');
            redirect(base_url('admin90/order'));
        }
    }

    public function order_hapus($id = null)
    {
        if($this->session->userdata('status') != "Y" && $this->session->userdata('level') != 1 && $this->session->userdata('verified') != 1){
            // redirect 404
            redirect(base_url('error-404'));
        }

        $order       = $this->order->getOrder($id);

        if($order == NULL OR empty($order)){
            $this->session->set_flashdata('error', 'Gagal Memuat Data Order');
            redirect(base_url('admin90/order'));
        }

        $hapus = $this->order->delete($id);

        if($hapus == true){
            $this->session->set_flashdata('warning', 'Berhasil Menghapus Data Order');
            redirect(base_url('admin90/order'));
        } else {
            $this->session->set_flashdata('error', 'Gagal Menyimpan Data Order');
            redirect(base_url('admin90/order'));
        }
    }

    // MODUL SETTING

    public function akun()
    {
        if($this->session->userdata('status') != "Y" && $this->session->userdata('level') != 1 && $this->session->userdata('verified') != 1){
            // redirect 404
            redirect(base_url('error-404'));
        }

        $data = [
            'content'	    => 'admin99/akun',
            'setting'       => $this->admin->getAdmin(),
            'plugin_upload' => true
        ];
        // var_dump($data['order_baru']);
        $this->load->view('admin99/template', $data);
    }

    public function update_akun($id = null)
    {
        if($this->session->userdata('status') != "Y" && $this->session->userdata('level') != 1 && $this->session->userdata('verified') != 1){
            // redirect 404
            redirect(base_url('error-404'));
        }
        
        $username     = $this->input->post('admin_username');
        $name         = $this->input->post('admin_name');
        $email        = $this->input->post('admin_email');
        $password     = $this->input->post('admin_password');

        if(!empty($_FILES['admin_image']['name'])){ // Jika terjadi upload gambar
                
            // upload gambar baru
            $config['upload_path'] = "./assets/img/admin/";
            $config['allowed_types'] = "gif|jpg|png|jpeg";
            $config['max_size'] = "3000"; // format kb
            $config['max_width'] = "3000"; // width = 200px
            $config['max_height'] = "3000"; // height = 100px

            $this->load->library('upload', $config);

            $this->upload->initialize($config);

            if(!$this->upload->do_upload('admin_image')){
                // tampilkan pesan error
                $errors = array('errors' => $this->upload->display_errors());
                $this->session->set_flashdata('errors', $errors);
                $this->session->set_flashdata('inputs', $this->input->post());

                redirect('admin90/akun');
            
            } else { // jika berhasil melewati validasi gambar

                $image_admin 	= $this->upload->data('file_name');
                $this->session->set_userdata('image', $image_admin);
            
            }

        } else {
            $admin = $this->admin->getAdmin();
            $image_admin       = $banner['admin_image'];
    
        }

        if($password == null){
            $data = [
                'admin_username'    => $username,
                'admin_name'        => $name,
                'admin_email'       => $email,
                'admin_image'       => $image_admin
            ];
        } else {
            $data = [
                'admin_username'    => $username,
                'admin_name'        => $name,
                'admin_email'       => $email,
                'admin_password'    => password_hash($password, PASSWORD_DEFAULT),
                'admin_image'       => $image_admin
            ];
        }

        $this->session->set_userdata('name', $name);

        $where = ['admin_id' => $id];

        $ubah = $this->admin->update("admin", $data, $where);

        if($ubah == true){
            $this->session->set_flashdata('info', 'Berhasil Mengubah Data Admin');
            redirect(base_url('admin90/akun'));
        } else {
            $this->session->set_flashdata('errors', 'Gagal Mengubah Data Admin');
            redirect(base_url('admin90/akun'));
        }
    }

    public function banner()
    {
        if($this->session->userdata('status') != "Y" && $this->session->userdata('level') != 1 && $this->session->userdata('verified') != 1){
            // redirect 404
            redirect(base_url('error-404'));
        }

        $data = [
            'content'	    => 'admin99/banner',
            'banner'          => $this->admin->getBanner(),
            'plugin_upload' => true
        ];

        $this->load->view('admin99/template', $data);
    }

    public function update_banner($id = null)
    {
        if($this->session->userdata('status') != "Y" && $this->session->userdata('level') != 1 && $this->session->userdata('verified') != 1){
            // redirect 404
            redirect(base_url('error-404'));
        }

        $banner = $this->admin->getBanner();
        
        $title  = $this->input->post('title');
        $link   = $this->input->post('link');

        if(!empty($_FILES['banner_image']['name'])){ // Jika terjadi upload gambar
                
            // upload gambar baru
            $config['upload_path'] = "./assets/img/banner/";
            $config['allowed_types'] = "gif|jpg|png|jpeg";
            $config['max_size'] = "3000"; // format kb
            $config['max_width'] = "3000"; // width = 200px
            $config['max_height'] = "3000"; // height = 100px

            $this->load->library('upload', $config);

            $this->upload->initialize($config);

            if(!$this->upload->do_upload('banner_image')){
                // tampilkan pesan error
                $errors = array('errors' => $this->upload->display_errors());
                $this->session->set_flashdata('errors', $errors);
                $this->session->set_flashdata('inputs', $this->input->post());

                redirect('admin90/banner');
            
            } else { // jika berhasil melewati validasi gambar

                $image_banner 	= $this->upload->data('file_name');
            
            }

        } else {

            $image_banner       = $banner['banner_image'];
    
        }

        $data = [
            'banner_title'      => $title,
            'banner_link'       => $link,
            'banner_image'      => $image_banner
        ];

        $where = ['banner_id' => $id];

        $ubah = $this->admin->update("banner", $data, $where);

        if($ubah == true){
            $this->session->set_flashdata('info', 'Berhasil Mengubah Data Banner');
            redirect(base_url('admin90/banner'));
        } else {
            $this->session->set_flashdata('errors', 'Gagal Mengubah Data Banner');
            redirect(base_url('admin90/banner'));
        }
    }

    // MODULE TOKO

    public function toko()
    {
        if($this->session->userdata('status') != "Y" && $this->session->userdata('level') != 1 && $this->session->userdata('verified') != 1){
            // redirect 404
            redirect(base_url('error-404'));
        }

        $data = [
            'content'	    => 'admin99/toko',
            'toko'          => $this->admin->getToko(),
            'plugin_upload' => true
        ];
        // var_dump($data['order_baru']);
        $this->load->view('admin99/template', $data);
    }

    public function update_toko($id = null)
    {
        if($this->session->userdata('status') != "Y" && $this->session->userdata('level') != 1 && $this->session->userdata('verified') != 1){
            // redirect 404
            redirect(base_url('error-404'));
        }

        $toko = $this->db->get_where('toko', ['toko_id' => $id])->row_array();
        
        $name         = $this->input->post('toko_name');
        $slogan       = $this->input->post('toko_slogan');
        $wa1          = $this->input->post('toko_wa1');
        $wa2          = $this->input->post('toko_wa2');
        $email        = $this->input->post('toko_email');
        $jadwal       = $this->input->post('toko_jadwal_buka');
        $fb           = $this->input->post('toko_fb');
        $tw           = $this->input->post('toko_tw');
        $ig           = $this->input->post('toko_ig');
        $yt           = $this->input->post('toko_yt');
        $gsv          = $this->input->post('toko_gsv');
        $bing         = $this->input->post('toko_bing');
        $ga           = $this->input->post('toko_ga');
        $color        = $this->input->post('toko_dominan_color');
        $keyword      = $this->input->post('toko_keyword');
        $desc         = $this->input->post('toko_desc');
        $address      = $this->input->post('toko_address');
        $bank         = str_replace('<br />', '', $this->input->post('toko_bank'));
        $bank         = nl2br($bank);

        if(!empty($_FILES['toko_logo']['name'])){ // Jika terjadi upload gambar
                
            // upload gambar baru
            $config['upload_path'] = "./assets/img/";
            $config['allowed_types'] = "gif|jpg|png|jpeg";
            $config['max_size'] = "3000"; // format kb
            $config['max_width'] = "200"; // width = 200px
            $config['max_height'] = "100"; // height = 100px

            $this->load->library('upload', $config);

            $this->upload->initialize($config);

            if(!$this->upload->do_upload('toko_logo')){
                // tampilkan pesan error
                $errors = array('errors' => $this->upload->display_errors());
                $this->session->set_flashdata('errors', $errors);
                $this->session->set_flashdata('inputs', $this->input->post());

                redirect('admin90/toko');
            
            } else { // jika berhasil melewati validasi gambar

                $image_toko 			= $this->upload->data('file_name');
            
            }

        } else {

            $image_toko             = $toko['toko_logo'];
    
        }

        if(!empty($_FILES['toko_favicon']['name'])){ // Jika terjadi upload gambar
                
            // upload gambar baru
            $config['upload_path'] = "./assets/img/";
            $config['allowed_types'] = "gif|jpg|png|jpeg";
            $config['max_size'] = "3000"; // format kb
            $config['max_width'] = "200"; // width = 200px
            $config['max_height'] = "100"; // height = 100px

            $this->load->library('upload', $config);

            $this->upload->initialize($config);

            if(!$this->upload->do_upload('toko_favicon')){
                // tampilkan pesan error
                $errors = array('errors' => $this->upload->display_errors());
                $this->session->set_flashdata('errors', $errors);
                $this->session->set_flashdata('inputs', $this->input->post());

                redirect('admin90/toko');
            
            } else { // jika berhasil melewati validasi gambar

                $image_favicon			= $this->upload->data('file_name');
            
            }

        } else {

            $image_favicon             = $toko['image_favicon'];
    
        }

        $data = [
            'toko_name'         => $name,
            'toko_slogan'       => $slogan,
            'toko_wa1'          => $wa1,
            'toko_wa2'          => $wa2,
            'toko_email'        => $email,
            'toko_jadwal_buka'  => $jadwal,
            'toko_fb'           => $fb,
            'toko_tw'           => $tw,
            'toko_ig'           => $ig,
            'toko_yt'           => $yt,
            'toko_gsv'          => $gsv,
            'toko_bing'         => $bing,
            'toko_ga'           => $ga,
            'toko_dominan_color'=> $color,
            'toko_keyword'      => $keyword,
            'toko_desc'         => $desc,
            'toko_address'      => $address,
            'toko_logo'         => $image_toko,
            'toko_favicon'      => $image_favicon,
            'toko_bank'         => $bank
        ];

        $where = ['toko_id' => $id];

        $ubah = $this->admin->update("toko", $data, $where);

        if($ubah == true){
            $this->session->set_flashdata('info', 'Berhasil Mengubah Data Toko');
            redirect(base_url('admin90/toko'));
        } else {
            $this->session->set_flashdata('errors', 'Gagal Mengubah Data Toko');
            redirect(base_url('admin90/toko'));
        }
    }
}