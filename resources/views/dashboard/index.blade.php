@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Welcome back, {{ auth()->user()->name }}</h1>
</div>


<div class="container">
    <div class="row">
        @foreach($products as $produks)
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="position-absolute  px-3 py-2 text-white" style="background-color: rgba(0,0,0,0.7)"><a
                        class="text-decoration-none text-white" href="/blog?category={{ $produks->id }}">{{
                        $produks->category->name }}</a></div>
                {{-- @if ($produks->image)
                    <img src="{{ asset('storage/' . $produks->image) }}" class="img-fluid mt-3"
                    alt="{{ $produks->category->name }}">
                @else --}}
                {{-- <img src="https://source.unspLash.com/500x400/?{{ $produks->category->name }}" class="card-img-top"
                    alt="{{ $produks->category->name }}">
                @endif --}}

                <div class="card-body">
                    <h5 class="card-title">{{ $produks->produk_name }}</h5>
                    {{-- <p>
                        <small class="text-muted">Author : <a href="/blog?author={{ $produks->author->username }}"
                                class="text-decoration-none">{{
                                $produks->author->name}}</a>
                            {{ $produks->created_at->diffForHumans() }}
                        </small>
                    </p> --}}
                    {{-- <p class="card-text">{{ $produks->excerpt }}</p> --}}
                    <a href="/produks/{{ $produks->id }}" class="btn btn-primary">Read More</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection