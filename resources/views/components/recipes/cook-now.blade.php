<div class="my-5 py-5">
    <div
        class="cook-now d-flex justify-content-end align-items-center p-3"
        style="background-image: url('/storage/{{ $cookNowRecipe->banner_photo }}')"
    >
        <div class="card w-50 p-5">
            <div class="card-body">
                <h3 class="card-title text-danger h3">{{ $cookNowRecipe->name }}</h3>
                <p class="card-text">{!! $cookNowRecipe->description !!}</p>
                <a class="card-link text-uppercase text-decoration-none text-success mx-auto d-block text-end fw-bolder" href="{{ route('recipe', ['recipe' => $cookNowRecipe->id]) }}">View Recipe &#8594;</a>
            </div>
        </div>
    </div>
</div>
