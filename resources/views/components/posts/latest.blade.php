<div class="container">
    <div class="row my-5 py-5 latest__posts">
        @foreach($posts as $post)
            <div class="latest__posts_item p-3 mt-5 col-md-4 col-sm-6 col-12">
                <a href="{{ route('post', ['post' => $post->slug]) }}"><div class="latest__posts_item_img" style="background-image: url('/storage/{{$post->image}}')"></div></a>
                <a href="{{ route('post', ['post' => $post->slug]) }}" class="mt-4 d-block text-decoration-none text-black latest__posts_item_link">
                    {{ $post->title }}
                </a>
                <a class="d-block mt-2 text-uppercase text-secondary text fw-semibold text-decoration-none latest__posts_item_category" href="{{ route('category', ['category' => $post->category->slug]) }}">{{ $post->category->name }}</a>
            </div>
        @endforeach
    </div>
</div>
</div>
