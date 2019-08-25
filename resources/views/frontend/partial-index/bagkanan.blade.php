<div class="card bg-light mb-3">
    <div class="card-header">
        <b>Kategori</b>
    </div>
        <div class="card-body">
            <ul class="list-group container-fluid">
                @php
                    $all_kategori = \App\Category::with('postquestion')->get();
                @endphp
                @foreach($all_kategori as $kategori)
                    @if($kategori->PostQuestion->count() > 0)
                        <a href="/category/{{ $kategori->slug }}">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $kategori->nama }}
                                <span class="badge badge-primary badge-pill">{{ $kategori->PostQuestion->count() }}</span>
                            </li>
                        </a>
                    @endif
                @endforeach
            </ul>
        </div>
</div>

<div class="card bg-light mb-3">
        <div class="card-header">
            <b>Tag</b>
        </div>
            <div class="card-body">
                <ul class="list-group container-fluid">
                    @php
                        $all_tag = \App\Tag::with('postquestion')->get();
                    @endphp
                    @foreach($all_tag as $tag)
                        @if($tag->PostQuestion->count() > 0)
                            <a href="/tag/{{ $tag->slug }}">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $tag->nama }}
                                    <span class="badge badge-primary badge-pill">{{ $tag->PostQuestion->count() }}</span>
                                </li>
                            </a>
                        @endif
                    @endforeach
                </ul>
            </div>
    </div>
