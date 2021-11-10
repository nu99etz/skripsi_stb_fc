<?php

defined('BASEPATH') or exit('No direct script access allowed');

// if (empty($pegawai)) {
//     $nama_pegawai = '';
//     $role_id = '';
//     $alamat_pegawai = '';
//     $no_telp_pegawai = '';
// } else {
//     $nama_pegawai = $pegawai['nama_pegawai'];
//     $role_id = $pegawai['role_id'];
//     $alamat_pegawai = $pegawai['alamat_pegawai'];
//     $no_telp_pegawai = $pegawai['nomor_telepon_pegawai'];
// }

?>

<form action="<?php echo $action; ?>" id="form" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="nama_customer">Nama Customer</label>
        <input type="text" class="form-control" name="nama_customer" id="nama_customer" placeholder="Nama Customer">
    </div>

    <div class="form-group">
        <label for="alamat_customer">Alamat Customer</label>
        <textarea class="form-control" name="alamat_customer" id="alamat_customer" placeholder="Alamat Customer"></textarea>
    </div>

    <div class="form-group">
        <label for="no_telepon_customer">Nomor Telepon Customer</label>
        <input type="text" class="form-control" name="no_telepon_customer" id="no_telepon_customer" placeholder="Nomor Telepon Customer">
    </div>

    <div class="form-group">
        <label>Pilih Gejala</label>
        <div class="row">
            <div class="col-md-6">
                <?php for ($i = 0; $i < 12; $i++) {
                ?>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="question[]" id="<?php echo $gejala[$i]['id']; ?>" value="<?php echo $gejala[$i]['id']; ?>">
                            <?php echo $gejala[$i]['kode_gejala'] . " - " . $gejala[$i]['nama_gejala']; ?>
                        </label>
                    </div>
                <?php  } ?>
            </div>

            <div class="col-md-6">
                <?php for ($j = 12; $j < 24; $j++) {
                ?>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="question[]" id="<?php echo $gejala[$j]['id']; ?>" value="<?php echo $gejala[$j]['id']; ?>">
                            <?php echo $gejala[$j]['kode_gejala'] . " - " . $gejala[$j]['nama_gejala']; ?>
                        </label>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <div class="form-group">
        <button type="submit" id="simpan" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
        <button type="reset" id="ulang" class="btn btn-warning"><i class="fa fa-refresh"></i> Reset</button>
    </div>
</form>

<script>
    $('#nama_teknisi').select2({
        placeholder: "-- PILIH TEKNISI ---",
    });

    // // $('#penyebab_kerusakan').wysihtml5()
    // CKEDITOR.replace('alamat_customer');
</script>