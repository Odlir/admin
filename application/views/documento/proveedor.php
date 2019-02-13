<div class="content-wrapper" ng-app="myApp" ng-controller="proveedorController"">
    <section class="content-header">
        <h1>
            <i class="fa fa-cubes" aria-hidden="true"></i> Proveedores
            <small>Listado</small>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>documento/proveedor/show"><i class="fa fa-plus"></i> Crear Nuevo Proveedor</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Listado de proveedores</h3>
                        <div class="box-tools">
                            <form action="<?php echo base_url() ?>proveedorListing" method="POST" id="searchList">
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
                                <th>Razón Social</th>
                                <th>RUC</th>
                                <th>Email</th>
                                <th>Dirección</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                            <?php
                            if(!empty($records))
                            {
                                foreach($records as $record)
                                {
                                    ?>
                                    <tr>
                                        <td><?php echo $record->razonsocial ?></td>
                                        <td><?php echo $record->ruc ?></td>
                                        <td><?php echo $record->email ?></td>
                                        <td><?php echo $record->direccion ?></td>
                                        <td class="text-center">
                                            <a class="btn btn-sm btn-primary" ng-click="getDetalles(<?php echo $record->proveedor_id;?>)" href="#!" title="Detalles" data-toggle="modal" data-target="#detalleModal"><i class="fa fa-info-circle"></i></a> |
                                            <a class="btn btn-sm btn-info" href="<?php echo base_url().'documento/proveedor/show/'.$record->proveedor_id; ?>" title="Edit"><i class="fa fa-pencil"></i></a>
                                            <a class="btn btn-sm btn-danger deleteProveedor" href="#" data-id="<?php echo $record->proveedor_id;?>" title="Delete"><i class="fa fa-trash"></i></a>
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
        </div>
    </section>

    <div class="modal fade" id="detalleModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header modal-header-2">
                    <h5 class="modal-title" id="exampleModalLabel">Detalle del Proveedor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">RUC</label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control" value="{{ruc}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Razón social</label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control" value="{{razonsocial}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Email</label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control" value="{{email}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Telefono</label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control" value="{{telefono}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Dirección</label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control" value="{{direccion}}">
                            </div>
                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url(); ?>assets/js/angular.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/controller/proveedorController.js" type="text/javascript"></script>
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('ul.pagination li a').click(function (e) {
            e.preventDefault();
            var link = jQuery(this).get(0).href;
            var value = link.substring(link.lastIndexOf('/') + 1);
            jQuery("#searchList").attr("action", baseURL + "proveedorListing/" + value);
            jQuery("#searchList").submit();
        });
    });
</script>