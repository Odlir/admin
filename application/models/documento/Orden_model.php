<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Orden_model extends CI_Model
{
    function ordenListing($searchText = '', $page, $segment)
    {
        $this->db->select('o.orden_id, o.nrodocumento, o.proveedor_id,p.razonSocial, DATE_FORMAT(o.fecha,\'%d/%m/%Y\') as fecha');
        $this->db->from('tbl_orden as o');
        $this->db->join('tbl_proveedor p','p.proveedorId=o.proveedor_id');
        if(!empty($searchText)) {
            $likeCriteria = "(o.nrodocumento LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('o.activo', 1);
        $this->db->order_by('o.orden_id', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();

        $result = $query->result();
        return $result;
    }

    function ordenListingCount($searchText = '')
    {
        $this->db->select('o.*');
        $this->db->from('tbl_orden as o');
        if(!empty($searchText)) {
            $likeCriteria = "(o.nrodocumento LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('o.activo', 1);
        $query = $this->db->get();

        return $query->num_rows();
    }
    function orden_insert($info)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_orden', $info);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }
    function ordendetalle_insert($info)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_ordendetalle', $info);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }
    function getProveedores()
    {
        $this->db->select('*');
        $this->db->from('tbl_proveedor');
        $this->db->where('activo', 1);
        $query = $this->db->get();

        return $query->result();
    }
}