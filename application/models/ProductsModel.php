<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProductsModel extends CI_Model
{
    function get_all_products()
    {
        $query = $this->db->from('seproducts');
        $res = $query->get()->result();
        return $res;
    }

}

?>