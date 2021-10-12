<?php

defined('BASEPATH') or exit('No direct script access allowed');

if (empty($pegawai)) {
    $nama_pegawai = '';
    $role_id = '';
    $alamat_pegawai = '';
    $no_telp_pegawai = '';
} else {
    $nama_pegawai = $pegawai['nama_pegawai'];
    $role_id = $pegawai['role_id'];
    $alamat_pegawai = $pegawai['alamat_pegawai'];
    $no_telp_pegawai = $pegawai['nomor_telepon_pegawai'];
}

?>

<form action="<?php echo $action; ?>" id="form" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="nama_pegawai">Nama Pegawai</label>
        <input type="text" class="form-control" name="nama_pegawai" id="nama_pegawai" placeholder="Nama Pegawai" value="<?php echo $nama_pegawai; ?>">
    </div>
    <div class="form-group">
        <label>Jabatan Pegawai</label>
        <select class="form-control select2" style="width: 100%;" id="role_id" name="role_id">
            <option></option>
            <?php foreach ($roles as $role) {
                if (!empty($pegawai)) {
                    if ($role_id == $role['id_role']) {
            ?>
                        <option value="<?php echo $role['id_role']; ?>" selected><?php echo $role['nama_role']; ?></option>
                    <?php } else {
                    ?>
                        <option value="<?php echo $role['id_role']; ?>"><?php echo $role['nama_role']; ?></option>
                    <?php  }
                } else {
                    ?>
                    <option value="<?php echo $role['id_role']; ?>"><?php echo $role['nama_role']; ?></option>
            <?php    }
            } ?>
        </select>
    </div>
    <div class="form-group">
        <label for="alamat_pegawai">Alamat Pegawai</label>
        <textarea class="form-control" name="alamat_pegawai" id="alamat_pegawai" placeholder="Alamat Pegawai"><?php echo $alamat_pegawai; ?></textarea>
    </div>
    <div class="form-group">
        <label for="nomor_telepon_pegawai">No Telp. Pegawai</label>
        <input type="text" class="form-control" name="nomor_telepon_pegawai" id="nomor_telepon_pegawai" placeholder="08xxxx" value="<?php echo $no_telp_pegawai; ?>">
    </div>
    <div class="form-group">
        <button type="submit" id="simpan" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
        <button type="reset" id="ulang" class="btn btn-warning"><i class="fa fa-refresh"></i> Reset</button>
    </div>
</form>

<script>
    $('#role_id').select2({
        placeholder: "-- PILIH JABATAN PEGAWAI ---",
    });
</script>