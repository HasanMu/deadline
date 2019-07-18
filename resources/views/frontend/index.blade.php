@extends('layouts.app')

@section('content')
@include('frontend.modal')
<div class="container-fluid">
    <div class="row">

        <div class="col-md-3">
            <div class="card">
                <div class="card-header">Status</div>

                <div class="card-body">
                    @guest
                    <p class="d-flex justify-content-center"><b>Anda Belum Login</b></p>
                    <h6 class="d-flex justify-content-center">Silahkan untuk melakukan</h6>
                    <div class="d-flex justify-content-center">
                        <a class="btn btn-primary btn-block" href="{{ route('login') }}">Login</a>
                    </div>
                    <div class="d-flex justify-content-center">--- atau ---</div>
                    <div class="d-flex justify-content-center">
                        <a class="btn btn-secondary btn-block" href="{{ route('register') }}">Register</a>
                    </div>
                    @else
                        <p class="d-flex justify-content-center"><b>{{ Auth::user()->name }}</b></p>
                        @if(!Auth::user()->foto)
                            <center>
                                <img src="/assets/deafult-avatar.png" class="d-flex justify-content-center" width="100px" height="100px">
                                <p></p>
                            </center>
                                <div class="d-flex justify-content-left" style="width: 100%;">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <b>Jenis kelamin</b><br>
                                            {{ Auth::user()->gender }}
                                        </li>
                                        <li class="list-group-item">
                                            <b>Alamat</b><br>
                                            @if(!Auth::user()->address)
                                                <a class="btn btn-link address" href="#" role="button" data-toggle="modal" data-target="#m-profile">Klik untuk menambahkan alamat</a>
                                            @else
                                                {{Auth::user()->address}}
                                            @endif
                                        </li>
                                        <li class="list-group-item">
                                            <b>Bio</b>
                                            @if(!Auth::user()->bio)
                                                <a class="btn btn-link bio" href="#" role="button" data-toggle="modal" data-target="#m-profile">Klik untuk menambahkan bio</a>
                                            @else
                                                {{Auth::user()->bio}}
                                            @endif
                                        </li>
                                        <li class="list-group-item">Porta ac consectetur ac</li>
                                        <li class="list-group-item">Vestibulum at eros</li>
                                    </ul>
                                </div>
                        @else
                            <img src="/assets/{{ Auth::user()->foto }}" class="d-flex justify-content-center">
                            <div class="d-flex justify-content-center">

                            </div>
                        @endif
                    @endguest
                </div>
            </div>
        </div>

        <div class="col-md-4">
        @guest
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <strong>Halo!</strong> Mari bergabung bersama kami untuk lebih baik di masa yang akan datang!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @else
        <button class="btn btn-success" type="button" data-target="#buat-pertanyaan" data-toggle="modal"><i class="fa fa-plus"></i> &nbsp;Buat Post</button>
        <p></p>
        @endguest
            <div class="data-pq"></div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Post Terbaru</div>

                <div class="card-body">
                    <div class="list-group">
                        @php
                            $postquestion = \App\PostQuestion::all();
                        @endphp
                        <ul class="list-unstyled">
                            @foreach($postquestion as $pq)
                            <li class="media">
                                @if(!$pq->foto)
                                    <img src="..." class="mr-3" alt="...">
                                @else
                                    <button class="badge badge-danger" style="height: 64px; width: 64px; margin-right: 10px">BT</button>
                                @endif
                                    <div class="media-body">
                                        <h5 class="mt-0 mb-1">{{ $pq->judul }}</h5>
                                        {!! $pq->konten !!}
                                    </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
@endsection
@push('js')
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#c-tag_id').select2();

            // Image Preview Before Create Question
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                    $('#c-prev-img').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                    }
                }

                $("#c-foto").change(function() {
                readURL(this);
            });

            // Setup Header
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Access-Control-Allow-Origin': '*',
                    'Access-Control-Allow-Methods': 'GET, POST, PUT, DELETE, OPTIONS',
                    'Access-Control-Allow-Headers': 'X-Requested-With, Content-Type, X-Token-Auth, Authorization'
                }
            });

            //Get Users
            $.ajax({
                url: '/api/v1/users',
                method: 'GET',
                success: function (res) {
                    console.log(res);

                    $.each(res.data, function(k, v) {
                        $('#c-user_id').append(
                            `
                            <option value="${v.id}">${v.name}</option>
                            `
                        );
                    })
                },
                error: function (err) {
                    console.log(err);

                }
            })

            // GET Categories
            $.ajax({
                url: '/api/v1/categories',
                method: 'GET',
                success: function (res) {
                    console.log(res);
                    $.each(res.data, function(k, v) {
                        $('#c-category_id').append(
                            `
                            <option value="${v.id}">${v.nama}</option>
                            `
                        );
                    })
                },
                error: function (err) {
                    console.log(err);

                }
            })

            // GET Tags
            $.ajax({
                url: '/api/v1/tags',
                method: 'GET',
                success: function (res) {
                    console.log(res);
                    $.each(res.data, function(k, v) {
                        $('#c-tag_id').append(
                            `
                            <option value="${v.id}">${v.nama}</option>
                            `
                        );
                    })
                },
                error: function (err) {
                    console.log(err);

                }
            })

            // GET Questions
            $.ajax({
                url: '/api/v1/post/questions',
                method: 'GET',
                success: function (res) {
                    console.log(res);
                    $.each(res.data, function(k, v) {
                        $('.data-pq').append(
                            `
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex justify-content-between">
                                        <b>${v.judul}</b>
                                        <div class="justify-content-end">
                                            <span class="badge badge-danger">${v.status}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div class="media">
                                        <img src="/assets/deafult-avatar.png" class="mr-3" style="width: 50px; height: 50px;" alt="...">
                                        <div class="media-body">
                                            <h5 class="mt-0">${v.user.name}</h5>
                                            ${v.konten}
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-muted">
                                    <div class="d-flex flex-row bd-highlight mb-1">
                                        <div class="p-1 bd-highlight">${v.created_at}</div>
                                        <div class="p-1 bd-highlight">

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            `
                        );
                    })
                },
                error: function (err) {
                    console.log(err);

                }
            })

            // CREATE Question
            $('#c-pertanyaan').on('submit', function (e) {
                var formData = new FormData($('#c-pertanyaan')[0]);
                e.preventDefault();

                $.ajax({
                    url: '/api/v1/post/questions',
                    method: 'POST',
                    dataType: "JSON",
                    contentType: false,
                    processData: false,
                    data: formData,
                    cache: true,
                    success: function (res) {
                        $('#c-pertanyaan')[0].reset();
                        alert(res.message);
                        console.log(res)
                        location.reload();
                    },
                    error: function (err) {
                        console.log(err);
                    }
                })
            })

            // Show MODAL Profile BIO
            $('.bio').on('click', function(e) {
                e.preventDefault();

                $('.mt-profile').html('Tambahkan Bio');

                $('.content-bio').html(`<div></div>`);
                $('.content-bio').append(
                    `
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="bio">Bio</label>
                            <textarea id="bio" class="form-control" type="text" name="bio" rows="4" cols="5"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                    `
                );

                $('.content-address').html(`<div></div>`);
            })

            // Show MODAL Profile ADDRESS
            $('.address').on('click', function(e) {
                e.preventDefault();

                $('.mt-profile').html('Tambahkan Alamat');

                $('.content-address').html(``);
                $('.content-address').append(
                    `
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="bio">Alamat</label>
                                <textarea id="c-address" class="form-control" type="text" name="address" rows="4" cols="5"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-dismiss="modal">Tutup</button>
                            <button type="button" class="btn btn-success" id="sv-address">Simpan</button>
                        </div>
                    `
                );

                $('.content-bio').append(``);
                $('.content-bio').html(`<div></div>`);
            });

            $('#sv-address').on('.content-address', 'click', function (e) {

                alert(123)
                // $.ajax({
                //     url: '/api/v1/users/'+ {{ Auth::user()->id}},
                //     method: 'PUT',
                //     data: $('#c-address').serialize(),
                //     success: function (res) {
                //         console.log(res)
                //         $('#fm-create-address')[0].reset();
                //         alert(res.message);
                //         location.reload();
                //     },
                //     error: function (err) {
                //         console.log(err)
                //     }
                // })

            })
        })
    </script>
@endpush
{{-- <div class="col-md-4">
    <div class="card">
        <div class="card-header">Buat Post</div>

        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <div class="form-group">
                <label>Kategori</label>
                <select name="category_id" id="category_id" class="form-control"></select>
            </div>
            <div class="form-group">
                <label>Tag</label>
                <select name="tag_id[]" id="tag_id" class="form-control" multiple></select>
            </div>

            <textarea class="form-control" rows="6" cols="3"></textarea>
        </div>
    </div>
</div> --}}
