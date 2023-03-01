<div class="col-12 recipes__greed_item p-5 shadow rounded mb-5">
    <div class="recipe__item_name mb-4">
        <a href="{{ route('recipe', ['recipe' => $recipe->id]) }}" class="h3 text-decoration-none text-success">
            {{ $recipe->name }}
        </a>
    </div>
    <div class="recipe__item_meta d-flex justify-content-between mb-4">
        <div class="recipe__item_meta_ingredients d-flex justify-content-start align-items-center flex-wrap w-75">
            @foreach($recipe->ingredients as $ingredient)
                <div class="d-flex justify-content-center align-items-center me-2">
                    <img src="/storage/{{ $ingredient->image }}" width="20">
                    <small class="text text-secondary ms-1">
                        {{ $ingredient->name }} - {{ $ingredient->amount }} {{ $ingredient->amountName }}
                    </small>
                </div>
            @endforeach
        </div>
        <div class="recipe__item_meta_time w-15">
            <small class="text text-secondary">Time:
            @if($recipe->hours > 0)
                {{ $recipe->hours }} h.
            @endif

            @if($recipe->minutes > 0)
                    {{ $recipe->minutes }} min.
                @endif
            </small>
        </div>
        <div class="recipe__item_meta_level w-10">
            <small class="text text-secondary">
            Difficulty: {{ $recipe->difficulty }}
            </small>
        </div>
    </div>
    <div class="recipe__item_content d-flex mt-3">
        <div class="recipe__item_content_image w-25 me-5">
            <img src="/storage/{{ $recipe->image }}" alt="" width="300">
        </div>
        <div class="recipe__item_content_description text-body-emphasis">
            {!! $recipe->content !!}
        </div>
    </div>
</div>
