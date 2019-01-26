<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . 'libraries/BaseController.php';

class Producto extends BaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
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

        $returns = $this->paginationCompress ( "producto/", $count, 10 );

        $data['productoRecords'] = $this->producto_model->productListing($searchText, $returns["page"], $returns["segment"]);

        $this->global['pageTitle'] = 'OdLir : Listado de Productos';

        $this->loadViews("inventario/producto", $this->global, $data, NULL);

    }

    function show($id = 0)
    {
        $data['producto_id']=$id;
        $data['nombre']='';
        $data['codigo']='';
        $data['marca']='';
        $data['unidad_id']='';
        $data['familia_id']='';
        $data['comentario']='';
        $data['imagen']=null;

        $data['url_action']='addProduct';
        $title='OdLir: Agregar Nuevo Producto';
        if ($id != 0){
            $data['url_action']='editProduct';
            $title='OdLir: Modificar Producto';

            $producto= $this->producto_model->get($id);

            $data['nombre']=$producto->nombre;
            $data['codigo']=$producto->codigo;
            $data['marca']=$producto->marca;
            $data['unidad_id']=$producto->unidad;
            $data['familia_id']=$producto->familia;
            $data['comentario']=$producto->comentario;
            $data['imagen']=$producto->imagen;
        }

        $data['unidades'] = $this->producto_model->getUnidadesMedida();
        $data['familias'] = $this->producto_model->getFamilias();

        $this->global['pageTitle'] = $title;
        $this->loadViews("inventario/addNewProducto", $this->global, $data, NULL);
    }

    function detalles($id)
    {
        $item = $this->producto_model->get($id);
        $data = array(
            'codigo' => $item->codigo,
            'nombre' => $item->nombre,
            'familia' => $item->familia2,
            'marca' => $item->marca,
            'unidad' => $item->unidad2,
            'comentario' => $item->comentario,
        );
        json_output(200, $data);
    }

    function add()
    {
        $nombre = $this->input->post('nombre');
        $codigo = $this->input->post('codigo');
        $unidad = $this->input->post('unidad');
        $familia = $this->input->post('familia');
        //$documento = $this->input->post('documento');
        //$image = $this->input->post('image');
        $marca = $this->input->post('marca');
        $comentario = $this->input->post('comentario');

        $info = array(
            'nombre' => $nombre,
            'codigo' => $codigo,
            'unidad' => $unidad,
            'familia' => $familia,
            'marca' => $marca,
            'comentario' => $comentario);

        if (!empty($_FILES['image']['name'])) {
            $config['upload_path'] = 'uploads/producto/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|jpe|';
            $this->load->library('upload', $config,'imageuploader');
            if (!$this->imageuploader->do_upload('image')) {
                var_dump(array('error' => $this->imageuploader->display_errors()));
            } else {
                $upload_data = $this->imageuploader->data();
                $info['imagen'] = $upload_data['file_name'];
            }
        }
        if (!empty($_FILES['documento']['name'])) {
            $config['upload_path'] = 'uploads/documento/';
            $config['allowed_types'] = 'pdf|doc|docx|xls|xlsx';
            $this->load->library('upload', $config,'documentouploader');
            if (!$this->documentouploader->do_upload('documento')) {
                var_dump(array('error' => $this->documentouploader->display_errors()));
            } else {
                $upload_data = $this->documentouploader->data();
                $info['documento'] = $upload_data['file_name'];
            }
        }


        $result = $this->producto_model->insert($info);

        if ($result > 0) {
            $this->session->set_flashdata('success', 'creación satisfactoria');
        } else {
            $this->session->set_flashdata('error', 'Creación fallida');
        }
        redirect('productListing');

    }

    function edit(){
        $producto_id = $this->input->post('producto_id');
        $nombre = $this->input->post('nombre');
        $codigo = $this->input->post('codigo');
        $unidad = $this->input->post('unidad');
        $familia = $this->input->post('familia');
        //$documento = $this->input->post('documento');
        //$image = $this->input->post('image');
        $marca = $this->input->post('marca');
        $comentario = $this->input->post('comentario');

        $info = array(
            'nombre'=>$nombre,
            'codigo'=>$codigo,
            'unidad'=>$unidad,
            'familia'=> $familia,
            //'documento'=>$documento,
            //'imagen'=>$image,
            'marca'=>$marca,
            'comentario'=>$comentario);

        if (!empty($_FILES['image']['name'])) {
            $config['upload_path'] = 'uploads/producto/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|jpe|';
            $this->load->library('upload', $config,'imageuploader');
            if (!$this->imageuploader->do_upload('image')) {
                var_dump(array('error' => $this->imageuploader->display_errors()));
            } else {
                $upload_data = $this->imageuploader->data();
                $info['imagen'] = $upload_data['file_name'];
            }
        }
        if (!empty($_FILES['documento']['name'])) {
            $config['upload_path'] = 'uploads/documento/';
            $config['allowed_types'] = 'pdf|doc|docx|xls|xlsx';
            $this->load->library('upload', $config,'documentouploader');
            if (!$this->documentouploader->do_upload('documento')) {
                var_dump(array('error' => $this->documentouploader->display_errors()));
            } else {
                $upload_data = $this->documentouploader->data();
                $info['documento'] = $upload_data['file_name'];
            }
        }

        $result = $this->producto_model->update($producto_id, $info);

        if($result > 0)
        {
            $this->session->set_flashdata('success', 'Edición satisfactoria');
        }
        else
        {
            $this->session->set_flashdata('error', 'Edición fallida');
        }
        redirect('productListing');
    }

    function all(){
        $data = $this->producto_model->productListing('', 20, 1);
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

            $result = $this->producto_model->delete($id, $info);

            if ($result > 0) { echo(json_encode(array('status'=>TRUE))); }
            else { echo(json_encode(array('status'=>FALSE))); }
        //}
    }

}

?>