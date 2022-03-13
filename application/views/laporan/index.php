<div class="card">
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Uraian Pekerjaan</th>
                    <th>Tanggal Laporan</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($data as $key => $value) {
                ?>
                    <tr>
                        <td><?= $value['nama']; ?></td>
                        <td><?= $value['uraian_pekerjaan']; ?></td>
                        <td><?= $value['tgl_laporan']; ?></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>Nama</th>
                    <th>Uraian Pekerjaan</th>
                    <th>Tanggal Laporan</th>
                </tr>
            </tfoot>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->