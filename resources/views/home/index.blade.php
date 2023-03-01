@extends('layouts.app')
@section('title', 'Best Recipes')
@section('content')
    <section class="recipes__greed container my-5">
        <div class="row">
        @foreach($recipes as $recipe)
            <x-recipes.item :recipe="$recipe" />
        @endforeach
        </div>
    </section>
    {{ $recipes->links() }}
@endsection
