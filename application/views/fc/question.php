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
                    <div class="box-body">
                        <form action="<?php echo $action; ?>" id="form" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <?php foreach ($gejala as $gejalas) {
                                ?>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="question[]" id="<?php echo $gejalas['id']; ?>" value="<?php echo $gejalas['id']; ?>">
                                            <?php echo $gejalas['kode_gejala'] . " - " . $gejalas['nama_gejala']; ?>
                                        </label>
                                    </div>
                                <?php    } ?>
                            </div>
                            <div class="form-group">
                                <button type="submit" id="simpan" class="btn btn-success"><i class="fa fa-save"></i> Cek Kerusakan</button>
                                <button type="reset" id="ulang" class="btn btn-warning"><i class="fa fa-refresh"></i> Reset</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php

$data['modal_id'] = 'form-notif';
$data['modal_size'] = 'lg';
$data['modal_title'] = 'Notifikasi Kerusakan';
$this->load->view('_partial/modal', $data);

?>

<script>
    let _modal = $('#form-notif');
    $(document).on('submit', '#form', function() {
        event.preventDefault();
        let _url = $(this).attr('action');
        let _data = new FormData($(this)[0]);
        send((data, xhr = null) => {
            if (data.status == 'success') {
                _modal.find('.modal-body').html(data.messages);
                _modal.modal('show');
            }
        }, _url, 'json', 'post', _data);
    });
</script>