<div class="content-wrapper">
    <section class="content-header">
      <h1>
        <i class="fa fa-cubes"></i> Manejo de Productos
        <small>Agregar / Editar Producto</small>
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
                    <?php echo form_open_multipart(base_url().$url_action);?>
                    <!--<form role="form" action="<?php echo base_url().$url_action?>" method="post">-->
                        <input type="hidden" id="url" value="<?php echo base_url() ?>">
                        <input type="hidden" id="producto_id" name="producto_id" value="<?php echo $producto_id;?>" />
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nombre">Nombre: *</label>
                                        <input type="text" class="form-control required" value="<?php echo $nombre; ?>" id="nombre" name="nombre" maxlength="128">
                                    </div>
                                    
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="codigo">Codigo: </label>
                                        <input type="text" class="form-control required" id="codigo" value="<?php echo $codigo; ?>" name="codigo" maxlength="128">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="marca">Marca: </label>
                                        <input type="text" class="form-control required" id="marca" name="marca" maxlength="20" value="<?php echo $marca; ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="unidad">Unidad de Medida: </label>
                                        <select class="form-control required" id="unidad" name="unidad">
                                            <option value="0">Unidad de Medida: *</option>
                                            <?php
                                            if(!empty($unidades))
                                            {
                                                foreach ($unidades as $rl)
                                                {
                                                    ?>
                                                    <option value="<?php echo $rl->unidad_id ?>"><?php echo $rl->nombre?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="familia">Familia: </label>
                                        <select class="form-control required" id="familia" name="familia">
                                            <option value="0">Familia: *</option>
                                            <?php
                                            if(!empty($familias))
                                            {
                                                foreach ($familias as $rl)
                                                {
                                                    ?>
                                                    <option value="<?php echo $rl->familia_id ?>"><?php echo $rl->nombre?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-6" >
                                    <div class="short-div form-group">
                                        <label for="image">Imagen: </label>
                                        <input type="file" class="form-control" id="image" name="image" accept="image/*" >

                                    </div>
                                    <div class="short-div form-group">
                                        <label for="documento">Documento tecnico: </label>
                                        <input type="file" class="form-control" id="documento" name="documento" accept=".pdf, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                                    </div>
                                    <div class="short-div form-group">
                                        <label for="mobile">Comentario: </label>
                                        <input type="text" class="form-control" id="comentario" value="<?php echo $comentario?>" name="comentario" maxlength="200">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php if ($imagen){ ?>
                                        <img src="<?php echo base_url()."uploads/producto/".$imagen; ?>" class="img-thumbnail" height="200" width="200">
                                        <?php } else{ ?>
                                            <img src="<?php echo base_url()."assets/dist/img/default-200.png"; ?>" class="img-thumbnail" height="200" width="200">
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="box-footer text-right">
                            <a href="<?php echo base_url();?>productListing" class="btn btn-warning text-left">Regresar</a>
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
        $('#familia').val("<?php echo $familia_id;?>");
        $('#unidad').val("<?php echo $unidad_id;?>");
    });
</script>