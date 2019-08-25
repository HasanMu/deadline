@guest
    <div class="alert alert-primary alert-dismissible fade show" role="alert">
        <strong>Halo Selamat Datang!</strong> Mari gabung bersama kami untuk masa depan lebih baik!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>

    @foreach ($all_post as $post)

        <div class="card bg-light mb-3">
            <div class="card-header">
                    <img src="{{ asset('assets/deafult-avatar.png') }}" class="rounded" alt="..." style="width: 30px; height: 30px">
                &nbsp;<b>{{ $post->user->name}}</b>
            </div>
                <div class="card-body">
                    <div class="d-flex flex-row bd-highlight">
                        <div class="bd-highlight"> <h5 class="card-title">{{ $post->judul }}</h5> </div>
                        <div class="bd-highlight"> &nbsp;
                            @if($post->status == 'Belum Terjawab')
                                <span class="badge badge-danger">{{ $post->status }}</span>
                            @elseif($post->status == 'Kurang Puas')
                                <span class="badge badge-warning">{{ $post->status }}</span>
                            @elseif($post->status == 'Terjawab')
                                <span class="badge badge-success">{{ $post->status }}</span>
                            @endif
                        </div>
                    </div>
                    <a href="#">
                        <span class="badge badge-success">{{ $post->category->nama }}</span>
                    </a>
                    @foreach ($post->tags as $tag_post)
                    <a href="#">
                        <span class="badge badge-primary">#{{ $tag_post->nama }}</span>
                    </a>
                    @endforeach
                    <p class="card-text">{{ $post->konten }}</p>
                </div>
                <div class="card-footer bg-transparent border-light">
                    <i class="far fa-comments"></i> 0 Komentar
                </div>
        </div>
    @endforeach
    <div>
        {{$all_post->appends(Request::all())->links()}}
    </div>
@else

    <button type="button" class="btn btn-success" role="button" data-toggle="modal" data-target="#buatPost">Buat Post</button>
    <span><p></p></span>
    @foreach ($all_post as $post)
        <div class="card bg-light mb-3">
            <div class="d-flex bd-highlight card-header">
                <div class="p-2 w-100 bd-highlight">
                    <img src="{{ asset('assets/deafult-avatar.png') }}" class="rounded" alt="..." style="width: 30px; height: 30px">
                &nbsp;<b>{{ $post->user->name}}</b>
                </div>
                <div class="p-2 flex-shrink-1 bd-highlight">
                    @if($post->user->id == Auth::user()->id)
                    <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-caret-down fa-lg" style="color: #000000"></i>
                    </a>
                    @endif
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#" data-id="{{ $post->id }}" data-toggle="modal" data-target="#edit-pq">Edit Postingan</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-danger" href="#" data-id="{{ $post->id }}" data-toggle="modal" data-target="#hapus-pq">
                            Hapus Postingan
                        </a>
                    </div>
                </div>
            </div>
                <div class="card-body">
                    <div class="d-flex flex-row bd-highlight">
                        <div class="bd-highlight"> <h5 class="card-title">{{ $post->judul }}</h5> </div>
                        <div class="bd-highlight"> &nbsp;
                            @if($post->status == 'Belum Terjawab')
                                <span class="badge badge-danger">{{ $post->status }}</span>
                            @elseif($post->status == 'Kurang Puas')
                                <span class="badge badge-warning">{{ $post->status }}</span>
                            @elseif($post->status == 'Terjawab')
                                <span class="badge badge-success">{{ $post->status }}</span>
                            @endif
                        </div>
                    </div>
                    <a href="#">
                        <span class="badge badge-success">{{ $post->category->nama }}</span>
                    </a>
                    @foreach ($post->tags as $tag_post)
                    <a href="#">
                        <span class="badge badge-primary">#{{ $tag_post->nama }}</span>
                    </a>
                    @endforeach
                    <p class="card-text">{{ $post->konten }}</p>
                </div>
                <div class="card-footer bg-transparent border-light">
                    <i class="far fa-comments"></i> 0 Komentar
                </div>
        </div>
    @endforeach
    <div>
        {{$all_post->appends(Request::all())->links()}}
    </div>

    {{-- Modal buat postingan --}}
    <div class="modal fade bd-example-modal-lg" id="buatPost" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Buat Postingan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <form id="form-c-pq">
                    @csrf

                    <div class="modal-body">
                        <div class="form-group">
                            <label for="kategori">Status</label>
                            <select name="status_pq" id="status-pq" class="custom-select">
                                <option value="Belum Terjawab">Belum Terjawab</option>
                                <option value="Kurang Puas">Kurang Puas</option>
                                <option value="Terjawab">Terjawab</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="judul-pq">Judul</label>
                            <input id="judul-pq" class="form-control" type="text" name="judul_pq">
                        </div>
                        <div class="form-group">
                            <label for="konten-pq">Konten</label>
                            <textarea id="texteditor" rows="4" cols="30" class="form-control editor1" type="text" name="konten_pq"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="kategori">Kategori</label>
                            @php
                                $datas_cat = \App\Category::get();
                            @endphp
                            <select name="category_pq" id="category-pq" class="custom-select">
                                @foreach ($datas_cat as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="kategori">Tag</label><span><br></span>
                            <div style="@media width: 100%; !important">
                                @php
                                    $datas_tag = \App\Tag::get();
                                @endphp
                                <select name="tags[]" id="buat-tags-pq" class="custom-select buat-tags-pq" multiple>
                                    @foreach ($datas_tag as $tag)
                                        <option value="{{ $tag->id }}">{{ $tag->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Tidak</button>
                        <button type="submit" class="btn btn-success">Ubah Postingan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- modal edit postingan --}}
    <div class="modal fade bd-example-modal-lg" id="edit-pq" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Postingan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <form id="form-e-pq" method="POST" action="{{ route('api.questions.update', 'params') }}">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="id" id="id-e-pq">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="kategori">Status</label>
                            <select name="status_pq" id="status-pq" class="custom-select">
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="judul-pq">Judul</label>
                            <input id="judul-pq" class="form-control" type="text" name="judul_pq">
                        </div>
                        <div class="form-group">
                            <label for="konten-pq">Konten</label>
                            <textarea id="e-texteditor" rows="4" cols="30" class="form-control editor1" type="text" name="konten_pq"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="kategori">Kategori</label>
                            <select name="category_pq" id="category-pq" class="custom-select">
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="kategori">Tag</label><span><br></span>
                            <div style="@media width: 100%; !important">
                                <select name="tags[]" id="e-tags-pq" class="custom-select edit-tags-pq" multiple>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Tidak</button>
                        <button type="submit" class="btn btn-success">Ubah Postingan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Hapus Postingan --}}
    <div class="modal fade" id="hapus-pq" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Hapus Postingan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <form id="form-h-pq">
                    <div class="modal-body mb-h-pq">

                    </div>
                    <input type="hidden" name="id" id="id-h-pq">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Tidak jadi</button>
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endguest

