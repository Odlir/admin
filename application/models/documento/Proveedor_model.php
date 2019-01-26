<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Proveedor_model extends CI_Model
{

    function proveedorListing($searchText = '', $page, $segment)
    {
        $this->db->select('proveedor_id,razonsocial, ruc, email, telefono, direccion, activo');
        $this->db->from('tbl_proveedor');
        if(!empty($searchText)) {
            $likeCriteria = "(razonsocial  LIKE '%".$searchText."%'
                            OR  ruc  LIKE '".$searchText."%'
                            OR  email LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('activo', 1);
        $this->db->order_by('proveedor_id', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();

        $result = $query->result();
        return $result;
    }

    function proveedorListingCount($searchText = '')
    {
        $this->db->select('*');
        $this->db->from('tbl_proveedor');
        if(!empty($searchText)) {
            $likeCriteria = "(razonsocial  LIKE '%".$searchText."%'
                            OR  ruc  LIKE '".$searchText."%'
                            OR  email LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('activo', 1);
        $query = $this->db->get();

        return $query->num_rows();
    }

    function get($id){
        $this->db->select('razonsocial, ruc, email, telefono, direccion, activo');
        $this->db->from('tbl_proveedor');
        $this->db->where('proveedor_id', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        }
    }

    function insert($info)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_proveedor', $info);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }
    function update($id,$info)
    {
        $where = array("proveedor_id"=>$id);
        $this->db->where($where);
        return $this->db->update('tbl_proveedor',$info);
    }
    function delete($id,$info)
    {
        $where = array("proveedor_id"=>$id);
        $this->db->where($where);
        return $this->db->update('tbl_proveedor',$info);
    }
}
?>