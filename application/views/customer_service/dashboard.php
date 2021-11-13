<?php

defined('BASEPATH') or exit('No direct script access allowed');

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="container">
        <section class="content-header">
            <h1>
                Dashboard
                <small>Dashboard</small>
            </h1>
            <ol class="breadcrumb">
                <li class="active"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <center>
                        <h3>Selamat Datang [ <?php echo $this->session->userdata('name'); ?> ]</h3><br />
                        <h3>Layani Dengan Sepenuh Hati</h3><br />
                    </center>
                </div>
                <div class="col-md-3"></div>
            </div>

            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-xs-6">
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-blue">
                        <div class="inner">
                            <h3>Konsultasi</h3>

                            <p>Layanan Konsultasi</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-info"></i>
                        </div>
                        <a href="<?php echo base_url(); ?>konsultasi" class="small-box-footer">Konsultasi <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-blue">
                        <div class="inner">
                            <h3>Perbaikan</h3>

                            <p>Layanan Perbaikan</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-cog"></i>
                        </div>
                        <a href="<?php echo base_url(); ?>perbaikan" class="small-box-footer">Perbaikan <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                </div>
                <!-- ./col -->
            </div>

        </section>
        <!-- /.content -->
    </div>
</div>
<!-- /.content-wrapper -->