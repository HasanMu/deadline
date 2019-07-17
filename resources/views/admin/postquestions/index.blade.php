@extends('layouts.master')

@section('title') Data Tags @endsection
@section('add') Data Tags @endsection

@section('content')
    @include('admin.postquestions.modal')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">
                            <button type="button" class="btn btn-success btn-sm mc-pq" data-toggle="modal" data-target="#create-postquestion">Tambah Data</button>
                        </h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="dataTable" class="table table-bordered table-hover">
                            <thead>
                                <th>Judul</th>
                                <th>Foto</th>
                                <th>Author</th>
                                <th>Kategori</th>
                                <th>Tag</th>
                                <th>Aksi</th>
                            </thead>
                            <tbody class="data-pq">
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>

@endsection

@section('css')
     <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('admin/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('admin/bower_components/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('admin/bower_components/Ionicons/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('admin/dist/css/AdminLTE.min.css') }}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
        folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('admin/dist/css/skins/_all-skins.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
    <style>
    .select2-selection__choice {
        color: #fff;
    }</style>
@endsection

@push('js')
    <!-- jQuery 3 -->
    <script src="{{ asset('admin/bower_components/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{ asset('admin/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ asset('admin/bower_components/fastclick/lib/fastclick.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('admin/dist/js/adminlte.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('admin/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script>
    <!-- DataTables -->
    <script src="{{ asset('admin/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <!-- bootstrap datepicker -->
    <script src="{{ asset('admin/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <!-- bootstrap color picker -->
    <script src="{{ asset('admin/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}"></script>
    <!-- SlimScroll -->
    <script src="{{ asset('admin/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('js/select2.min.js') }}">
    <script src="{{ asset('admin/ckeditor5-build-decoupled-document/ckeditor.js') }}">
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('admin/dist/js/demo.js') }}"></script>
    

    <script type="text/javascript">
        $(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Access-Control-Allow-Origin': '*',
                    'Access-Control-Allow-Methods': 'GET, POST, PUT, DELETE, OPTIONS',
                    'Access-Control-Allow-Headers': 'X-Requested-With, Content-Type, X-Token-Auth, Authorization'
                }
            });

            $('#tag_id').select2({});

            CKEDITOR.replace('konten')

            var table = $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.questions.index') }}",
                columns: [
                    {data: 'judul', name: 'judul'},
                    {data: 'img', name: 'foto'},
                    {data: 'user.name', name: 'user.name'},
                    {data: 'category.nama', name: 'category.nama'},
                    {data: 'tags', name: 'tags.nama'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });

            $('.mc-pq').on('click', function (e) {
                e.preventDefault();

                $.ajax({
                    url: '/admin/users',
                    method: 'GET',
                    success: function (res) {
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

            $('#c-pq').on('submit', function (e) {
                var formData = new FormData($('#c-pq')[0]);
                e.preventDefault();

                $.ajax({
                    url: '/admin/post/questions',
                    method: "POST",
                    dataType: "JSON",
                    contentType: false,
                    processData: false,
                    data: formData,
                    cache: true,
                    success: function (res) {
                        $('#c-pq')[0].reset();
                        alert(res.message);
                        location.reload();
                    },
                    error: function (err) {
                        console.log(err)
                    }
                })
            })

            // $('.data-tags').on('click', '.edit-tag-per-id', function (e) {
            //     e.preventDefault();
            //     var id = $(this).data('id');

            //     $.ajax({
            //         url: '/admin/tags/' + id,
            //         method: 'GET',
            //         success: function (res) {
            //             $('input[id="e-id"]').val(res.data.id);
            //             $('input[id="e-nama"]').val(res.data.nama);
            //         },
            //         error: function (err) {
            //             console.log(err);
            //         }
            //     })

            // })

            $('.data-pq').on('click', '.hapus-post-question-per-id', function (e) {
                e.preventDefault();

                var id = $(this).data('id');
                var judul = $(this).data('judul');

                $.ajax({
                    url: '/admin/post/questions/' + id,
                    method: 'GET',
                    success: function (res) {
                       $('input[id="id-h-pq"]').val(id);
                       $('p[id="nama-h-pq"]').html('Apakah kamu yakin menghapus pertanyaan dengan judul <b>'+ judul +'</b>?');
                    },
                    error: function (err) {
                        console.log(err);
                    }
                })

            })

            // $('#e-tag').on('submit', function (e) {
            //     e.preventDefault();

            //     $.ajax({
            //         url: '/admin/tags/'+$('#e-id').val(),
            //         method: 'PUT',
            //         data: $('#e-tag').serialize(),
            //         success: function (res) {
            //             alert(res.message)
            //             location.reload();
            //         },
            //         error: function (err) {
            //             console.log(err)
            //         }
            //     })
            // })

            $('#h-pq').on('submit', function (e) {
                e.preventDefault();
                var id = $('#id-h-pq').val()

                $.ajax({
                    url: '/admin/post/questions/'+id,
                    method: 'DELETE',
                    success: function (res) {
                        alert(res.message)
                        location.reload();
                    },
                    error: function (err) {
                        console.log(err)
                    }
                })
            })

        });
    </script>

    <script>
        DecoupledEditor
            .create(document.querySelector('#konten'),{
                // toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
            })
            .then( editor => {
                const toolbarContainer = document.querySelector( 'main .toolbar-container' );
                toolbarContainer.prepend( editor.ui.view.toolbar.element );
                window.editor = editor;
            })
            .catch( err => {
                console.error( err.stack );
            });
    </script>

@endpush
