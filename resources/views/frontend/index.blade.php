@extends('layouts.app')

@section('content')
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
                            </center>
                        @else
                            <img src="/assets/{{ Auth::user()->foto }}" class="d-flex justify-content-center">
                        @endif
                    @endguest
                </div>
            </div>
        </div>
    
        @guest
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">List Post</div>

                <div class="card-body">
                    
                </div>
            </div>
        </div>
        @else
        <div class="col-md-4">
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
        </div>
        @endguest

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Post Terbaru</div>

                <div class="card-body">
                    <div class="list-group">
                        <button type="button" class="list-group-item list-group-item-action active">
                            Cras justo odio
                        </button>
                        <button type="button" class="list-group-item list-group-item-action">Dapibus ac facilisis in</button>
                        <button type="button" class="list-group-item list-group-item-action">Morbi leo risus</button>
                        <button type="button" class="list-group-item list-group-item-action">Porta ac consectetur ac</button>
                        <button type="button" class="list-group-item list-group-item-action" disabled>Vestibulum at eros</button>
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
            $('#tag_id').select2();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Access-Control-Allow-Origin': '*',
                    'Access-Control-Allow-Methods': 'GET, POST, PUT, DELETE, OPTIONS',
                    'Access-Control-Allow-Headers': 'X-Requested-With, Content-Type, X-Token-Auth, Authorization'
                }
            });

            $.ajax({
                    url: '/admin/users',
                    method: 'GET',
                    success: function (res) {
                        console.log(res);
                        
                        $.each(res.data, function(k, v) {
                            $('#user_id').append(
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

                $.ajax({
                    url: '/admin/categories',
                    method: 'GET',
                    success: function (res) {
                        console.log(res);
                        $.each(res.data, function(k, v) {
                            $('#category_id').append(
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

                $.ajax({
                    url: '/admin/tags',
                    method: 'GET',
                    success: function (res) {
                        console.log(res);
                        $.each(res.data, function(k, v) {
                            $('#tag_id').append(
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
        })
    </script>
@endpush
