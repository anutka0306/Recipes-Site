@extends('layouts.app')
@section('title', 'Best Recipes')
@section('content')

    <x-posts.latest :posts="$posts" />
    <x-recipes.latest :recipes="$latestRecipes" />
    <x-sliders.flex :bannerRecipes="$bannerRecipes" />
    <x-recipes.cook-now :cookNowRecipe="$cookNow" />
    {{--<section class="recipes__greed container my-5">
        <div class="row">
        @foreach($recipes as $recipe)
            <x-recipes.item :recipe="$recipe" />
        @endforeach
        </div>
    </section>
    {{ $recipes->links() }}--}}
@endsection

