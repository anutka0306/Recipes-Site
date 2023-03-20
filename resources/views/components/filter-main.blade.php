<div class="container mt-5 filter__main">
    <form action="{{ route('search-recipes') }}" method="post" class="d-flex justify-content-start flex-wrap">
        @csrf
        <div class="me-3 mt-3">
            <div class="input-group flex-nowrap">
                {{--<span class="input-group-text" id="addon-wrapping">
                    <a onclick="clearSelect('filterCategory')" style="cursor: pointer">x</a>
                </span>--}}
                <select name="category" id="filterCategory" class="form-select">
                    <option disabled selected>Select category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="me-3 mt-3">
            <div class="input-group flex-nowrap">
                {{--<span class="input-group-text" id="addon-wrapping">
                    <a onclick="clearInput('ingredientAutoComplete')" style="cursor: pointer">x</a>
                </span>--}}
            <input class="form-control ingredientAutoComplete" id="ingredientAutoComplete" name="ingredient" type="text" autocomplete="off" placeholder="Type ingredient's name">
            </div>
            <div id="ingredientFilterResult">
            </div>
        </div>

        <div class="me-3 mt-3">
            <div class="input-group flex-nowrap">
                {{--<span class="input-group-text" id="addon-wrapping1">
                    <a onclick="clearInput('recipeNameAutoComplete')" style="cursor: pointer">x</a>
                </span>--}}
                <input class="form-control recipeNameAutoComplete" id="recipeNameAutoComplete" name="recipe_name" type="text" autocomplete="off" placeholder="Type recipe's name">
            </div>
            <div id="recipeNameFilterResult">
            </div>
        </div>
        <div class="mt-3 d-flex">
            <div class="d-flex align-items-start me-2">
                <button type="submit" class="btn btn-success">Search</button>
            </div>
            <div class="d-flex align-items-start">
                <button type="button" class="btn btn-outline-success">Clear</button>
            </div>
        </div>

    </form>
</div>
