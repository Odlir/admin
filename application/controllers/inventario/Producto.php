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

    function addNew()
    {

            $data['unidades'] = $this->producto_model->getUnidadesMedida();

            $this->global['pageTitle'] = 'OdLir :Agregar Nuevo Producto';

            $this->loadViews("inventario/addNewProducto", $this->global, $data, NULL);

    }

    function addNewProduct()
    {

        $this->load->library('form_validation');

        $this->form_validation->set_rules('fname','Full Name','trim|required|max_length[128]');
        $this->form_validation->set_rules('email','Email','trim|required|valid_email|max_length[128]');
        $this->form_validation->set_rules('password','Password','required|max_length[20]');
        $this->form_validation->set_rules('cpassword','Confirm Password','trim|required|matches[password]|max_length[20]');
        $this->form_validation->set_rules('role','Role','trim|required|numeric');
        $this->form_validation->set_rules('mobile','Mobile Number','required|min_length[10]');

        if($this->form_validation->run() == FALSE)
        {
            $this->addNew();
        }
        else
        {
            $name = ucwords(strtolower($this->security->xss_clean($this->input->post('fname'))));
            $email = strtolower($this->security->xss_clean($this->input->post('email')));
            $password = $this->input->post('password');
            $roleId = $this->input->post('role');
            $mobile = $this->security->xss_clean($this->input->post('mobile'));

            $userInfo = array('email'=>$email, 'password'=>getHashedPassword($password), 'roleId'=>$roleId, 'name'=> $name,
                'mobile'=>$mobile, 'createdBy'=>$this->vendorId, 'createdDtm'=>date('Y-m-d H:i:s'));

            $this->load->model('user_model');
            $result = $this->user_model->addNewUser($userInfo);

            if($result > 0)
            {
                $this->session->set_flashdata('success', 'New User created successfully');
            }
            else
            {
                $this->session->set_flashdata('error', 'User creation failed');
            }

            redirect('addNew');
        }

    }


}

?>