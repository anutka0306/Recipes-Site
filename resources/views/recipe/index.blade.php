@extends('layouts.app')
@section('title', 'Best Recipes')
@section('content')
    <section class="recipes__greed container my-5">
        <div class="row">
            <div class="col-12">
                <h1>{{ $recipe->name }}</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12 d-flex">
                <p class="text text-secondar me-3">Category: <a href="{{ route('category-recipes', ['category' => $recipe->recipe_cat->alias]) }}" class="text text-secondary text-decoration-none">{{ $recipe->recipe_cat->name }}</a></p>
                <p class="text text-secondar me-3">Time:
                    @if($recipe->hours > 0)
                        {{ $recipe->hours }} h.
                    @endif

                    @if($recipe->minutes > 0)
                        {{ $recipe->minutes }} min.
                    @endif
                </p>
                <p class="text text-secondar me-3">Difficulty: {{ $recipe->difficulty }}</p>
            </div>
        </div>

        <div class="row">
            <div class="col-12 d-flex justify-content-start align-items-center flex-wrap">
                @foreach($recipe->ingredients as $ingredient)
                    <div class="d-flex justify-content-center align-items-center me-2">
                        <img src="/storage/{{ $ingredient->image }}" width="20">
                        <small class="text text-secondary ms-1">
                            {{ $ingredient->name }} - {{ $ingredient->amount }} {{ $ingredient->amountName }}
                        </small>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="row mt-5 mb-5">
            <div class="col-md-4 col-12">
                <img src="/storage/{{ $recipe->image }}" alt="" class="w-100 recipe__main_photo">
            </div>
            <div class="col-md-8 col-12">
                {!! $recipe->content !!}
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <p class="h3">Steps</p>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-xl-9 col-lg-12">
                    @foreach($recipe->steps as $step)
                        <div class="row mt-5">
                            <div class="col-md-4 col-12">
                                            <img src="/storage/{{ $step->image }}" alt="" class="recipe__detail_image">
                                        </div>
                            <div class="col-md-8 col-12">
                                            {!! $step->content !!}
                                        </div>
                        </div>
                    @endforeach
                </div>
                <div class="col-xl-3 col-lg-12">
                    <hr class="ms-5">
                    <h3 class="ps-5 mt-4 d-block text-decoration-none text-black latest__posts_item_link">Related recipes</h3>
                    <div class="related__recipes_wrapper">
                        @foreach($latestRecipes as $latestRecipe)
                        <div class="w-100 py-3 ps-5 related__recipes_item">
                            <a href="{{ route('recipe', ['recipe' => $latestRecipe->id]) }}">
                                <img class="w-100" height="150" src="{{ asset('/storage/'.$latestRecipe->image) }}">
                                <a class="d-block mt-2 text-uppercase text-secondary text fw-semibold text-decoration-none latest__posts_item_category" href="{{ route('recipe', ['recipe' => $latestRecipe->id]) }}"><small>{{ $latestRecipe->name }}</small></a>
                            </a>
                        </div>
                    @endforeach
                    </div>
                    <hr class="ms-5">
                </div>
            </div>
        </div>
    </section>
@endsection
