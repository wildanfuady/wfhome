<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_model extends CI_Model
{
    protected $table = "orders";
    protected $tableJoin = "products";
    protected $primaryKey = "order_id";

    public function getOrder($id = null)
    {
        if($id != null){
            return $this->db->select("*")
                            ->from($this->table)
                            ->where($this->primaryKey, $id)
                            ->get()
                            ->row_array();
        } else {
            return $this->db->select("*")
                            ->from($this->table)
                            ->order_by('order_id', 'desc')
                            ->get()
                            ->result_array();
        }
    }
    public function countOrderBaru()
    {
        $query = $this->db->query("SELECT COUNT(*) as total FROM $this->table WHERE order_status='Order Baru'");
        return $query->row_array();
    }
    public function countOrderSelesai()
    {
        $query = $this->db->query("SELECT COUNT(*) as total FROM $this->table WHERE order_status='Order Selesai'");
        return $query->row_array();
    }
    public function getOrderBaru($key = null, $val = null)
    {
        if($key != null && $val != null){
            return $this->db->select("*")
                            ->from($this->table)
                            ->where('order_status', 'Order Baru')
                            ->order_by($key, $val)
                            ->get()
                            ->result_array();
        } else {
            return $this->db->select("*")
                            ->from($this->table)
                            ->get()
                            ->result_array();
        }
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

    public function update($data, $id)
    {
        return $this->db->where($this->primaryKey, $id)->update($this->table, $data);
    }

    public function delete($id)
    {
        return $this->db->where($this->primaryKey, $id)->delete($this->table);
    }
}
?>