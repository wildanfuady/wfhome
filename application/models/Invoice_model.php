<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice_model extends CI_Model
{
    protected $table = "invoices";
    protected $tableJoin1 = "products";
    protected $tableJoin2 = "orders";
    protected $primaryKey = "invoice_id";

    public function cek_invoice($inv = null)
    {
        return $this->db->get_where($this->table, ['invoice_code' => $inv])->num_rows();
    }

    public function getInvoiceByInv($inv = null)
    {
        return $this->db->select("invoices.*, products.*")
                        ->from($this->table)
                        ->join($this->tableJoin1, 'invoices.product_id=products.product_id')
                        ->where('invoices.invoice_code', $inv)
                        ->get()
                        ->result_array();
    }

    public function getOrderByInv($inv = null)
    {
        return $this->db->select("orders.*, invoices.*")
                        ->from("orders")
                        ->join("invoices", 'invoices.invoice_code=orders.order_invoice')
                        ->where('orders.order_invoice', $inv)
                        ->get()
                        ->row_array();
    }

    public function insert($data)
    {
        $query = $this->db->insert($this->table, $data);
        if($query){
            return true;
        } else {
            return false;
        }
    }
}