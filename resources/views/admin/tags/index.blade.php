@extends('layouts.master')

@section('title') Data Tags @endsection
@section('add') Data Tags @endsection

@section('content')
    @include('admin.tags.modal')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">
                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#create-tag">Tambah Data</button>
                        </h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="dataTable" class="table table-bordered table-hover">
                            <thead>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Aksi</th>
                            </thead>
                            <tbody class="data-tags">
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
    <link rel="stylesheet" href="{{ asset('backend/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('backend/bower_components/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('backend/bower_components/Ionicons/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('backend/dist/css/AdminLTE.min.css') }}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
        folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('backend/dist/css/skins/_all-skins.min.css') }}">
@endsection

@push('js')
    <!-- jQuery 3 -->
    <script src="{{ asset('backend/bower_components/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{ asset('backend/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ asset('backend/bower_components/fastclick/lib/fastclick.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('backend/dist/js/adminlte.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('backend/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script>
    <!-- DataTables -->
    <script src="{{ asset('backend/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <!-- bootstrap datepicker -->
    <script src="{{ asset('backend/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <!-- bootstrap color picker -->
    <script src="{{ asset('backend/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}"></script>
    <!-- SlimScroll -->
    <script src="{{ asset('backend/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('backend/dist/js/demo.js') }}"></script>

    <script type="text/javascript">
        $(function () {
            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                }
            });

            var table = $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.tags.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'nama', name: 'nama'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });

            var c_tag = $('#c-tag');

            c_tag.on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: '/admin/tags',
                    method: 'POST',
                    data: c_tag.serialize(),
                    success: function (res) {
                        alert(res.message);
                        c_tag[0].reset();
                        location.reload();
                    },
                    error: function (err) {
                        console.log(err)
                    }
                })  
            })

            $('.data-tags').on('click', '.edit-tag-per-id', function (e) {
                e.preventDefault();
                var id = $(this).data('id');

                $.ajax({
                    url: '/admin/tags/' + id,
                    method: 'GET',
                    success: function (res) {
                        $('input[id="e-id"]').val(res.data.id);
                        $('input[id="e-nama"]').val(res.data.nama);
                    },
                    error: function (err) {
                        console.log(err);
                    }
                })

            })

            $('.data-tags').on('click', '.hapus-tag-per-id', function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                var nama = $(this).data('nama');

                $.ajax({
                    url: '/admin/tags/' + id,
                    method: 'GET',
                    success: function (res) {
                       $('input[id="id-h-tag"]').val(id);
                       $('p[id="nama-h-tag"]').html('Apakah kamu yakin menghapus user <b>'+ nama +'</b>?');
                    },
                    error: function (err) {
                        console.log(err);
                    }
                })

            })

            $('#e-tag').on('submit', function (e) {
                e.preventDefault();

                $.ajax({
                    url: '/admin/tags/'+$('#e-id').val(),
                    method: 'PUT',
                    data: $('#e-tag').serialize(),
                    success: function (res) {
                        alert(res.message)
                        location.reload();
                    },
                    error: function (err) {
                        console.log(err)
                    }
                })
            })

            $('#h-tag').on('submit', function (e) {
                e.preventDefault();
                var id = $('#id-h-tag').val()

                $.ajax({
                    url: '/admin/tags/'+id,
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
@endpush