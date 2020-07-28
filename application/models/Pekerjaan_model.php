<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pekerjaan_model extends CI_Model
{
    protected $table = "pekerjaan";
    protected $primaryKey = "pekerjaan_id";

    public function getPekerjaan($id = null)
    {
        if($id != null){
            return $this->db->get_where($this->table, [$this->primaryKey => $id])->row_array();
        } else {
            return $this->db->get($this->table)->result_array();
        }
    }

    public function getUploads($id = null)
    {
        if($id != null){
            return $this->db->get_where('uploads', ['pekerjaan_id' => $id])->result_array();
        } else {
            return $this->db->get('uploads')->result_array();
        }
    }

    public function getPekerjaanForAdmin($id = null)
    {
        if($id != null){
            return $this->db->get_where($this->table, [$this->primaryKey => $id, 'pekerjaan_status' => 'Selesai'])->row_array();
        } else {
            return $this->db->get_where($this->table, ['pekerjaan_status' => 'Selesai'])->result_array();
        }
    }

    public function getCountPekerjaan($status = null)
    {
        if($status != null){
            return $this->db->get_where($this->table, ['pekerjaan_status' => $status])->num_rows();
        } else {
            return $this->db->get($this->table)->num_rows();
        }
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

    public function updateUploads($data, $id)
    {
        $query = $this->db->where('upload_id', $id)->update('uploads', $data);
        return $query;
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