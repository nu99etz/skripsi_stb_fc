<?php

defined('BASEPATH') or exit('No direct script access allowed');

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Activity Log
            <small>Activity Log</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Activity Log</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Activity Log</h3>
                    </div>
                    <div class="box-body">
                        <table id="log" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Username</th>
                                    <th>IP Address</th>
                                    <th>Aktivitas Log</th>
                                    <th>Tanggal Aktivitas</th>
                                    <th>Parameter Aktivitas</th>
                                    <th>Eksekusi ?</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Username</th>
                                    <th>IP Address</th>
                                    <th>Aktivitas Log</th>
                                    <th>Tanggal Aktivitas</th>
                                    <th>Parameter Aktivitas</th>
                                    <th>Eksekusi ?</th>
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

<script>
    let _table = $('#log');
    let _url = "<?php echo base_url(); ?>log/ajax";

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
        serverSide: true,
        order: [],
        ajax: {
            url: _url,
            type: "POST",
            dataType: "json"
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

</script>