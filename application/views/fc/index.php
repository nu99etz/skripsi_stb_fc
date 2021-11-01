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
                        <button style="float: right;" action="<?php echo base_url(); ?>konsultasi/form" type="button" class="add btn btn-sm btn-success"><i class="fa fa-plus"></i> Tambah</button>
                        <br />
                        <br />
                        <table id="konsultasi" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Customer</th>
                                    <th>Alamat Customer</th>
                                    <th>Nama Teknisi</th>
                                    <th>Tanggal Konsultasi</th>
                                    <th>Tanggal Mulai Perbaikan</th>
                                    <th>Tanggal Selesai Perbaikan</th>
                                    <th>Nama Customer Service</th>
                                    <th>Status Perbaikan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Customer</th>
                                    <th>Alamat Customer</th>
                                    <th>Nama Teknisi</th>
                                    <th>Tanggal Konsultasi</th>
                                    <th>Tanggal Mulai Perbaikan</th>
                                    <th>Tanggal Selesai Perbaikan</th>
                                    <th>Nama Customer Service</th>
                                    <th>Status Perbaikan</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                        </table>
                        <!-- <button style="float: right;" type="button" id="import" class="btn btn-sm btn-primary"><i class="fa fa-upload"></i> Import Excel</button>
            <button style="float: right;" type="button" id="cek-pohon" class="btn btn-sm btn-success"><i class="fa fa-tree"></i> Cek Pohon Keputusan</button>
            <button style="float: right;" type="button" id="hitung" class="btn btn-sm btn-success"><i class="fa fa-refresh"></i> Cek Penghitungan</button> -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

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
    let _table = $('#konsultasi');
    let _url = "<?php echo base_url(); ?>konsultasi/ajax";
    let _modal = $('#form-konsultasi');
    let _modal_kerusakan = $('#form-notif');

    $(_table).DataTable({
        language: {
            "decimal": "",
            "emptyTable": "Data kosong",
            "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            "infoEmpty": "Menampilkan 0 sampai 0 dari 0 data",
            "infoFiltered": "(hasil dari _MAX_ total data)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Menampilkan _MENU_ data",
            "loadingRecords": "Memuat...",
            "processing": "Memproses...",
            "search": "Cari:",
            "zeroRecords": "Tidak ada data yang sesuai",
            "paginate": {
                "first": "Pertama",
                "last": "Terakhir",
                "next": "Selanjutnya",
                "previous": "Sebelumnya"
            },
            "aria": {
                "sortAscending": ": mengurutkan dari terkecil",
                "sortDescending": ": mengurutkan dari terbesar"
            }
        },
        autoWidth: false,
        scrollX: true,
        processing: true,
        serverSide: false,
        order: [],
        ajax: {
            url: _url,
            type: "get",
        },
        lengthMenu: [
            [10, 25, 50, 100],
            [10, 25, 50, 100]
        ],
        columnDefs: [{
            targets: [0],
            orderable: false
        }, ],
        paging: true,
    });

    $(document).on('click', '.add', function() {
        let _url = $(this).attr('action');
        getViewModal(_url, _modal);
    });

    $(document).on('click', '.edit', function() {
        let _url = $(this).attr('url');
        getViewModal(_url, _modal);
    });

    $(document).on('submit', '#form', function() {
        event.preventDefault();
        let _url = $(this).attr('action');
        let _data = new FormData($(this)[0]);
        send((data, xhr = null) => {
            if (data.status == 'notvalid') {
                FailedNotif(data.messages);
            } else if (data.status == 'success') {

                SuccessNotif(data.messages);
                
                _modal.modal('hide');

                _table.DataTable().ajax.reload();

                _modal_kerusakan.find('.modal-body').html(data.kerusakan);
                _modal_kerusakan.modal('show');

            } else if(data.status == 'failed') {

                FailedNotif(data.messages);

            }
        }, _url, 'json', 'post', _data);
    });

    $(document).on('click', '.delete', function() {
        let _url = $(this).attr('url');
        console.log(_url);
        Swal.fire({
            title: 'Apakah Anda Yakin Menghapus Data Ini ?',
            showCancelButton: true,
            confirmButtonText: `Hapus`,
            confirmButtonColor: '#d33',
            icon: 'question'
        }).then((result) => {
            if (result.value) {
                send((data, xhr = null) => {
                    if (data.status == "success") {
                        Swal.fire("Sukses", data.messages, 'success');
                        _table.DataTable().ajax.reload();
                    }
                }, _url, "json", "get");
            }
        });
    });
</script>