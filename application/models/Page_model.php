<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page_model extends CI_Model
{
    protected $table = "pages";
    protected $primaryKey = "page_id";

    public function getPage($id = null)
    {
        if($id != null){
            return $this->db->get_where($this->table, [$this->primaryKey => $id])->row_array();
        } else {
            return $this->db->get($this->table)->result_array();
        }
    }
    public function getPageBySlug($slug)
    {
        return $this->db->get_where($this->table, ['page_slug' => $slug])->row_array();
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