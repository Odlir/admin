<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Documento extends BaseController
{

    public function __construct()
    {
        parent::__construct();
        //$this->load->model('inventario/orden_model');
        $this->isLoggedIn();
    }

    public function index()
    {
        $this->global['pageTitle'] = 'Documentos : Dashboard';
        $this->loadViews("documento/documento", $this->global, NULL , NULL);
    }

    /**
     * Page not found : error 404
     */
    function pageNotFound()
    {
        $this->global['pageTitle'] = 'Error : 404 - Page Not Found';

        $this->loadViews("404", $this->global, NULL, NULL);
    }

}

?>