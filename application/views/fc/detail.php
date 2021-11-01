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
                <td>Kode Pegawai / Nama Teknisi : </td>
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
                <td><?php echo $view['teknisi']['kode_pegawai']; ?> / <?php echo $view['teknisi']['nama_teknisi']; ?></td>
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
        foreach ($view['gejala_kerusakan'] as $key => $value) {
        ?>
            <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo $value['nama_gejala']; ?></td>
            </tr>
        <?php $no++;
        } ?>
    </tbody>
</table>

<table id="kerusakan" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Kerusakan</th>
            <th>Penyebab Kerusakan</th>
            <th>Solusi Kerusakan</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1;
        foreach ($view['proses_perbaikan'] as $key => $value) {
        ?>
            <tr>
                <td><?php echo $no; ?></td>
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
        <table>
        </table>
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
        <table>
            <tr>
                <td>Customer Service</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><?php echo $view['customer_service']['nama_cs']; ?></td>
            </tr>
        </table>
    </div>
</div>