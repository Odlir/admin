<div class="content-wrapper" ng-app="ordenApp" ng-controller="ordenController"">
    <section class="content-header">
        <h1>
            <i class="fa fa-cubes" aria-hidden="true"></i> Ordenes de Compra
            <small>Listado</small>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>documento/orden/addNew"><i class="fa fa-plus"></i> Crear Nueva Orden</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Listado Ordenes de compra</h3>
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
                                <th>N° Documento</th>
                                <th>Proveedor</th>
                                <th>Fecha</th>
                                <th class="text-center">Actions</th>
                            </tr>
                            <?php
                            if(!empty($items))
                            {
                                foreach($items as $item)
                                {
                                    ?>
                                    <tr>
                                        <td><?php echo $item->nrodocumento ?></td>
                                        <td><?php echo $item->razonSocial ?></td>
                                        <td><?php echo $item->fecha ?></td>
                                        <td class="text-center">
                                            <a class="btn btn-sm btn-primary" ng-click="getDetalles(<?php echo $item->orden_id.",'$item->nrodocumento'";?>)" href="#!" title="Detalles" data-toggle="modal" data-target="#productoModal"><i class="fa fa-info-circle"></i></a> |
                                            <a class="btn btn-sm btn-info" href="<?php echo base_url().'documento/orden/addNew/'.$item->orden_id; ?>" title="Edit"><i class="fa fa-pencil"></i></a>
                                            <a class="btn btn-sm btn-danger deleteUser" href="#" data-userid="<?php echo $item->orden_id; ?>" title="Delete"><i class="fa fa-trash"></i></a>
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

    <div class="modal fade" id="productoModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detalle de la orden '{{orden}}'</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-hover">
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
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/common.js" charset="utf-8"></script>
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