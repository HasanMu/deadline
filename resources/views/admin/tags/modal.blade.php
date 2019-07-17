<div class="modal fade" id="create-tag">
    <div class="modal-dialog">
        <form id="c-tag">
            <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Tambah Tag</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                  <label for="exampleInputPassword1">Nama</label>
                  <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama tag">
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

<div class="modal fade" id="edit-tag">
    <div class="modal-dialog">
        <form id="e-tag">
            <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Edit Tag</h4>
            </div>
            <input type="hidden" name="id" id="e-id">
            <div class="modal-body">
                <div class="form-group">
                  <label for="exampleInputPassword1">Nama</label>
                  <input type="text" class="form-control" id="e-nama" name="nama" placeholder="Nama tag">
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

<div class="modal modal-danger fade" id="hapus-tag">
    <div class="modal-dialog">
        <form id="h-tag">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Hapus tag!</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id" id="id-h-tag">
                <p id="nama-h-tag"></p>
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