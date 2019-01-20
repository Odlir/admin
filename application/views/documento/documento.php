<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-th" aria-hidden="true"></i> Documento
            <small>Panel de Control</small>
        </h1>
    </section>

    <section class="content">

        <div class="row">
            <a href="<?php echo base_url(); ?>ordenListing">
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-aqua"><i class="fa fa-cubes"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Pedidos de obra</span>
                            <span class="info-box-number"><?php echo '10'; ?><small> unidades</small></span>
                        </div>
                    </div>
                </div>
            </a>

            <a href="<?php echo base_url(); ?>proveedorListing">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Proveedor</span>
                        <span class="info-box-number">760</span>
                    </div>
                </div>
            </div>
            </a>
        </div>
    </section>
</div>