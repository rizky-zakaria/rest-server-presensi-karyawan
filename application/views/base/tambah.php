<div class="card">
    <div class="card-header">
        Form Tambah
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <form id="quickForm" method="POST" action="<?= base_url("DataPegawai/insert"); ?>">
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Username</label>
                    <input type="text" name="username" class="form-control" id="exampleInputEmail1" placeholder="username">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                </div>
                <div class="form-group">
                    <label for="inputState">Role</label>
                    <select id="inputState" name="role" class="form-control">
                        <option selected>Pilih Role...</option>
                        <option value="2">Pegawai</option>
                        <option value="3">Kepala Desa</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama</label>
                    <input type="text" name="nama" class="form-control" id="exampleInputEmail1" placeholder="nama">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Jabatan</label>
                    <input type="text" name="jabatan" class="form-control" id="exampleInputEmail1" placeholder="jabatan">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">TTL</label>
                    <input type="text" name="ttl" class="form-control" id="exampleInputEmail1" placeholder="Tempat Tanggal Lahir">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Alamat</label>
                    <input type="text" name="alamat" class="form-control" id="exampleInputEmail1" placeholder="alamat">
                </div>
                <div class="form-group">
                    <label for="inputState">Jenis Kelamin</label>
                    <select id="inputState" name="jk" class="form-control">
                        <option selected>Pilih Jenis Kelamin...</option>
                        <option value="Pria">Pria</option>
                        <option value="Wanita">Wanita</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">No Telepon</label>
                    <input type="text" name="no_telp" class="form-control" id="exampleInputEmail1" placeholder="Nomor Telepon">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <!-- </div> -->
        </form>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->