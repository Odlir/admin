<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . 'libraries/BaseController.php';

class Orden extends BaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('documento/orden_model');
        $this->isLoggedIn();
    }

    public function index()
    {
        $this->ordenListing();
    }

    function ordenListing()
    {
        $searchText = $this->security->xss_clean($this->input->post('searchText'));

        $data['searchText'] = $searchText;

        $this->load->library('pagination');

        $count = $this->orden_model->ordenListingCount($searchText);

        $returns = $this->paginationCompress("orden/", $count, 10);

        $data['items'] = $this->orden_model->ordenListing($searchText, $returns["page"], $returns["segment"]);

        $this->global['pageTitle'] = 'OdLir : Listado de Ordenes de compra';

        $this->loadViews("documento/orden", $this->global, $data, NULL);

    }

    function show($id = 0)
    {
        $data['orden_id'] = $id;
        $data['nrodocumento'] = '';
        $data['fecha'] = '';
        $data['comentario'] = '';
        $data['proveedor_id'] = 0;
        $data['url_action']='addOrden';
        $title = 'OdLir: Agregar Nuevo Orden';
        if ($id != 0) {
            $data['url_action']='editOrden';
            $title = 'OdLir: Modificar Orden';

            $orden = $this->orden_model->get($id);

            $data['nrodocumento'] = $orden->nrodocumento;
            $data['fecha'] = $orden->fecha;
            $data['comentario'] = $orden->comentario;
            $data['proveedor_id'] = $orden->proveedor_id;
        }

        $data['proveedor'] = $this->orden_model->getProveedores();

        $this->global['pageTitle'] = $title;
        $this->loadViews("documento/addNewOrden", $this->global, $data, NULL);
    }

    function detalles($id)
    {
        $orden = $this->orden_model->get($id);
        $data =array(
            'proveedor'=>$orden->proveedor,
            'fecha'=>$orden->fecha,
            'usuario'=>$orden->usuario,
            'comentario'=>$orden->comentario,
            'detalles'=> $this->orden_model->productosById($id)
        );
        json_output(200, $data);
    }

    function add()
    {
        $nrodocumento = $this->input->post('nrodocumento');
        $proveedor = $this->input->post('proveedor');
        $comentario = $this->input->post('comentario');
        $productos = json_decode($this->input->post('productos'));

        $info = array(
            'nrodocumento' => $nrodocumento,
            'proveedor_id' => $proveedor,
            'activo' => 1,
            'created_by'=>1,
            'comentario' => $comentario);

        $orden_id = $this->orden_model->orden_insert($info);
        if ($orden_id > 0) {
            foreach ($productos as $producto) {
                $info = array(
                    'orden_id' => $orden_id,
                    'producto_id' => $producto->producto_id,
                    'cantidad' => $producto->cantidad,
                    'comentario' => $producto->comentario);
                $this->orden_model->ordendetalle_insert($info);
            }
            $this->session->set_flashdata('success', 'Creación satisfactoria');
        } else {
            $this->session->set_flashdata('error', 'Creación fallida');
        }
        redirect('ordenListing');
    }

    function edit()
    {
        $orden_id = $this->input->post('orden_id');
        $nrodocumento = $this->input->post('nrodocumento');
        $proveedor = $this->input->post('proveedor');
        $comentario = $this->input->post('comentario');
        $productos = json_decode($this->input->post('productos'));

        $info = array(
            'nrodocumento' => $nrodocumento,
            'proveedor_id' => $proveedor,
            'comentario' => $comentario);

        $result = $this->orden_model->orden_update($orden_id, $info);

        if ($result) {
            foreach ($productos as $producto) {
                if($producto->ordendetalle_id != 0){
                    $info = array(
                        'producto_id' => $producto->producto_id,
                        'cantidad' => $producto->cantidad,
                        'comentario' => $producto->comentario,
                        'activo'=>$producto->activo
                    );
                    $this->orden_model->ordendetalle_update($producto->ordendetalle_id,$info);
                }else{
                    $info = array(
                        'orden_id' => $orden_id,
                        'producto_id' => $producto->producto_id,
                        'cantidad' => $producto->cantidad,
                        'comentario' => $producto->comentario
                    );
                    $this->orden_model->ordendetalle_insert($info);
                }

            }
            $this->session->set_flashdata('success', 'Edición satisfactoria');
        } else {
            $this->session->set_flashdata('error', 'Edición fallida');
        }
        redirect('ordenListing');
    }

    function delete(){
        /*if($this->isAdmin() == TRUE)
        {
            echo(json_encode(array('status'=>'access')));
        }
        else
        {*/
        $id = $this->input->post('id');
        $info = array('activo'=>0);

        $result = $this->orden_model->delete($id, $info);

        if ($result > 0) { echo(json_encode(array('status'=>TRUE))); }
        else { echo(json_encode(array('status'=>FALSE))); }
        //}
    }
}

?>