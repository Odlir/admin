<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . 'libraries/BaseController.php';

class Proveedor extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('documento/proveedor_model');
        $this->isLoggedIn();
    }

    public function index()
    {
        $this->proveedorListing();
    }

    function proveedorListing()
    {
        $searchText = $this->security->xss_clean($this->input->post('searchText'));

        $data['searchText'] = $searchText;

        $this->load->library('pagination');

        $count = $this->proveedor_model->proveedorListingCount($searchText);

        $returns = $this->paginationCompress ( "proveedor/", $count, 10 );

        $data['records'] = $this->proveedor_model->proveedorListing($searchText, $returns["page"], $returns["segment"]);

        $this->global['pageTitle'] = 'OdLir : Listado de Productos';

        $this->loadViews("documento/proveedor", $this->global, $data, NULL);

    }

    function show($id = 0)
    {
        $data['proveedor_id']=$id;
        $data['ruc']='';
        $data['razonsocial']='';
        $data['email']='';
        $data['telefono']='';
        $data['direccion']='';

        $data['url_action']='addProveedor';
        $title='OdLir: Agregar Nuevo Proveedor';
        if ($id != 0){
            $data['url_action']='editProveedor';
            $title='OdLir: Modificar Proveedor';

            $item= $this->proveedor_model->get($id);

            $data['ruc']=$item->ruc;
            $data['razonsocial']=$item->razonsocial;
            $data['email']=$item->email;
            $data['telefono']=$item->telefono;
            $data['direccion']=$item->direccion;
        }

        $this->global['pageTitle'] = $title;
        $this->loadViews("documento/addNewProveedor", $this->global, $data, NULL);
    }

    function detalles($id){
        $item = $this->proveedor_model->get($id);
        $data=array(
            'ruc'=>$item->ruc,
            'razonsocial'=>$item->razonsocial,
            'email'=>$item->email,
            'telefono'=>$item->telefono,
            'direccion'=>$item->direccion
        );
        json_output(200, $data);
    }

    function add()
    {
        $ruc = $this->input->post('ruc');
        $razonsocial = $this->input->post('razonsocial');
        $email = $this->input->post('email');
        $telefono = $this->input->post('telefono');
        $direccion = $this->input->post('direccion');

        $info = array(
            'ruc'=>$ruc,
            'razonsocial'=>$razonsocial,
            'email'=>$email,
            'telefono'=>$telefono,
            'direccion'=> $direccion,
            );
        $result = $this->proveedor_model->insert($info);

        if($result > 0)
        {
            $this->session->set_flashdata('success', 'creación satisfactoria');
        }
        else
        {
            $this->session->set_flashdata('error', 'Creación fallida');
        }
        redirect('proveedorListing');
    }

    function edit(){
        $proveedor_id = $this->input->post('proveedor_id');
        $ruc = $this->input->post('ruc');
        $razonsocial = $this->input->post('razonsocial');
        $email = $this->input->post('email');
        $telefono = $this->input->post('telefono');
        $direccion = $this->input->post('direccion');

        $info = array(
            'ruc'=>$ruc,
            'razonsocial'=>$razonsocial,
            'email'=>$email,
            'telefono'=>$telefono,
            'direccion'=> $direccion,
        );
        $result = $this->proveedor_model->update($proveedor_id, $info);

        if($result > 0)
        {
            $this->session->set_flashdata('success', 'Edición satisfactoria');
        }
        else
        {
            $this->session->set_flashdata('error', 'Edición fallida');
        }
        redirect('proveedorListing');
    }

    function all(){
        $data = $this->proveedor_model->proveedorListing('', 20, 1);
        json_output(200,$data);
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

        $result = $this->proveedor_model->delete($id, $info);

        if ($result > 0) { echo(json_encode(array('status'=>TRUE))); }
        else { echo(json_encode(array('status'=>FALSE))); }
        //}
    }
}

?>