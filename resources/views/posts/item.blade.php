@extends('layouts.app')
@section('title', $post->title)
@section('content')
    <section class="recipes__greed container my-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="post__header d-flex align-items-center">
                        <img src="{{ asset('/storage/'.$post->image) }}" alt="" width="300">
                        <div>
                            <h1>{{ $post->title }}</h1>
                            <a class="d-block mt-3 text-uppercase text-secondary text fw-semibold text-decoration-none latest__posts_item_category post__category" href="{{ route('category', ['category' => $post->category->slug]) }}">{{ $post->category->name }}</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row my-5">
                <div class="col-12">
                    {!! $post->body !!}
                </div>
            </div>
        </div>
    </section>
@endsection
