@extends('layouts.app')
@section('title', 'Best Recipes - '. $current_category->name .' category')
@section('content')
    <section class="recipes__greed container my-5">
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
