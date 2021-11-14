<?php

defined('BASEPATH') or exit('No direct script access allowed');

?>

<body class="hold-transition skin-blue layout-top-nav">
    <div class="wrapper">

        <header class="main-header">
            <nav class="navbar navbar-static-top">
                <div class="container">
                    <div class="navbar-header">
                        <a href="<?php echo base_url(); ?>" class="navbar-brand"><b>Forward Chainning</b></a>
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                            <i class="fa fa-bars"></i>
                        </button>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                        <ul class="nav navbar-nav">
                            <!-- <li><a href="<?php echo base_url();?>">Dashboard <span class="sr-only">(current)</span></a></li> -->
                            <li><a href="<?php echo base_url();?>konsultasi">Konsultasi <span class="sr-only">(current)</span></a></li>
                            <li><a href="<?php echo base_url();?>perbaikan">Perbaikan <span class="sr-only">(current)</span></a></li>
                            <!-- <li><a href="#">Link</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">Action</a></li>
                                    <li><a href="#">Another action</a></li>
                                    <li><a href="#">Something else here</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#">Separated link</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#">One more separated link</a></li>
                                </ul>
                            </li> -->
                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->
                    <!-- Navbar Right Menu -->
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <!-- User Account: style can be found in dropdown.less -->
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="<?php echo base_url(); ?>assets/default.png" class="user-image" alt="User Image">
                                    <span class="hidden-xs"><?php echo $this->session->userdata('kode_pegawai'); ?> - <?php echo $this->session->userdata('name'); ?></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- User image -->
                                    <li class="user-header">
                                        <img src="<?php echo base_url(); ?>assets/default.png" class="img-circle" alt="User Image">

                                        <p>
                                            <?php echo $this->session->userdata('kode_pegawai'); ?> - <?php echo $this->session->userdata('name'); ?>
                                            <small>Last Login : <?php echo $this->session->userdata('last_login'); ?></small>
                                        </p>
                                    </li>
                                    <!-- Menu Body -->
                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="row">
                                            <div class="col-xs-4"></div>
                                            <div class="col-xs-4">
                                                <a href="#" id="logout" class="btn btn-default btn-flat">Keluar</a>
                                            </div>
                                            <div class="col-xs-4"></div>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <!-- Control Sidebar Toggle Button -->
                        </ul>
                    </div>
                    <!-- /.navbar-custom-menu -->
                </div>
                <!-- /.container-fluid -->
            </nav>
        </header>

        <script>
            let _menu = $('.navbar-nav').find('a');
            for (var i = 0; i < _menu.length; i++) {
                href = _menu.eq(i).attr('href');
                if (window.location.href == href) {
                    _menu.eq(i).parents('li').addClass('active');
                    _menu.eq(i).parents('li').parents('li').addClass('active');
                }
            }

            $('#logout').click(function() {
                Swal.fire({
                    title: 'Apakah Anda Yakin Keluar Dari Sistem ?',
                    showCancelButton: true,
                    confirmButtonText: `Logout`,
                    confirmButtonColor: '#d33',
                    icon: 'question'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            method: "GET",
                            url: "<?php echo base_url(); ?>" + "logout",
                            dataType: "json",
                            success: function(data) {
                                if (data.status == "success") {
                                    Swal.fire({
                                        type: 'success',
                                        title: "Logout Sukses",
                                        text: data.messages,
                                        timer: 3000,
                                        icon: 'success',
                                        showCancelButton: false,
                                        showConfirmButton: false
                                    }).then(function() {
                                        window.location.href = "<?php echo base_url(); ?>" + "gate";
                                    });
                                } else if (data.status == "failed") {
                                    toastr.error(data.messages);
                                }
                            },
                            error: function(error) {
                                console.log(error);
                                toastr.error("Error" + eval(error));
                            }
                        })
                    }
                })
            });
        </script>