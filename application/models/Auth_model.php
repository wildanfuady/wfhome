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
}
?>