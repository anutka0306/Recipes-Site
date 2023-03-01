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
                <p class="text text-secondar me-3">Category: <a href="#" class="text text-secondary text-decoration-none">{{ $recipe->recipe_cat->name }}</a></p>
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
            <div class="col-4">
                <img src="/storage/{{ $recipe->image }}" alt="" width="300">
            </div>
            <div class="col-8">
                {!! $recipe->content !!}
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <p class="h3">Steps</p>
            </div>
        </div>

        @foreach($recipe->steps as $step)
            <div class="row mt-5">
                <div class="col-4">
                    <img src="/storage/{{ $step->image }}" alt="" width="300">
                </div>
                <div class="col-8">
                    {!! $step->content !!}
                </div>
            </div>
        @endforeach
    </section>
@endsection
