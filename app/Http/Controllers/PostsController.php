<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TCG\Voyager\Models\Post;
use App\Http\Controllers\RecipeCategoryController;

class PostsController extends Controller
{
    public Post $post;

    public function __construct(Post $post, RecipeCategoryController $recipeCategoryController) {
        $this->post = $post;
        $this->categories = $recipeCategoryController->getAllCategories();
    }

    public function showPost($alias) {
        $post = $this->post::with('category')->where('slug', $alias)->first();
        $post->image = str_replace('\\', '/', $post->image);
        return view('posts/item', [
           'post' => $post,
            'categories' => $this->categories,
        ]);
    }

    public function getLatestPosts(){
        $posts = $this->post::with('category')->limit(6)->get();
        foreach ($posts as $post){
            $post->image = str_replace('\\', '/', $post->image);
        }
        return $posts;
    }

    public function getPostsByCategoryId($category_id){
        $posts = $this->post::with('category')->where('category_id', '=', $category_id)->paginate(10);
        foreach ($posts as $post){
            $post->image = str_replace('\\','/', $post->image);
        }
        return $posts;
    }

    public function getAllPosts(){
        $posts = $this->post::with('category')->paginate(10);
        foreach ($posts as $post){
            $post->image = str_replace('\\','/', $post->image);
        }
        return view('posts.blog', [
           'posts' => $posts,
            'categories' => $this->categories,
        ]);
    }
}
