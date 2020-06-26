<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Product_model', 'product');
        $this->load->model('Order_model', 'order');
        $this->load->model('Invoice_model', 'invoice');
        $this->load->model('Category_model', 'category');
	}
	
	public function index()
	{
		$data = [
			'judul'     => 'Keranjang Belanja',
			'content'	=> 'cart/index',
			'categories'=> $this->category->getCategory(),
			'page'		=> true,
			'plugin_validate' => true
		];

		$this->load->view('template', $data);
	}

	public function update()
	{
		$rowid = $this->input->post('rowid');
		$qty = $this->input->post('qty');
		$catatan = $this->input->post('catatan');

		for($i = 0; $i < count($rowid); $i++){
			$data = array(
				'rowid' => $rowid[$i],
				'qty'	=> $qty[$i],
				'catatan'	=> $catatan[$i]
			);
			$this->cart->update($data);
		}
		redirect(base_url('cart'));
	}

	public function delete($rowid = null)
	{
		$data = array(
			'rowid' => $rowid,
			'qty'	=> 0
		);
		
		$this->cart->update($data);
		
		redirect(base_url('cart'));
	}

	public function checkout()
	{
		$inv	= rand(000000, 999999);
		// cek invoice di database
		$cek_inv = $this->invoice->cek_invoice($inv);
		// bila ada kesamaan invoice di database
		if($cek_inv > 0){
			// random lagi
			$inv = rand(111111, 999999);
		}

		foreach ($this->cart->contents() as $items){

			$id 	= $items['id'];			
			$name 	= $items['name'];			
			$price 	= $items['price'];			
			$qty 	= $items['qty'];			
			$sub 	= $items['subtotal'];	
			$catatan= $items['catatan'];	
			
			// insert to table invoice
			$data_invoice = [
				'invoice_code'		=> $inv,
				'product_id'		=> $id,
				'invoice_qty'		=> $qty,
				'invoice_subtotal'	=> $sub,
				'invoice_catatan'	=> $catatan
			];

			$insert_invoice = $this->invoice->insert($data_invoice);
		}

		$total 	= $this->cart->total();
		$nama	= $this->input->post('nama');
		$no		= $this->input->post('wa');
		$email	= $this->input->post('email');
		$alamat	= $this->input->post('alamat');
		$tgl 	= date('Y-m-d H:i:s');
		$status	= 'Order Baru';

		// insert to table order
		$data_order = [
			'order_invoice'		=> $inv,
			'order_name' 		=> $nama,
			'order_email' 		=> $email,
			'order_wa' 			=> $no,
			'order_address'		=> $alamat,
			'order_tgl'			=> $tgl,
			'order_status'		=> $status,
			'order_total'		=> $total
		];

		$insert_order = $this->order->insert($data_order);

		if($insert_invoice == true && $insert_order == true){

			// if checkout berhasil
			// 1. hapus cart
			$this->cart->destroy();
			// 2. ambil data order total by invoice
			$order = $this->invoice->getOrderByInv($inv);
			$totals = "Rp. ".number_format($order['order_total'], 0, 0, ".");
			// 3. tampilkan halaman checkout
			$this->finish();
			// 4. get no wa admin
			$toko = $this->db->get_where('toko', ['toko_id' => 1])->row_array();
			$no_wa = $toko['toko_wa1'];
			$bank = $toko['toko_bank'];
			$bank1 = str_replace(', ', '%0A', $bank);
			$bank2 = str_replace(',', '%0A', $bank1);
			$bank3 = str_replace(' ', '%20', $bank2);
			// echo $bank1;
			// 4. send wa
			$send_wa 	= "https://api.whatsapp.com/send?phone=$no_wa&text=Halo%20*Admin%20DezidMom90.com*,%0A%0ASaya%20sudah%20melakukan%20pemesanan%20barang%20dengan%20rincian%20sebagai%20berikut%3A%0A%0AInvoice%3A%20*$inv*%0ATotal%3A%20$totals%0A%0AMohon%20segera%20proses%20pemesanan%20saya.%0A%0A==========================%0A%0ATerima%20kasih%20sudah%20berbelanja%20di%20Toko%20Online%20DezidMom90.com.%0A%0ASilahkan%20lakukan%20pembayaran%20sejumlah%20total%20biaya%20di%20atas%20agar%20pemesanan%20bisa%20segera%20kami%20proses%20melalui%20salah%20satu%20bank%20di%20bawah%20ini%3A%0A%0A$bank3%0A%0AJangan%20lupa%20untuk%20mengirimkan%20bukti%20transfer%20ke%20nomor%20ini%20ya.%0A%0ATerima%20kasih%20banyak.";
			// 3. redirect
			redirect($send_wa);

		}

	}

	public function finish()
	{
		$data = [
			'judul'     => 'Checkout Berhasil',
			'content'	=> 'cart/finish',
			'page'		=> true
		];

		$this->load->view('template', $data);
	}
}
