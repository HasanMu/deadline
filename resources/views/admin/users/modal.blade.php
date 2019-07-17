<div class="modal fade" id="create-user">
    <div class="modal-dialog">
        <form id="c-user">
            <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Tambah User</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                  <label for="exampleInputPassword1">Nama</label>
                  <input type="text" class="form-control" id="nama" name="name" placeholder="Nama lengkap">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                </div>
                <div class="form-group">
                    <label>Tanggal Lahir</label>
    
                    <div class="input-group date">
                        <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" name="dob" id="datepicker">
                    </div>
                    <!-- /.input group -->
                </div>
                <div class="form-group">
                    <label>Jenis kelamin</label><br>  
                    <input type="radio" class="minimal" name="gender" value="Laki - Laki">Laki - Laki
                    <input type="radio" class="minimal" name="gender" value="Perempuan">Perempuan
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
          </div>
        </form>
          <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal fade" id="edit-user">
    <div class="modal-dialog">
        <form id="e-user">
            <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Edit User</h4>
            </div>
            <input type="hidden" name="id" id="e-id">
            <div class="modal-body">
                <div class="form-group">
                  <label for="exampleInputPassword1">Nama</label>
                  <input type="text" class="form-control" id="e-nama" name="name" placeholder="Nama lengkap">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Email</label>
                    <input type="email" class="form-control" id="e-email" name="email" placeholder="Email">
                </div>
                <div class="form-group">
                    <label>Tanggal Lahir</label>
    
                    <div class="input-group date">
                        <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right dpicker" name="dob" id="datepicker e-dob">
                    </div>
                    <!-- /.input group -->
                </div>
                <div class="form-group">
                    <label>Jenis kelamin</label><br>  
                    <input type="radio" class="minimal l" checked="false" name="gender" value="Laki - Laki">Laki - Laki
                    <input type="radio" class="minimal p" checked="false" name="gender" value="Perempuan">Perempuan
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" id="e-password" name="password" placeholder="Password">
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
              <button type="submit" class="btn btn-success">Edit</button>
            </div>
          </div>
        </form>
          <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal modal-danger fade" id="hapus-user">
    <div class="modal-dialog">
        <form id="h-user">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Hapus User!</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id" id="id-h-user">
                <p id="nama-h-user"></p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Kembali</button>
              <button type="submit" class="btn btn-outline">Ya! Hapus</button>
            </div>
          </div>
        </form>
          <!-- /.modal-content -->
        </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->