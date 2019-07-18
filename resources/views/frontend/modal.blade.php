<div class="modal fade" id="buat-pertanyaan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Buat pertanyaan baru</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="c-pertanyaan" enctype="multipart/form-data">
            <div class="form-group">
                <input id="id" type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                <label for="judul" class="col-form-label">Judul</label>
                <input type="text" name="judul" class="form-control" required id="judul">
            </div>
            <div class="form-group">
                <label for="message-text" class="col-form-label">Isi</label>
                <textarea class="form-control pell-content" required id="message-text" rows="4" name="konten" cols="5"></textarea>
            </div>
            <div class="row">
                <div class="col">
                    <label for="kategori">Kategori</label>
                    <select name="category_id" id="c-category_id" class="form-control" required></select>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="kategori">Tag</label><br>
                        <select name="tag_id[]" id="c-tag_id" class="form-control" required multiple style="width: 100%"></select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="foto" class="col-form-label">Foto</label>
                <input type="file" name="foto" class="form-control" required id="c-foto">
                <small>* Jika Diperlukan</small>
                <p></p><span></span>
                <img class="img-fluid" src="" alt="" id="c-prev-img">
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Buat pertanyaan</button>
      </form>
      </div>
    </div>
  </div>
</div>
