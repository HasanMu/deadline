@extends('layouts.master')

@section('title') Data Users @endsection
@section('add') Data Users @endsection

@section('content')
    @include('admin.users.modal')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">
                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#create-user">Tambah Data</button>
                        </h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="dataTable" class="table table-bordered table-hover">
                            <thead>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Tanggal Lahir</th>
                                <th>Jenis Kelamin</th>
                                <th>Aksi</th>
                            </thead>
                            <tbody class="data-users">
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
      <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/iCheck/all.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
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
    <!-- bootstrap time picker -->
    <script src="{{ asset('backend/plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>
    <!-- iCheck 1.0.1 -->
    <script src="{{ asset('backend/plugins/iCheck/icheck.min.js') }}"></script>
    <!-- SlimScroll -->
    <script src="{{ asset('backend/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('backend/dist/js/demo.js') }}"></script>

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

            var table = $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.users.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'dob', name: 'dob'},
                    {data: 'gender', name: 'gender'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });

            //Date picker
            $('#datepicker').datepicker({
                autoclose: true
            })
            //Date picker
            $('.dpicker').datepicker({
                autoclose: true
            })

            var c_user = $('#c-user');

            c_user.on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: '/backend/users',
                    method: 'POST',
                    data: c_user.serialize(),
                    success: function (res) {
                        alert('Data berhasil disimpan');
                        c_user[0].reset();
                        location.reload();
                    },
                    error: function (err) {
                        console.log(err)
                    }
                })  
            })

            $('.data-users').on('click', '.edit-user-per-id', function (e) {
                e.preventDefault();
                var id = $(this).data('id');

                $.ajax({
                    url: '/backend/users/' + id,
                    method: 'GET',
                    success: function (res) {
                        $('input[id="e-id"]').val(res.data.id);
                        $('input[id="e-nama"]').val(res.data.name);
                        $('input[id="e-email"]').val(res.data.email);
                        $('input[id="datepicker e-dob"]').val(res.data.dob);
                        if(res.data.gender == 'Laki - Laki') {
                            $('input[class="minimal l"]').attr('checked', 'true');
                        } else {
                            $('input[class="minimal p"]').attr('checked', 'true');
                        }
                    },
                    error: function (err) {
                        console.log(err);
                    }
                })

            })

            $('.data-users').on('click', '.hapus-user-per-id', function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                var nama = $(this).data('nama');

                $.ajax({
                    url: '/backend/users/' + id,
                    method: 'GET',
                    success: function (res) {
                       $('input[id="id-h-user"]').val(id);
                       $('p[id="nama-h-user"]').html('Apakah kamu yakin menghapus user <b>'+ nama +'</b>?');
                    },
                    error: function (err) {
                        console.log(err);
                    }
                })

            })

            $('#e-user').on('submit', function (e) {
                e.preventDefault();

                $.ajax({
                    url: '/backend/users/'+$('#e-id').val(),
                    method: 'PUT',
                    data: $('#e-user').serialize(),
                    success: function (res) {
                        alert('Data berhasil diubah!')
                        location.reload();
                    },
                    error: function (err) {
                        console.log(err)
                    }
                })
            })

            $('#h-user').on('submit', function (e) {
                e.preventDefault();
                var id = $('#id-h-user').val()

                $.ajax({
                    url: '/backend/users/'+id,
                    method: 'DELETE',
                    success: function (res) {
                        alert('Data berhasil dihapus')
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