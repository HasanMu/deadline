@extends('layouts.app')

@section('content')
@php
    use App\PostQuestion;
@endphp
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            @include('frontend.partial-index.bagkiri')
        </div>
        <div class="col">
            @include('frontend.partial-index.bagtengah')
        </div>
        <div class="col-md-3">
            @include('frontend.partial-index.bagkanan')
        </div>
    </div>
</div>
@endsection

@push('js')
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script>

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Menampilkan edit postingan
        $('#edit-pq').on('show.bs.modal', function (event) {
            $('#form-e-pq')[0].reset();
            $('#category-pq').html('')
            $('select[name="tags[]"]').html('')
            var button = $(event.relatedTarget) // Button that triggered the modal
            var id = button.data('id') // Extract info from data-* attributes

            var modal = $(this)

            $.ajax({
                url: '/api/v1/post/questions/'+id,
                method: 'GET',
                dataType: 'JSON',
                success: (res) => {
                    $('#id-e-pq').val(res.data.id)
                    modal.find('input[id="judul-pq"]').val(res.data.judul)
                    modal.find('#editor').val(res.data.konten)
                        $.each(res.data_cat, function(k, v) {
                            modal.find('#category-pq').append(
                                `<option value="${v.id}"${(res.data.category.id==v.id) ? ('selected') : ('')}>${v.nama}</option>`
                            )
                        })
                    $.each(res.data.tags, function(kk, vv) {
                        modal.find('select[name="tags[]"]').append(
                            `<option>${vv.nama}</option>`
                        )
                    })
                    // console.log(res.data.category.nama);
                },
                error: (err) => {
                    console.log(err);
                }
            })

        })

        // Menampilkan keterangan hapus data
        $('#hapus-pq').on('show.bs.modal', function (event) {
            $('.mb-h-pq').html('')
            var button = $(event.relatedTarget) // Button that triggered the modal
            var id = button.data('id') // Extract info from data-* attributes

            var modal = $(this)

            $.ajax({
                url: '/api/v1/post/questions/'+id,
                method: 'GET',
                dataType: 'JSON',
                success: (res) => {
                    $('.mb-h-pq').append(
                        `Apakah anda ingin menghapus postingan dengan judul <b>${res.data.judul}</b>`
                    )
                    $('#id-h-pq').val(res.data.id)
                },
                error: (err) => {
                    console.log(err);
                }
            })

        })

        //Form Edit postingan
        $('#form-e-pq').on('submit', function(e) {
            e.preventDefault();

        alert(123)
        })

        // Form Hapus Postingan
        $('#form-h-pq').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: '/api/v1/post/questions/'+$('#id-h-pq').val(),
                method: 'DELETE',
                dataType: 'JSON',
                success: (res) => {
                    alert(res.message)
                    location.reload()
                },
                error: (err) => {
                    console.log(err);
                }
            })
        })

        // Add-on
        $('.edit-tags-pq').select2();
        CKEDITOR.replace('editor')
    </script>
@endpush
