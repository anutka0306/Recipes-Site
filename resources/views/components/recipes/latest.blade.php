<div class="latest__recipes_wrap py-1 my-5">
    <div class="container">
        <div class="row my-5 py-2 latest__recipes">
            <h2 class="text-center">Our Newest Recipes</h2>
            @foreach($recipes as $recipe)
                <div class="latest__recipes_item p-3 mt-5">
                    <a href="{{ route('recipe', ['recipe' => $recipe->id]) }}"><div class="latest__recipes_item_img" style="background-image: url('/storage/{{$recipe->image}}')"></div></a>
                    <a href="{{ route('recipe', ['recipe' => $recipe->id]) }}" class="mt-4 d-block text-decoration-none text-danger latest__recipes_item_link">
                    {{ $recipe->name }}
                    </a>
                    <a class="d-block mt-3 text-uppercase text-secondary fs-6 text fw-semibold text-decoration-none" href="{{ route('category-recipes', ['category' => $recipe->recipe_cat->alias]) }}">{{ $recipe->recipe_cat->name }}</a>
                </div>
            @endforeach
        </div>
    </div>
</div>
