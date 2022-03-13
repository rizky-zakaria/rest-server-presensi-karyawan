<div class="card">
    <div class="card-header">
        <!-- <h3 class="card-title">DataTable with default features</h3> -->
        <?php
        $sessi = $this->session->userdata('role');
        if ($sessi === '1') { ?>
            <a href="<?= base_url('DataPegawai/tambah/'); ?>" class="btn btn-primary">Tambah</a>
        <?php
        }
        ?>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>TTL</th>
                    <th>Alamat</th>
                    <th>No. Telp</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($data as $key => $value) {
                ?>
                    <tr>
                        <td><?= $value['username']; ?></td>
                        <td><?= $value['nama']; ?></td>
                        <td><?= $value['jabatan']; ?></td>
                        <td><?= $value['tempat_tgl_lahir']; ?></td>
                        <td><?= $value['alamat']; ?></td>
                        <td><?= $value['no_telp']; ?></td>
                        <td>
                            <?php
                            $sessi = $this->session->userdata('role');
                            if ($sessi === '3' || $sessi === '2') {
                                echo "Anda Tidak Memiliki Aksi";
                            } else {
                            ?>
                                <a href="<?= base_url('DataPegawai/edit/' . $value['id_user']); ?>" class="btn btn-success">
                                    Reset Password
                                </a>
                                <a href="<?= base_url('DataPegawai/hapus/' . $value['id_user']); ?>" class="btn btn-danger">
                                    Hapus
                                </a>
                            <?php
                            }
                            ?>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>Username</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>TTL</th>
                    <th>Alamat</th>
                    <th>No. Telp</th>
                    <th>Aksi</th>
                </tr>
            </tfoot>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->