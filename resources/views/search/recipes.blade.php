@extends('layouts.app')
@section('title', 'Best Recipes search')
@section('content')
    <section class="recipes__greed container my-5">
        <div class="row">
    @if($recipes && count($recipes) > 0)
        @foreach($recipes as $recipe)
            <x-recipes.item :recipe="$recipe" />
        @endforeach
    @else
        <p>Nothing found</p>
    @endif
        </div>
    </section>
@endsection
