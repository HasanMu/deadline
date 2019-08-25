<div class="modal fade" id="create-postquestion">
    <div class="modal-dialog">
        <form id="c-pq" enctype="multipart/form-data">

            <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Tambah Pertanyaan</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Author</label>
                    <select name="user_id" id="user_id" class="form-control"></select>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Judul</label>
                    <input type="text" class="form-control" id="judul" name="judul" placeholder="Judul Pertanyaan">
                </div>
                <div class="form-group">
                    <div class="toolbar-container"></div>
                    <div class="content-container">
                      <label for="exampleInputPassword1">Konten</label>
                      <textarea class="form-control" rows="3" cols="10" name="konten" id="konten"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label>Kategori</label>
                    <select name="category_id" id="category_id" class="form-control"></select>
                </div>
                <div class="form-group">
                    <label>Tag</label>
                    <select name="tag_id[]" id="tag_id" class="form-control" multiple></select>
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

<div class="modal modal-danger fade" id="hapus-post-question">
    <div class="modal-dialog">
        <form id="h-pq">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Hapus Pertanyaan!</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id" id="id-h-pq">
                <p id="nama-h-pq"></p>
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
