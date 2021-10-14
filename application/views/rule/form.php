<?php

defined('BASEPATH') or exit('No direct script access allowed');

if (empty($rule)) {
    $parent_kode_gejala = '';
    $child_kode_gejala = '';
    $kode_kerusakan = '';
} else {
    $parent_kode_gejala = $rule['parent_kode_gejala'];
    $child_kode_gejala = $rule['child_kode_gejala'];
    $kode_kerusakan = $rule['kode_kerusakan'];
}

?>

<form action="<?php echo $action; ?>" id="form" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label>Parent Kode Gejala</label>
        <select class="form-control select2" style="width: 100%;" id="parent_kode_gejala" name="parent_kode_gejala">
            <option></option>
            <?php foreach ($gejala as $gejalas) {
                if (!empty($rule)) {
                    if ($parent_kode_gejala == $gejalas['id']) {
            ?>
                        <option value="<?php echo $gejalas['id']; ?>" selected><?php echo $gejalas['kode_gejala'] . " - " . $gejalas['nama_gejala']; ?></option>
                    <?php } else {
                    ?>
                        <option value="<?php echo $gejalas['id']; ?>"><?php echo $gejalas['kode_gejala'] . " - " . $gejalas['nama_gejala']; ?></option>
                    <?php  }
                } else {
                    ?>
                    <option value="<?php echo $gejalas['id']; ?>"><?php echo $gejalas['kode_gejala'] . " - " . $gejalas['nama_gejala']; ?></option>
            <?php    }
            } ?>
        </select>
    </div>

    <div class="form-group">
        <label>Child Kode Gejala</label>
        <select class="form-control select2" style="width: 100%;" id="child_kode_gejala" name="child_kode_gejala">
            <option></option>
            <?php foreach ($gejala as $gejalas) {
                if (!empty($rule)) {
                    if ($child_kode_gejala == $gejalas['id']) {
            ?>
                        <option value="<?php echo $gejalas['id']; ?>" selected><?php echo $gejalas['kode_gejala'] . " - " . $gejalas['nama_gejala']; ?></option>
                    <?php } else {
                    ?>
                        <option value="<?php echo $gejalas['id']; ?>"><?php echo $gejalas['kode_gejala'] . " - " . $gejalas['nama_gejala']; ?></option>
                    <?php  }
                } else {
                    ?>
                    <option value="<?php echo $gejalas['id']; ?>"><?php echo $gejalas['kode_gejala'] . " - " . $gejalas['nama_gejala']; ?></option>
            <?php    }
            } ?>
        </select>
    </div>

    <div class="form-group">
        <label>Kode Kerusakan</label>
        <select class="form-control select2" style="width: 100%;" id="kode_kerusakan" name="kode_kerusakan">
            <option></option>
            <?php foreach ($kerusakan as $rusak) {
                if (!empty($rule)) {
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
        <button type="submit" id="simpan" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
        <button type="reset" id="ulang" class="btn btn-warning"><i class="fa fa-refresh"></i> Reset</button>
    </div>

</form>

<script>
    $('#parent_kode_gejala').select2({
        placeholder: "-- PILIH GEJALA ---",
    });

    $('#child_kode_gejala').select2({
        placeholder: "-- PILIH GEJALA ---",
    });

    $('#kode_kerusakan').select2({
        placeholder: "-- PILIH KERUSAKAN ---",
    });
</script>