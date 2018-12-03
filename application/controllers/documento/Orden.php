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

        $returns = $this->paginationCompress ( "orden/", $count, 10 );

        $data['items'] = $this->orden_model->ordenListing($searchText, $returns["page"], $returns["segment"]);

        $this->global['pageTitle'] = 'OdLir : Listado de Ordenes de compra';

        $this->loadViews("documento/orden", $this->global, $data, NULL);

    }

    function addNew()
    {
        $data['proveedor'] = $this->orden_model->getProveedores();
        $data['fecha'] = date('d/m/Y');
        $this->global['pageTitle'] = 'OdLir :Agregar Nuevo Orden';

        $this->loadViews("documento/addNewOrden", $this->global, $data, NULL);

    }

    function addNewOrden()
    {

        $nrodocumento = $this->input->post('nrodocumento');
        $proveedor = $this->input->post('proveedor');
        $comentario = $this->input->post('comentario');
        $productos=json_decode($this->input->post('productos'));


        $info = array(
            'nrodocumento'=>$nrodocumento,
            'proveedor_id'=>$proveedor,
            'activo'=>1,
            'comentario'=>$comentario);

        $orden_id = $this->orden_model->orden_insert($info);
        if($orden_id > 0)
        {
            foreach ($productos as $producto) {
                $info = array(
                    'orden_id'=>$orden_id,
                    'producto_id'=>$producto->producto_id,
                    'cantidad'=>$producto->cantidad,
                    'comentario'=>$producto->comentario);
                $this->orden_model->ordendetalle_insert($info);
            }
         $this->session->set_flashdata('success', 'Creación satisfactoria');
        }
        else
        {
            $this->session->set_flashdata('error', 'Creación fallida');
        }
        redirect('ordenListing');
    }
}

?>