<?php

defined('BASEPATH') or exit('No direct script access allowed');


?>

<form action="<?php echo $action; ?>" id="form" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="password" id="password" placeholder="Password">
    </div>
    <div class="form-group">
        <button type="submit" id="simpan" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
        <button type="reset" id="ulang" class="btn btn-warning"><i class="fa fa-refresh"></i> Reset</button>
    </div>
</form>