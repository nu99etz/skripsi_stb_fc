<?php

defined('BASEPATH') or exit('No direct script access allowed');

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Dashboard
		</h1>
		<ol class="breadcrumb">
			<li class="active"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">

		<!-- Small boxes (Stat box) -->
		<div class="row">
			<div class="col-lg-3 col-xs-6">
			</div>
			<!-- ./col -->
			<div class="col-lg-3 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-blue">
					<div class="inner">
						<h3><?php echo $pegawai; ?></h3>

						<p>Pegawai</p>
					</div>
					<div class="icon">
						<i class="fa fa-user"></i>
					</div>
					<a href="<?php echo base_url(); ?>pegawai" class="small-box-footer">Pegawai <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
			<!-- ./col -->
			<div class="col-lg-3 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-blue">
					<div class="inner">
						<h3><?php echo $user; ?></h3>

						<p>User Aktif</p>
					</div>
					<div class="icon">
						<i class="fa fa-user"></i>
					</div>
					<a href="<?php echo base_url(); ?>user" class="small-box-footer">User <i class="fa fa-arrow-circle-right"></i></a>
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
<!-- /.content-wrapper -->