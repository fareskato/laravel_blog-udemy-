<?php

namespace App\Http\Controllers;
use App\Post;
use App\Category;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.posts.index')->with('posts', Post::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        // if there is no category created before
        if($categories->count() == 0 || $tags->count() == 0){
            Session::flash('info', 'U have to create category and tag before attempting to create a post!');
            return redirect()->back();
        }
        return view('admin.posts.create')
                                        ->with('categories',$categories)
                                        ->with('tags',$tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /* Validation */
        $rules = [
            'title' => 'required',
            'content' => 'required',
            'featured' => 'required | image',
            'category_id' => 'required',
            'tags' => 'required',
        ];
        $this->validate($request, $rules);

        /* Handle the image */
        $featured = $request->featured;
        $featured_new_name = time() . $featured->getClientOriginalName();
        $featured->move('uploads/posts', $featured_new_name);

        /* store the post */
        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => Auth::id(),
            'slug' => str_slug($request->title),
            'category_id' => str_slug($request->category_id),
            'featured' => 'uploads/posts/' . $featured_new_name,
        ]);
        // add tags array to the post
        $post->tags()->attach($request->tags);

        /* Notification */
        Session::flash('success', 'Posts created successfully!');
        /* Redirect after create post */
        return redirect()->route('post');

//        dd($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.posts.show')->with('post', Post::findOrFail($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::all();
        $tags = Tag::all();
        return view ('admin.posts.edit')
                                        ->with('post', $post)
                                        ->with('categories', $categories)
                                        ->with('tags', $tags);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validate the request
        $rules = [
            'title' => 'required',
            'content' => 'required',
            'category_id' => 'required',
        ];
        $this->validate($request, $rules);

        $post = Post::findOrFail($id);

        // check if the user will update the image
        if($request->hasFile('featured')){
            $featured = $request->featured;
            $featured_new_name = time() . $featured->getClientOriginalName();
            $featured->move('uploads/posts', $featured_new_name);
            // update the image
            $post->featured = 'uploads/posts/'.$featured_new_name;
        }
        // update date

            $post->title = $request->title;
            $post->content = $request->content;
            $post->category_id = $request->category_id;

            $post->save();

         // tags
         $post->tags()->sync($request->tags);

        // notification
        Session::flash('success', 'Post updated successfully!');

        // redirect
        return redirect()->route('post');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    // Important :: use delete and trash for soft delete
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        if($post->delete()){
            Session::flash('success', 'Posts trashed!');
            return redirect()->back();
        }
    }
    // Soft delete
    public function trash(){
        $trashed_posts = Post::onlyTrashed()->get();

        return view('admin.posts.trashed')->with('trashed_posts', $trashed_posts);
    }

    // Delete permanently
    public function kill($id){
        $trashed_post = Post::withTrashed()->where('id', $id)->first();
        $trashed_post->forceDelete();

        Session::flash('success', 'Post has been permanently deleted!');

        return redirect()->back();
    }

    // Restore soft deleted posts
    public function restore($id){
        Post::withTrashed()->where('id', $id)->first()->restore();

        Session::flash('success', 'Post restored');

        return redirect()->back();
    }

}
