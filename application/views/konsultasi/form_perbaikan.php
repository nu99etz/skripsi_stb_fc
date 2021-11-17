<?php

defined('BASEPATH') or exit('No direct script access allowed');

?>

<form action="<?php echo $action; ?>" id="perbaikan" method="post" enctype="multipart/form-data">
    <input type="hidden" class="form-control" name="id_kerusakan" id="id_kerusakan" value="<?php echo $kerusakan; ?>">
    <div class="form-group">
        <label for="nama_customer">Nama Customer</label>
        <input type="text" class="form-control" name="nama_customer" id="nama_customer" placeholder="Nama Customer">
    </div>
    <div class="form-group">
        <label for="alamat_customer">Alamat Customer</label>
        <textarea class="form-control" name="alamat_customer" id="alamat_customer" placeholder="Alamat Customer"></textarea>
    </div>
    <div class="form-group">
        <label for="no_telepon_customer">No Telepon Customer</label>
        <input type="text" class="form-control" name="no_telepon_customer" id="no_telepon_customer" placeholder="No Telepon Customer">
    </div>
    <div class="form-group">
        <label for="id_teknisi">ID Teknisi</label>
        <select class="form-control select2" style="width: 100%;" id="id_teknisi" name="id_teknisi">
            <option></option>
            <?php foreach ($teknisi as $key => $value) {
            ?>
                <option value="<?php echo $value['id']; ?>"><?php echo $value['kode_pegawai']; ?> - <?php echo $value['nama_pegawai']; ?></option>
            <?php  } ?>
        </select>
    </div>
    <div class="form-group">
        <button type="submit" id="simpan" class="btn btn-success"><i class="fa fa-save"></i> Simpan Perbaikan</button>
        <button type="reset" class="btn btn-warning"><i class="fa fa-refresh"></i> Reset</button>
    </div>
</form>


<script>
    $('#id_teknisi').select2({
        placeholder: "-- PILIH TEKNISI ---",
    });

    CKEDITOR.replace('alamat_customer');
</script>