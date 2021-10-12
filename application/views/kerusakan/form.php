<?php

defined('BASEPATH') or exit('No direct script access allowed');

if (empty($kerusakan)) {
    $kode_kerusakan = '';
    $nama_kerusakan = '';
} else {
    $kode_kerusakan = $kerusakan['kode_kerusakan'];
    $nama_kerusakan = $kerusakan['nama_kerusakan'];
}

?>

<form action="<?php echo $action; ?>" id="form" method="post" enctype="multipart/form-data">

    <?php if (empty($kerusakan)) {
    ?>
        <div class="form-group">
            <label for="kode_gejala">Kode Kerusakan</label>
            <input type="text" class="form-control" name="kode_kerusakan" id="kode_kerusakan" placeholder="Kode Kerusakan" value="<?php echo $kode_kerusakan; ?>">
        </div>
    <?php } ?>
    <div class="form-group">
        <label for="nama_kerusakan">Nama Kerusakan</label>
        <input type="text" class="form-control" name="nama_kerusakan" id="nama_kerusakan" placeholder="Nama Kerusakan" value="<?php echo $nama_kerusakan; ?>">
    </div>
    <div class="form-group">
        <button type="submit" id="simpan" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
        <button type="reset" id="ulang" class="btn btn-warning"><i class="fa fa-refresh"></i> Reset</button>
    </div>

</form>