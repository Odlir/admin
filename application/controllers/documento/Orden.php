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


        $info = array('nrodocumento'=>$nrodocumento, 'proveedor_id'=>$proveedor, 'comentario'=>$comentario);

        $result = $this->orden_model->addNewOrden($info);

        if($result > 0)
        {
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