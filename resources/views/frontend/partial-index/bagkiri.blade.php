@guest
    <div class="card bg-light mb-3">
        <div class="card-header text-center"> Login terlebih dahulu</div>
            <div class="card-body">
                <p>
                    <a class="btn btn-secondary" href="/register" role="button" style="width: 100%">Register</a>
                </p>
                {{--  --}}
                <p>
                    <a class="btn btn-success" href="/login" role="button" style="width: 100%">Login</a>
                </p>
            </div>
    </div>
@else
    <div class="card bg-light mb-3">
        <div class="card-header text-center">{{ Auth::user()->name }}</div>
            <div class="card-body">
                <center>
                    <img src="{{ asset('assets/deafult-avatar.png') }}" class="col-md-6 card-img" alt="..." height="100px">
                </center>
                <p class="card-text">Alamat &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; : {{(Auth::user()->address) ? Auth::user()->address : 'Bandung, Jawa Barat'}}</p>
                <p class="card-text">Jenis Kelamin : {{ Auth::user()->gender }}</p>
            </div>
    </div>
@endguest
