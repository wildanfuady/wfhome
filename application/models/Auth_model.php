<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model
{
    protected $table        = "users";
    protected $primaryKey   = "id";
    // function cek login berdasarkan username, email dan password
    public function cek_login($email)
    {
        $hasil = $this->db->where('email', $email)
                            ->limit(1)->get($this->table);
        if($hasil->num_rows() > 0){
            return $hasil->row_array();
        } else {
            return array();
        }
    }

    public function cek_login_user_where_email($email)
    {
        $hasil = $this->db->where('email', $email)
                            ->limit(1)->get('users');
        if($hasil->num_rows() > 0){
            return $hasil->row_array();
        } else {
            return array();
        }
    }

    public function get_login_user_where_email($email)
    {
        return $this->db->get_where('users', ['email' => $email])->row_array();
    }

    public function getAccount($id)
    {
        return $this->db->get_where($this->table, [$this->primaryKey => $id])->row_array();
    }

    public function getUsers($status)
    {
        return $this->db->get_where($this->table, ['level' => $status])->result_array();
    }

    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
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