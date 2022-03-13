<div class="card">
    <!-- /.card-header -->
    <div class="card-header">
        <a href="<?= base_url("DataAbsensi/mulai_presensi") ?>" class="btn btn-primary">Mulai Presensi Untuk Hari Ini</a>
    </div>
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Tanggal Presensi</th>
                    <th>Waktu Datang</th>
                    <th>Waktu Pulang</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($data as $key => $value) {
                ?>
                    <tr>
                        <td><?= $value['nama']; ?></td>
                        <td><?= $value['tgl_presensi']; ?></td>
                        <td><?= $value['waktu_datang']; ?></td>
                        <td><?= $value['waktu_pulang']; ?></td>
                        <td><?= $value['ket_datang'] . '-' . $value['ket_pulang']; ?></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>Nama</th>
                    <th>Tanggal Presensi</th>
                    <th>Waktu Datang</th>
                    <th>Waktu Pulang</th>
                    <th>Keterangan</th>
                </tr>
            </tfoot>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->