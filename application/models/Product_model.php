<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model
{
    protected $table = "products";
    protected $tableJoin = "categories";
    protected $primaryKey = "product_id";

    public function getProduct($id = null)
    {
        if($id != null){
            return $this->db->select("products.*, categories.category_name")
                            ->from($this->table)
                            ->join($this->tableJoin, 'products.category_id=categories.category_id')
                            ->where($this->primaryKey, $id)
                            ->get()
                            ->row_array();
        } else {
            return $this->db->select("products.*, categories.category_name")
                            ->from($this->table)
                            ->join($this->tableJoin, 'products.category_id=categories.category_id')
                            ->order_by('products.created_at', 'desc')
                            ->get()
                            ->result_array();
        }
    }
    public function countProduct()
    {
        $query = $this->db->query("SELECT COUNT(*) as total FROM $this->table");
        return $query->row_array();
    }
    public function getProductBy($string, $num_item = null, $page = null)
    {
        if($num_item != null && $page != null){
            return $this->db->select("*")
                        ->from($this->table)
                        ->where('product_label', $string)
                        ->limit($num_item, $page)
                        ->get()
                        ->result_array();
        } else {
            return $this->db->get_where($this->table, ['product_label' => $string])->result_array();
        }
    }
    public function getProductBaruPaginate($num_item, $page)
    {
        return $this->db->select("*")
                    ->from($this->table)
                    ->where('product_label', 'Terbaru')
                    ->limit($num_item, $page)
                    ->get()
                    ->result_array();
    }
    public function getProductBySlug($slug)
    {
        return $this->db->select("products.*, categories.category_name, categories.category_slug")
                        ->from($this->table)
                        ->join($this->tableJoin, 'products.category_id=categories.category_id')
                        ->where('products.product_slug', $slug)
                        ->get()
                        ->row_array();
    }

    public function getProductBaruByKeyword($keyword, $num_item, $page)
    {
        return $this->db->select("*")
                        ->from($this->table)
                        ->like('product_name', $keyword)
                        ->or_like('product_code', $keyword)
                        ->or_like('product_keyword', $keyword)
                        ->or_like('product_desc', $keyword)
                        ->or_like('product_content', $keyword)
                        ->where('product_label', 'Terbaru')
                        ->limit($num_item, $page)
                        ->get()
                        ->result_array();
    }

    public function getProductBaruByCategory($id, $num_item, $page)
    {
        return $this->db->select("*")
                        ->from($this->table)
                        ->where('category_id', $id)
                        ->where('product_label', 'Terbaru')
                        ->limit($num_item, $page)
                        ->get()
                        ->result_array();
    }

    public function getProductLarisByCategory($id)
    {
        return $this->db->select("*")
                        ->from($this->table)
                        ->where('category_id', $id)
                        ->where('product_label', 'Laris')
                        ->get()
                        ->result_array();
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
        $query = $this->db->where($this->primaryKey, $id)->update($this->table, $data);
        if($query){
            return true;
        } else {
            return false;
        }
    }
    public function delete($id)
    {
        $query = $this->db->where($this->primaryKey, $id)->delete($this->table);
        if($query){
            return true;
        } else {
            return false;
        }
    }
}
?>