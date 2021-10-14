<?php

defined('BASEPATH') or exit('No direct script access allowed');

if (empty($gejala)) {
    $kode_gejala = '';
    $nama_gejala = '';
} else {
    $kode_gejala = $gejala['kode_gejala'];
    $nama_gejala = $gejala['nama_gejala'];
}

?>

<form action="<?php echo $action; ?>" id="form" method="post" enctype="multipart/form-data">

    <?php if (empty($gejala)) {
    ?>
        <div class="form-group">
            <label for="kode_gejala">Kode Gejala</label>
            <input type="text" class="form-control" name="kode_gejala" id="kode_gejala" placeholder="Kode Gejala" value="<?php echo $kode_gejala; ?>">
        </div>
    <?php } ?>
    <div class="form-group">
        <label for="nama_gejala">Nama Gejala</label>
        <input type="text" class="form-control" name="nama_gejala" id="nama_gejala" placeholder="Nama Gejala" value="<?php echo $nama_gejala; ?>">
    </div>
    <div class="form-group">
        <button type="submit" id="simpan" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
        <button type="reset" id="ulang" class="btn btn-warning"><i class="fa fa-refresh"></i> Reset</button>
    </div>

</form>