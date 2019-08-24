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
                <h5 class="card-title">Light card title</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            </div>
    </div>
@endguest
