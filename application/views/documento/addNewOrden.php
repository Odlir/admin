<div class="content-wrapper" ng-app="ordenApp" ng-controller="ordenController">
    <section class="content-header">
        <h1>
            <i class="fa fa-cubes"></i> Manejo de Orden de Compra
            <small>Agregar / Editar Orden de compra</small>
        </h1>
    </section>

    <section class="content">

        <div class="row" >
            <div class="col-md-10">

                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Ingresar Detalles del Producto</h3>
                    </div>
                    <?php $this->load->helper("form"); ?>
                    <form role="form"  action="<?php echo base_url() ?>addNewOrden" method="post" role="form">
                        <input type="hidden" id="url" value="<?php echo base_url() ?>">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nrodocumento">Obra:*</label>
                                        <input type="text" class="form-control required" value="<?php  ?>" name="nrodocumento" maxlength="128">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fecha">Fecha:*</label>
                                        <div class="input-group date" id="datetimepicker">
                                            <input type="text" class="form-control" value="<?php echo $fecha; ?>" name="fecha" id="fecha" maxlength="128">
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="proveedor">Proveedor: </label>
                                        <select class="form-control required" name="proveedor">
                                            <option value="0">Proveedor: *</option>
                                            <?php
                                            if(!empty($proveedor))
                                            {
                                                foreach ($proveedor as $f)
                                                {
                                                    ?>
                                                    <option value="<?php echo $f->proveedorId ?>"><?php echo $f->razonSocial?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="comentario">Comentario: </label>
                                        <input type="text" class="form-control" value="<?php  ?>" name="comentario" maxlength="200">
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <button type="button" ng-click="productos()" class="btn btn-sm btn-info" data-toggle="modal" data-target="#productoModal">Agregar Producto</button>
                                    <hr>
                                    <table id="tblDetalleOrden" class="table table-sm table-hover table-bordered table-responsive">
                                        <thead>
                                            <tr class="success">
                                                <th class="col-md-1">#</th>
                                                <th class="col-md-2">codigo</th>
                                                <th class="col-md-4">Producto</th>
                                                <th class="col-md-2">cantidad</th>
                                                <th class="col-md-2">comentario</th>
                                                <th class="col-md-1">Acción</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr ng-repeat="producto in productos_seleccionados">
                                                <th scope="row" class="col-md-1">{{$index+1}}</th>
                                                <td class="col-md-2">{{producto.codigo}}</td>
                                                <td class="col-md-4">{{producto.nombre}}</td>
                                                <td class="col-md-2"> <input class="form-control" type="number" ng-model="producto.cantidad" /></td>
                                                <td class="col-md-2"><input class="form-control" type="text" ng-model="producto.comentario" /> </td>
                                                <td class="col-md-1 text-center"><a href="javascript:;" ng-click="removeProducto($index)" class="text-danger"><i class="fa fa-times"></i></a></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        <div class="box-footer text-right">
                            <input type="hidden" name="productos" value="{{productos_seleccionados}}" />
                            <a href="<?php echo base_url();?>ordenListing" class="btn btn-warning text-left">Regresar</a>
                            <input type="reset" class="btn btn-default" value="Limpiar" />
                            <input type="submit" class="btn btn-success" value="Guardar" />
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4">
                <?php
                $this->load->helper('form');
                $error = $this->session->flashdata('error');
                if($error)
                {
                    ?>
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <?php echo $this->session->flashdata('error'); ?>
                    </div>
                <?php } ?>
                <?php
                $success = $this->session->flashdata('success');
                if($success)
                {
                    ?>
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <?php echo $this->session->flashdata('success'); ?>
                    </div>
                <?php } ?>

                <div class="row">
                    <div class="col-md-12">
                        <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="productoModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Listado de productos</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="text" class="form-control" ng-model="buscarProducto" placeholder="buscar"/>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>codigo</th>
                                    <th>Producto</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            <tr ng-repeat="producto in productos | filter:buscarProducto">
                                <td>{{producto.codigo}}</td>
                                <td>{{producto.nombre}}</td>
                                <td><button ng-click="producto_seleccionar(producto.producto_id)" class="btn btn-sm btn-default">Seleccionar</button></td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script src="<?php echo base_url(); ?>assets/js/addUser.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/angular.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/controller/ordenController.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function () {
        $('#datetimepicker').datepicker({format: 'dd/mm/yyyy'});
    });
    $('#addElement').click(function(event){
        event.preventDefault();
        prod = $("#item_codigo").val();
        cantidad = $("#item_cantidad").val();
        comentario = $("#item_comentario").val();
        row  = '<tr><th scope="row" class="col-md-1">'+4+'</th>';
        row += '<td class="col-md-2">'+cantidad+'</td>';
        row += '<td class="col-md-4">'+prod+'</td>';
        row += '<td class="col-md-5">'+comentario+'</td></tr>';

        $("#tblDetalleOrden").append(row);
        $("#item_codigo").val('');
        $("#item_cantidad").val('');
        $("#item_comentario").val('');
        $("#item_codigo").focus();
        return true;
    });
</script>