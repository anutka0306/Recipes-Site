<div class="cat__nav">
    <h1>Best Food</h1>
</div>
<div class="cat__nav_menu container">
    <nav class="navbar navbar-expand-lg bg-dark bg-gradient">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    @foreach($categories as $category)
                        <a class="nav-link text-light" href="{{ route('category-recipes', ['category' => $category->id]) }}">{{ $category->name }}</a>
                    @endforeach
                </div>
            </div>
        </div>
    </nav>
</div>
