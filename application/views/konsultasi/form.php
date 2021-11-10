<?php

defined('BASEPATH') or exit('No direct script access allowed');

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Konsultasi
            <small>Konsultasi</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Konsultasi</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Konsultasi</h3>
                    </div>
                    <div class="box-body" id="gejala">

                        <?php echo $gejala; ?>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    $(document).on('change', 'input[name="id_gejala"]:checked', function() {
        
        let _url = "<?php echo base_url(); ?>konsultasi/nextquestion/" + _id + "/next";

        send((data, xhr = null) => {
            $('#gejala').html(data.gejala);
        }, _url, 'json', 'get');

    });

    $(document).on('click', '#stop', function() {
        let _url = $(this).attr('action');

        send((data, xhr = null) => {
            $('#gejala').html(data.gejala);
        }, _url, 'json', 'get');

    });

    $(document).on('click', '#ulang', function() {
        let _url = $(this).attr('action');
        window.location.href = _url;
    });

    window.onbeforeunload = function(e) {
        return 'Apakah Konsultasi Sudah Selesai ?';
    };
</script>