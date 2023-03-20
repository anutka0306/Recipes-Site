<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TCG\Voyager\Models\Category;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\RecipeCategoryController;

class CategoryController extends Controller
{
    public Category $category;
    public PostsController $postsController;

    public function __construct(Category $category, PostsController $postsController, RecipeCategoryController $recipeCategoryController) {
        $this->category = $category;
        $this->postsController = $postsController;
        $this->categories = $recipeCategoryController->getAllCategories();
    }

    public function showCategory($category)
    {
        $curCategory = Category::where('slug', $category)->firstOrFail();
        if($curCategory){
            $category_id = $curCategory->id;
            $posts = $this->postsController->getPostsByCategoryId($category_id);
            return view('posts.category', [
                'posts' => $posts,
                'categories' => $this->categories,
                'curCategory' => $curCategory,
            ]);
        }

    }
}
