<div class="modal fade" id="create-kategori">
    <div class="modal-dialog">
        <form id="c-kategori">
            <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Tambah Kategori</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                  <label for="exampleInputPassword1">Nama</label>
                  <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama kategori">
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

<div class="modal fade" id="edit-kategori">
    <div class="modal-dialog">
        <form id="e-kategori">
            <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Edit Kategori</h4>
            </div>
            <input type="hidden" name="id" id="e-id">
            <div class="modal-body">
                <div class="form-group">
                  <label for="exampleInputPassword1">Nama</label>
                  <input type="text" class="form-control" id="e-nama" name="nama" placeholder="Nama kategori">
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

<div class="modal modal-danger fade" id="hapus-kategori">
    <div class="modal-dialog">
        <form id="h-kategori">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Hapus Kategori!</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id" id="id-h-kategori">
                <p id="nama-h-kategori"></p>
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