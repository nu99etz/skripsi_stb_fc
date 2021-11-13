<?php

defined('BASEPATH') or exit('No direct script access allowed');

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <?php if ($this->session->userdata('role') != 1 && $this->session->userdata('role') != 2) {
    ?>
        <div class="container">
        <?php } ?>
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
        <?php if ($this->session->userdata('role') != 1 && $this->session->userdata('role') != 2) {
        ?>
</div>
<?php } ?>

<?php

$data['modal_id'] = 'form-konsultasi';
$data['modal_size'] = 'lg';
$data['modal_title'] = 'Form Konsultasi';
$this->load->view('_partial/modal', $data);

$data['modal_id'] = 'form-notif';
$data['modal_size'] = 'lg';
$data['modal_title'] = 'Notifikasi Kerusakan';
$this->load->view('_partial/modal', $data);

?>

<script>
    let _modal = $('#form-konsultasi');
    let _modal_kerusakan = $('#form-notif');

    $(document).on('change', 'input[name="id_gejala"]:checked', function() {
        let _id = $('input[name="id_gejala"]:checked').val();

        if (_id == undefined) {

            FailedNotif('Silahkan Memilih Salah Satu Gejala');

        } else {

            let _url = "<?php echo base_url(); ?>konsultasi/nextquestion/" + _id + "/next";

            send((data, xhr = null) => {
                $('#gejala').html(data.gejala);
            }, _url, 'json', 'get');
        }
    });

    $(document).on('click', '#stop', function() {
        let _url = $(this).attr('action');

        send((data, xhr = null) => {
            $('#gejala').html(data.gejala);
        }, _url, 'json', 'get');

    });

    $(document).on('click', '#ulang', function() {
        let _url = $(this).attr('action');
        Swal.fire({
            title: 'Apakah Anda Yakin Mengulangi Pemilihan ?',
            showCancelButton: true,
            confirmButtonText: `Ulangi`,
            confirmButtonColor: '#d33',
            icon: 'question'
        }).then((result) => {
            if (result.value) {
                window.location.href = _url;
            }
        });
    });

    $(document).on('click', '#simpan', function() {
        let _id_kerusakan = $('#id_kerusakan').val();
        let _url = "<?php echo base_url(); ?>konsultasi/form_perbaikan/" + _id_kerusakan;
        getViewModal(_url, _modal);
    });

    $(document).on('submit', '#perbaikan', function() {
        event.preventDefault();
        let _url = $(this).attr('action');
        let _data = new FormData($(this)[0]);
        send((data, xhr = null) => {
            if (data.status == 'notvalid') {
                FailedNotif(data.messages);
            } else {
                window.location.href = data.url;
            }

        }, _url, 'json', 'post', _data);
    });
</script>