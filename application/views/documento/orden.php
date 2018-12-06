<div class="content-wrapper">
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
                                            <a class="btn btn-sm btn-primary" href="<?= base_url().'orden'?>" title="Detalles"><i class="fa fa-info-circle"></i></a> |
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
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/common.js" charset="utf-8"></script>
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