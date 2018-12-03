<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . 'libraries/BaseController.php';

class Producto extends BaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('inventario/producto_model');
        $this->isLoggedIn();   
    }

    public function index()
    {
        $this->productListing();
    }
    function example(){
        echo "example";
    }
    function productListing()
    {
        $searchText = $this->security->xss_clean($this->input->post('searchText'));

        $data['searchText'] = $searchText;

        $this->load->library('pagination');

        $count = $this->producto_model->productListingCount($searchText);

        $returns = $this->paginationCompress ( "producto/", $count, 10 );

        $data['productoRecords'] = $this->producto_model->productListing($searchText, $returns["page"], $returns["segment"]);

        $this->global['pageTitle'] = 'OdLir : Listado de Productos';

        $this->loadViews("inventario/producto", $this->global, $data, NULL);

    }

    function addNew()
    {

            $data['unidades'] = $this->producto_model->getUnidadesMedida();

            $data['familias'] = $this->producto_model->getFamilias();

            $this->global['pageTitle'] = 'OdLir :Agregar Nuevo Producto';

            $this->loadViews("inventario/addNewProducto", $this->global, $data, NULL);

    }

    function addNewProduct()
    {
        $nombre = $this->input->post('nombre');
        $codigo = $this->input->post('codigo');
        $unidad = $this->input->post('unidad');
        $familia = $this->input->post('familia');
        $documento = $this->input->post('documento');
        $image = $this->input->post('image');
        $marca = $this->input->post('marca');
        $comentario = $this->input->post('comentario');

        $productInfo = array('nombre'=>$nombre, 'codigo'=>$codigo, 'unidad'=>$unidad, 'familia'=> $familia,
            'documento'=>$documento, 'imagen'=>$image, 'marca'=>$marca, 'comentario'=>$comentario);

        $result = $this->producto_model->addNewProduct($productInfo);

        if($result > 0)
        {
            $this->session->set_flashdata('success', 'New User created successfully');
        }
        else
        {
            $this->session->set_flashdata('error', 'User creation failed');
        }

        redirect('productListing');

    }
    function all(){
        $data = $this->producto_model->productListing('', 10, 1);
        json_output(200,$data);
    }


}

?>