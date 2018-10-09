<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Producto_model extends CI_Model
{

    function productListing($searchText = '', $page, $segment)
    {
        $this->db->select('p.*');
        $this->db->from('tbl_productos as p');
        if(!empty($searchText)) {
            $likeCriteria = "(p.nombre  LIKE '%".$searchText."%'
                            OR  p.codigo  LIKE '%".$searchText."%'
                            OR  p.marca  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('p.activo', 1);
        $this->db->order_by('p.producto_id', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();

        $result = $query->result();
        return $result;
    }

    function productListingCount($searchText = '')
    {
        $this->db->select('p.*');
        $this->db->from('tbl_productos as p');
        if(!empty($searchText)) {
            $likeCriteria = "(p.nombre  LIKE '%".$searchText."%'
                            OR  p.codigo  LIKE '%".$searchText."%'
                            OR  p.marca  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('p.activo', 1);
        $query = $this->db->get();

        return $query->num_rows();
    }


}

?>