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
    public function get($id) {
        $this->db->select('orden_id,proveedor_id,DATE_FORMAT(now(),\'%d/%m/%Y\') as fecha,nrodocumento,comentario');
        $this->db->from('tbl_orden');
        $this->db->where('orden_id', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        }
    }
    public function productosById($id) {
        $this->db->select('o.ordendetalle_id,p.producto_id,p.codigo,p.nombre,o.cantidad,o.comentario,o.activo');
        $this->db->from('tbl_ordendetalle o');
        $this->db->join('tbl_productos p','p.producto_id=o.producto_id');
        $this->db->where('o.orden_id', $id);
        $query = $this->db->get();
        return $query->result();
    }
    function orden_insert($info)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_orden', $info);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }
    function orden_update($id,$info)
    {
        $where = array("orden_id"=>$id);
        $this->db->where($where);
        return $this->db->update('tbl_orden',$info);
    }
    function ordendetalle_insert($info)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_ordendetalle', $info);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }
    function ordendetalle_update($id,$info)
    {
        $where = array("ordendetalle_id"=>$id);
        $this->db->where($where);
        return $this->db->update('tbl_ordendetalle',$info);
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