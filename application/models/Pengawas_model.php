<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model
{
    protected $table1        = "admin";
    protected $table2        = "toko";
    protected $table3        = "banner";
    protected $primaryKey1   = "admin_id";
    protected $primaryKey2   = "toko_id";
    protected $primaryKey3   = "banner_id";

    public function getAdmin()
    {
        return $this->db->get_where($this->table1, ['admin_level' => 1, 'admin_status' => 'Y', 'admin_verified' => 1])->row_array();
    }

    public function getToko()
    {
        return $this->db->get_where($this->table2, [$this->primaryKey2 => 1])->row_array();
    }

    public function getBanner()
    {
        return $this->db->get_where($this->table3, [$this->primaryKey3 => 1])->row_array();
    }

    public function update($table, $data, $where)
    {
        $query = $this->db->where($where)->update($table, $data);

        if($query){
            return true;
        } else {
            return false;
        }
    }
}
?>