<div class="row">
    <div class="col-md-6">
        <table>
            <tr>
                <td>Nama Customer : </td>
            </tr>
            <tr>
                <td>Tanggal Konsultasi : </td>
            </tr>
            <tr>
                <td>Tanggal Mulai Perbaikan : </td>
            </tr>
            <tr>
                <td>Tanggal Selesai Perbaikan : </td>
            </tr>
            <tr>
                <td>Nomor Telepon : </td>
            </tr>
            <tr>
                <td>Alamat : </td>
            </tr>
        </table>
    </div>

    <div class="col-md-6">
        <table>
            <tr>
                <td><?php echo $view['perbaikan']['nama_customer']; ?></td>
            </tr>
            <tr>
                <td><?php echo $view['perbaikan']['tanggal_konsultasi']; ?></td>
            </tr>
            <tr>
                <td><?php echo $view['perbaikan']['tanggal_mulai_perbaikan']; ?></td>
            </tr>
            <tr>
                <td><?php if ($view['perbaikan']['tanggal_selesai_perbaikan'] == NULL) {
                        echo '-';
                    } else {
                        echo $view['perbaikan']['tanggal_selesai_perbaikan'];
                    } ?></td>
            </tr>
            <tr>
                <td><?php echo $view['perbaikan']['no_telepon_customer']; ?></td>
            </tr>
            <tr>
                <td><?php echo $view['perbaikan']['alamat_customer']; ?></td>
            </tr>
        </table>
    </div>
</div>

<br />


<table id="gejala" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Gejala</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1;
        foreach ($view['gejala'] as $key => $value) {
        ?>
            <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo $value; ?></td>
            </tr>
        <?php $no++;
        } ?>
    </tbody>
</table>

<table id="kerusakan" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Kode Kerusakan</th>
            <th>Nama Kerusakan</th>
            <th>Penyebab Kerusakan</th>
            <th>Solusi Kerusakan</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1;
        foreach ($view['kerusakan'] as $key => $value) {
        ?>
            <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo $value['kode_kerusakan']; ?></td>
                <td><?php echo $value['nama_kerusakan']; ?></td>
                <td><?php echo $value['penyebab_kerusakan']; ?></td>
                <td><?php echo $value['solusi_kerusakan']; ?></td>
            </tr>
        <?php $no++;
        } ?>
    </tbody>
</table>


<div class="row">
    <div class="col-md-3">
        <center>
            <table>
                <tr>
                    <td>Teknisi</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td><?php echo $view['pegawai']['teknisi']['nama_pegawai']; ?></td>
                </tr>
            </table>
        </center>
    </div>

    <div class="col-md-3">
        <table>
        </table>
    </div>

    <div class="col-md-3">
        <table>
        </table>
    </div>

    <div class="col-md-3">
        <center>
            <table>
                <tr>
                    <td>Customer Service</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td><?php echo $view['pegawai']['cs']['nama_pegawai']; ?></td>
                </tr>
            </table>
        </center>
    </div>
</div>