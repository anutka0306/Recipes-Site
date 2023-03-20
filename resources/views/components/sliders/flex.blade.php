<h2 class="text-center h2 pt-5">Most Popular Recipes</h2>
<div class="slider-flex">
    <div class="container">
        @foreach($bannerRecipes as $key => $bannerRecipe)
            <div
        class="slide @if($key == 0) active @endif"
        style="background-image: url('/storage/{{$bannerRecipe->banner_photo}}');"
    >
        <h3><a href="{{ route('recipe', ['recipe' => $bannerRecipe->id]) }}">{{ $bannerRecipe->name }}</a></h3>
    </div>
        @endforeach

</div>
</div>

<script>
    const slides = document.querySelectorAll('.slider-flex .slide');
    slides.forEach((slide) => {
        slide.addEventListener('click', () => {
            clearActiveClass();
            slide.classList.add('active');
        })
    });

    function clearActiveClass() {
        slides.forEach((slide) => {
            slide.classList.remove('active');
        });
    }
</script>
