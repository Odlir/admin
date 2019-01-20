<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Producto_model extends CI_Model
{

    function productListing($searchText = '', $page, $segment)
    {
        $this->db->select('p.*, u.nombre as nombre_producto, f.nombre as nombre_familia');
        $this->db->from('tbl_productos as p');
        $this->db->join('tbl_unidades u','u.unidad_id = p.unidad','left');
        $this->db->join('tbl_familia f','f.familia_id = p.familia','left');
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

    function get($id){
        $this->db->select('p.nombre,p.codigo,p.marca,p.unidad,p.familia,p.comentario,p.documento,p.imagen,f.nombre familia2,u.nombre unidad2');
        $this->db->from('tbl_productos p');
        $this->db->join('tbl_unidades u','u.unidad_id = p.unidad','left');
        $this->db->join('tbl_familia f','f.familia_id = p.familia','left');
        $this->db->where('p.producto_id', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        }
    }

    function insert($info)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_productos', $info);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }
    function update($id,$info)
    {
        $where = array("producto_id"=>$id);
        $this->db->where($where);
        return $this->db->update('tbl_productos',$info);
    }
    function delete($id,$info)
    {
        $where = array("producto_id"=>$id);
        $this->db->where($where);
        return $this->db->update('tbl_productos',$info);
    }

    function getUnidadesMedida()
    {
        $this->db->select('u.*');
        $this->db->from('tbl_unidades u');
        $this->db->where('u.activo', 1);
        $query = $this->db->get();

        return $query->result();
    }


    function getFamilias()
    {
        $this->db->select('f.*');
        $this->db->from('tbl_familia f');
        $this->db->where('f.activo', 1);
        $query = $this->db->get();

        return $query->result();
    }


}

?>