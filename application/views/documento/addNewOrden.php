<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-cubes"></i> Manejo de Orden de Compra
            <small>Agregar / Editar Orden de compra</small>
        </h1>
    </section>

    <section class="content">

        <div class="row">
            <div class="col-md-8">

                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Ingresar Detalles del Producto</h3>
                    </div>
                    <?php $this->load->helper("form"); ?>
                    <form role="form" id="addOrden" action="<?php echo base_url() ?>addNewOrden" method="post" role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nrodocumento">N° Documento</label>
                                        <input type="text" class="form-control required" value="<?php  ?>" id="nrodocumento" name="nrodocumento" maxlength="128">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fecha">Fecha: </label>
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
                                        <select class="form-control required" id="proveedor" name="proveedor">
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
                                        <input type="text" class="form-control" id="comentario" value="<?php  ?>" name="comentario" maxlength="200">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <label for="comentario">Producto: </label>
                                        <input type="text" class="form-control" id="prod" value="<?php  ?>" name="prod" maxlength="200">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="comentario">Cantidad: </label>
                                        <input type="text" class="form-control" id="cantidad" value="<?php  ?>" name="cantidad" maxlength="10">
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label for="comentario">Agregar: </label>
                                        <button type="button" class="form-control btn btn-success" id="addElement" name="addElement"><i class="fa fa-plus-circle"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <table id="tblDetalleOrden" class="table table-sm table-hover table-bordered table-responsive">
                                            <thead>
                                                <tr class="success">
                                                    <th class="col-md-2">#</th>
                                                    <th class="col-md-2">Cantidad</th>
                                                    <th class="col-md-8">Producto</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th scope="row" class="col-md-2">1</th>
                                                    <td class="col-md-2">Mark</td>
                                                    <td class="col-md-8">Otto</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" class="col-md-2">2</th>
                                                    <td class="col-md-2">Jacob</td>
                                                    <td class="col-md-8">Thornton</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" class="col-md-2">3</th>
                                                    <td class="col-md-2">Larry the Bird</td>
                                                    <td class="col-md-8">@twitter</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer text-right">
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
    </section>
</div>
<script src="<?php echo base_url(); ?>assets/js/addUser.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function () {
        $('#datetimepicker').datepicker({format: 'dd/mm/yyyy'});
    });
    $('#addElement').click(function(event){
        event.preventDefault();
        prod = $("#prod").val();
        cantidad = $("#cantidad").val();
        row  = '<tr><th scope="row" class="col-md-2">'+4+'</th>';
        row += '<td class="col-md-2">'+prod+'</td>';
        row += '<td class="col-md-2">'+cantidad+'</td></tr>';
        $("#tblDetalleOrden").append(row);
        $("#prod").focus();
        return true;
    });
</script>