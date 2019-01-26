<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-cubes"></i> Manejo de Proveedores
            <small>Agregar / Editar Proveedor</small>
        </h1>
    </section>

    <section class="content">

        <div class="row">
            <div class="col-md-8">

                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Ingresar Detalles del Proveedor</h3>
                    </div>
                    <?php $this->load->helper("form"); ?>
                    <form role="form" id="addUser" action="<?php echo base_url().$url_action?>" method="post" role="form">
                        <input type="hidden" id="url" value="<?php echo base_url() ?>">
                        <input type="hidden" id="proveedor_id" name="proveedor_id" value="<?php echo $proveedor_id;?>" />
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="ruc">RUC: *</label>
                                        <input type="text" class="form-control required" id="ruc" name="ruc" maxlength="128" value="<?php echo $ruc; ?>">
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="razonsocial">Razón Social: </label>
                                        <input type="text" class="form-control required" id="razonsocial" name="razonsocial" maxlength="128" value="<?php echo $razonsocial; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">E-mail: </label>
                                        <input type="text" class="form-control required" id="email" name="email" maxlength="20" value="<?php echo $email; ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="telefono">Telefono: </label>
                                        <input type="text" class="form-control required" id="telefono" name="telefono" maxlength="50" value="<?php echo $telefono; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="direccion">Dirección: </label>
                                        <input type="text" class="form-control required" id="direccion" name="direccion" maxlength="50" value="<?php echo $direccion; ?>">
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="box-footer text-right">
                            <a href="<?php echo base_url();?>proveedorListing" class="btn btn-warning text-left">Regresar</a>
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
<script >
    $(function () {

    });
</script>