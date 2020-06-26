<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_model extends CI_Model
{
    protected $table = "categories";
    protected $primaryKey = "category_id";

    public function getCategory($id = null)
    {
        if($id != null){
            return $this->db->get_where($this->table, [$this->primaryKey => $id])->row_array();
        } else {
            return $this->db->get($this->table)->result_array();
        }
    }
    public function countCategory()
    {
        $query = $this->db->query("SELECT COUNT(*) as total FROM $this->table");
        return $query->row_array();
    }
    public function getCategoryBySlug($slug = null)
    {
        return $this->db->get_where($this->table, ['category_slug' => $slug])->row_array();
    }
    public function getCategoryInThumbnail()
    {
        return $this->db->get_where($this->table, ['category_status' => 'Y', 'category_thumbnail' => 'Y'])->result_array();
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