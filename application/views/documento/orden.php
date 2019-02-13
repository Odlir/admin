<div class="content-wrapper" ng-app="ordenApp" ng-controller="ordenController"">
    <section class="content-header">
        <h1>
            <i class="fa fa-cubes" aria-hidden="true"></i> Pedidos de obra
            <small>Listado</small>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>documento/orden/show"><i class="fa fa-plus"></i> Nueva</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Pedidos de obra</h3>
                        <div class="box-tools">
                            <form action="<?php echo base_url() ?>productListing" method="POST" id="searchList">
                                <div class="input-group">
                                    <input type="text" name="searchText" value="<?php echo $searchText; ?>" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search"/>
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-default searchList"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="box-body table-responsive no-padding">
                        <input type="hidden" id="url" value="<?php echo base_url() ?>">
                        <table class="table table-hover">
                            <tr>
                                <th>Correlativo</th>
                                <th>Obra</th>
                                <th>Proveedor</th>
                                <th>Fecha</th>
                                <th>Usuario</th>
                                <th>Estado</th>
                                <th class="text-center">Actions</th>
                            </tr>
                            <?php
                            if(!empty($items))
                            {
                                foreach($items as $item)
                                {
                                    ?>
                                    <tr>
                                        <td><?php echo sprintf('%09d',  $item->pedido_id) ?></td>
                                        <td><?php echo $item->obra ?></td>
                                        <td><?php echo $item->razonsocial ?></td>
                                        <td><?php echo $item->fecha ?></td>
                                        <td><?php echo $item->usuario ?></td>
                                        <td><?php
                                            if($item->estado==1) { ?>
                                                <span class="label label-default">Pendiente</span>
                                            <?php } else { ?>
                                                <span class="label label-success">Aprobado</span>
                                            <?php } ?></td>
                                        <td class="text-center">
                                            <a class="btn btn-sm btn-primary" ng-click="getDetalles(<?php echo $item->pedido_id;?>)" href="#!" title="Detalles" data-toggle="modal" data-target="#productoModal"><i class="fa fa-info-circle"></i></a> |
                                            <a class="btn btn-sm btn-success" ng-click="getDetalles(<?php echo $item->pedido_id;?>)" href="#!" title="Aprobación" data-toggle="modal" data-target="#productoModalAprobacion"><i class="fa fa-check"></i></a>
                                            <a class="btn btn-sm btn-info" href="<?php echo base_url().'documento/orden/show/'.$item->pedido_id; ?>" title="Edit"><i class="fa fa-pencil"></i></a>
                                            <a class="btn btn-sm btn-danger deleteOrden" href="#" data-id="<?php echo $item->pedido_id; ?>"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </table>

                    </div>
                    <div class="box-footer clearfix">
                        <?php echo $this->pagination->create_links(); ?>
                    </div>
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
                        <div class="alert alert-success alert-dismissable" >
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
    </section>

    <div class="modal fade" id="productoModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header modal-header-2">
                    <h5 class="modal-title" id="exampleModalLabel">Detalle de pedido de obra</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Obra</label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control" value="{{obra}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Proveedor</label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control" value="{{proveedor}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Fecha</label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control" value="{{fecha}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 control-label">Usuario Creación</label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control" value="{{usuario}}">
                            </div>
                        </div>
                    </form>

                    <table class="table table-bordered" >
                        <thead>
                        <tr>
                            <th>Nro.</th>
                            <th>Código</th>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Comentario</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr ng-repeat="det in detalles">
                            <td>{{$index+1}}</td>
                            <td>{{det.codigo}}</td>
                            <td>{{det.nombre}}</td>
                            <td>{{det.cantidad}}</td>
                            <td>{{det.comentario}}</td>
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
    <div class="modal fade" id="productoModalAprobacion" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header modal-header-2">
                    <h5 class="modal-title" id="exampleModalLabel">Aprobación de pedido de obra</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Obra</label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control" value="{{obra}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Proveedor</label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control" value="{{proveedor}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Fecha</label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control" value="{{fecha}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Usuario Creación</label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control" value="{{usuario}}">
                            </div>
                        </div>
                    </form>

                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Nro.</th>
                            <th>Código</th>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Comentario</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr ng-repeat="det in detalles">
                            <td>{{$index+1}}</td>
                            <td>{{det.codigo}}</td>
                            <td>{{det.nombre}}</td>
                            <td>{{det.cantidad}}</td>
                            <td>{{det.comentario}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success aprobarOrden" data-id="{{orden_id}}"  data-dismiss="modal">Aprobar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

</div>
<script src="<?php echo base_url(); ?>assets/js/angular.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/controller/ordenController.js" type="text/javascript"></script>
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('ul.pagination li a').click(function (e) {
            e.preventDefault();
            var link = jQuery(this).get(0).href;
            var value = link.substring(link.lastIndexOf('/') + 1);
            jQuery("#searchList").attr("action", baseURL + "ordenListing/" + value);
            jQuery("#searchList").submit();
        });
    });
</script>