<div class="container-fluid">
    <h1 class="mb-4">Dashboard</h1>

    <div class="row">
        <?php if(isset($total_customers)): ?>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3><?= $total_customers ?></h3>
                    <p>Total Pelanggan</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
                <a href="/customers" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <?php endif; ?>

        <?php if(isset($total_routers)): ?>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3><?= $total_routers ?></h3>
                    <p>Total Router</p>
                </div>
                <div class="icon">
                    <i class="fas fa-network-wired"></i>
                </div>
                <a href="/routers" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <?php endif; ?>

        <?php if(isset($total_invoices)): ?>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3><?= $total_invoices ?></h3>
                    <p>Total Tagihan</p>
                </div>
                <div class="icon">
                    <i class="fas fa-file-invoice-dollar"></i>
                </div>
                <a href="/invoices" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <?php endif; ?>

        <?php if(isset($routers_online)): ?>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-primary">
                <div class="inner">
                    <h3><?= $routers_online ?></h3>
                    <p>Router Online</p>
                </div>
                <div class="icon">
                    <i class="fas fa-signal"></i>
                </div>
                <a href="/routers/monitor" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <?php endif; ?>

        <?php if(isset($my_customers)): ?>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3><?= $my_customers ?></h3>
                    <p>Pelanggan Saya</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-friends"></i>
                </div>
                <a href="/collector/customers" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>