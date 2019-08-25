@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card mb-12">
            <div class="row no-gutters">
                <div class="col-md-2">
                <img src="{{ asset('assets/deafult-avatar.png') }}" class="card-img" alt="...">
                </div>
                <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">{{ Auth::user()->name }}</h5>
                    <h6 class="card-text">Jenis Kelamin : {{ Auth::user()->gender }}</h6>
                    <h6 class="card-text">Alamat &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;: {{ (Auth::user()->address) ? 'Bandung, Jawa Barat' : 'Bandung, Jawa Barat' }}</h6>
                    <h6 class="card-text text-bottom"><small class="text-muted">Last updated {{ Auth::user()->updated_at->diffForHumans() }}</small></h6>
                </div>
                </div>
            </div>
        </div>
    </div>
@endsection
