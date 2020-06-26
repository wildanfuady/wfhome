<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sitemap_model extends CI_Model {

    function create_product() {
        return $this->db->get('products')->result_array();
    }

    function create_category() {
        return $this->db->get('categories')->result_array();
    }

    function create_page() {
        return $this->db->get('pages')->result_array();
    }

}
?>