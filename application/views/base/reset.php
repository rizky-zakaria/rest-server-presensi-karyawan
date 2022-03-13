<div class="card">
    <div class="card-header">
        Form Tambah
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <form id="quickForm" method="POST" action="<?= base_url("DataPegawai/reset"); ?>">
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Id User</label>
                    <input type="hidden" name="id_user" class="form-control" id="exampleInputEmail1" placeholder="password" value="<?= $id_user; ?>">
                    <label for="exampleInputEmail1">Password</label>
                    <input type="text" name="password" class="form-control" id="exampleInputEmail1" placeholder="password">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <!-- </div> -->
        </form>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->