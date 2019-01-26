<div class="content-wrapper" ng-app="ordenApp" ng-controller="ordendetController"">
    <section class="content-header">
        <h1>
            <i class="fa fa-cubes"></i> Manejo de Pedido de obra
            <small>Agregar / Editar Pedido de obra</small>
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
                    <form role="form"  action="<?php echo base_url().$url_action ?>" method="post" role="form">
                        <input type="hidden" id="url" value="<?php echo base_url() ?>">
                        <input type="hidden" id="pedido_id" name="pedido_id" value="<?php echo $pedido_id;?>" />
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nrodocumento">Obra (centro de costo):*</label>
                                        <select class="form-control required" id="orden" name="orden" >
                                            <option value="0">Obra: *</option>
                                            <?php
                                            if(!empty($obras))
                                            {
                                                foreach ($obras as $f)
                                                {
                                                    ?>
                                                    <option value="<?php echo $f->orden_id ?>"><?php echo $f->nrodocumento?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fecha">Fecha:*</label>
                                        <div class="input-group date" id="datetimepicker">
                                            <input type="text" class="form-control" value="<?php echo $fecha; ?>" name="fecha" id="fecha" maxlength="128" readonly>
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
                                        <select class="form-control required" id="proveedor" name="proveedor" >
                                            <option value="0">Proveedor: *</option>
                                            <?php
                                            if(!empty($proveedor))
                                            {
                                                foreach ($proveedor as $f)
                                                {
                                                    ?>
                                                    <option value="<?php echo $f->proveedor_id ?>"><?php echo $f->razonsocial?></option>
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
                                        <input type="text" class="form-control" value="<?php echo $comentario;?>" name="comentario" maxlength="200">
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
                                            <tr ng-repeat="producto in productos_seleccionados | filter:{activo:1}:true">
                                                <th scope="row" class="col-md-1">{{$index+1}}</th>
                                                <td class="col-md-2">{{producto.codigo}}</td>
                                                <td class="col-md-4">{{producto.nombre}}</td>
                                                <td class="col-md-2"> <input class="form-control" type="number" ng-model="producto.cantidad" /></td>
                                                <td class="col-md-2"><input class="form-control" type="text" ng-model="producto.comentario" /> </td>
                                                <td class="col-md-1 text-center"><a href="javascript:;" ng-click="removeProducto(producto)" class="text-danger"><i class="fa fa-times"></i></a></td>
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
                            <tr ng-repeat="producto in productos | filter: (buscarProducto || filter_productoagregados)">
                                <td>{{producto.codigo}}</td>
                                <td>{{producto.nombre}}</td>
                                <td><button ng-click="producto_agregar(producto.producto_id)" class="btn btn-sm btn-default">Seleccionar</button></td>
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
<script src="<?php echo base_url(); ?>assets/js/angular.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/controller/ordenController.js" type="text/javascript"></script>
<script >
    $(function () {
        $('#proveedor').val("<?php echo $proveedor_id;?>");
        $('#orden').val("<?php echo $orden_id;?>");
    });
</script>