<?php

defined('BASEPATH') or exit('No direct script access allowed');

if (empty($solusi_kerusakan)) {
    $kode_kerusakan = '';
    $solusi_kerusakan = '';
} else {
    $kode_kerusakan = $solusi_kerusakan['kode_kerusakan'];
    $solusi_kerusakan = $solusi_kerusakan['solusi_kerusakan'];
}

?>

<form action="<?php echo $action; ?>" id="form" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label>Kerusakan</label>
        <select class="form-control select2" style="width: 100%;" id="kode_kerusakan" name="kode_kerusakan">
            <option></option>
            <?php foreach ($kerusakan as $rusak) {
                if (!empty($solusi_kerusakan)) {
                    if ($kode_kerusakan == $rusak['id']) {
            ?>
                        <option value="<?php echo $rusak['id']; ?>" selected><?php echo $rusak['kode_kerusakan'] . " - " . $rusak['nama_kerusakan']; ?></option>
                    <?php } else {
                    ?>
                        <option value="<?php echo $rusak['id']; ?>"><?php echo $rusak['kode_kerusakan'] . " - " . $rusak['nama_kerusakan']; ?></option>
                    <?php  }
                } else {
                    ?>
                    <option value="<?php echo $rusak['id']; ?>"><?php echo $rusak['kode_kerusakan'] . " - " . $rusak['nama_kerusakan']; ?></option>
            <?php    }
            } ?>
        </select>
    </div>
    <div class="form-group">
        <label for="penyebab_kerusakan">Solusi Kerusakan</label>
        <textarea class="form-control" name="solusi_kerusakan" id="solusi_kerusakan" placeholder="Solusi Kerusakan"><?php echo $solusi_kerusakan; ?></textarea>
    </div>
    <div class="form-group">
        <button type="submit" id="simpan" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
        <button type="reset" id="ulang" class="btn btn-warning"><i class="fa fa-refresh"></i> Reset</button>
    </div>

</form>

<script>
    $('#kode_kerusakan').select2({
        placeholder: "-- PILIH KERUSAKAN ---",
    });

    // $('#penyebab_kerusakan').wysihtml5()
    CKEDITOR.replace('solusi_kerusakan');
</script>