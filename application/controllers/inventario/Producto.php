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

    function productListing()
    {

        $searchText = $this->security->xss_clean($this->input->post('searchText'));
        $data['searchText'] = $searchText;

        $this->load->library('pagination');

        $count = $this->producto_model->productListingCount($searchText);

        $returns = $this->paginationCompress ( "inventario/producto", $count, 10 );

        $data['productoRecords'] = $this->producto_model->productListing($searchText, $returns["page"], $returns["segment"]);

        $this->global['pageTitle'] = 'OdLir : Listado de Productos';

        $this->loadViews("inventario/producto", $this->global, $data, NULL);

    }


}

?>