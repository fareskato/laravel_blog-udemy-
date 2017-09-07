<?php

namespace App\Http\Controllers;

use App\Setting;
use App\Category;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index(){
        $categories = Category::all()->take(5);
        $last_post = Post::orderBy('created_at', 'desc')->first();
        $second_post = Post::orderBy('created_at', 'desc')->skip(1)->take(1)->get()->first();
        $third_post = Post::orderBy('created_at', 'desc')->skip(2)->take(1)->get()->first();
        return view('index')
            ->with('title', Setting::first()->site_name)
            ->with('last_post', $last_post)
            ->with('second_post', $second_post)
            ->with('third_post', $third_post)
            ->with('settings', Setting::first())
            ->with('categories', $categories)
            ->with('all_categories', Category::all());
    }


    /**
    * single post
     */
    public function singlePost($slug){
        $post = Post::where('slug', $slug)->first();
        // get the next record(post)
        $next_id = Post::where('id','>',$post->id )->min('id');
        // get the previous record(post)
        $prev_id = Post::where('id','<',$post->id )->max('id');
        $categories = Category::all()->take(5);
        return view('front.single')
            ->with('title', $post->title)
            ->with('settings', Setting::first())
            ->with('categories', $categories)
            ->with('next_post', Post::find($next_id))
            ->with('prev_post', Post::find($prev_id))
            ->with('tags', Tag::all())
            ->with('post', $post);
    }


    /* Category page */
    public function category($id){
        $category = Category::findOrFail($id);
        $categories = Category::all()->take(5);
        return view('front.category')
            ->with('title', $category->name)
            ->with('settings', Setting::first())
            ->with('categories', $categories)
            ->with('category', $category);
    }
    /* Tag page */
    public function tag($id){
        $tag = Tag::findOrFail($id);
        $categories = Category::all()->take(5);
        return view('front.tag')
            ->with('title', $tag->tag)
            ->with('settings', Setting::first())
            ->with('categories', $categories)
            ->with('tag', $tag);
    }


}
