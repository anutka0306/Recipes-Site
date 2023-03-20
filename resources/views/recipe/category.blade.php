@extends('layouts.app')
@section('title', 'Best Recipes - '. $current_category->name .' category')
@section('content')
    <section class="recipes__greed container my-5">
        <div class="row">
            <div class="col-12">
                <div class="post__header d-flex align-items-center justify-content-center">
                    <div>
                        <h1>{{ $current_category->name }}</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($recipes as $recipe)
                <x-recipes.item :recipe="$recipe" />
            @endforeach
        </div>
        <div class="row">
            {{ $recipes->links() }}
        </div>
    </section>
@endsection
