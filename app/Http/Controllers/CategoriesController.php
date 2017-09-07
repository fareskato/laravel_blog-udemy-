<?php

namespace App\Http\Controllers;
use Session;
use App\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.categories.index')->with('categories', Category::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request
        $rules = [
            'name' => 'required | min: 3',
            'description' => 'required'
        ];
        $this->validate($request, $rules);

        // create the record
        Category::create([
            'name' => $request->name,
            'description' => $request->description
        ]);

        Session::flash('success', 'Category has been created successfully!');

        return redirect()->route('category');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.show')->with('category', $category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit')->with('category', $category);
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
        $category = Category::findOrFail($id);
        $rules = [
            'name' => 'required | min:3',
            'description' => 'required'
        ];

        $this->validate($request, $rules);
        // Use save instead of create
        $category->name = $request->name;
        $category->description = $request->description;
        if($category->save()){
            Session::flash('success', 'Category has benn successfully updated!');

            return redirect()->route('category');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        // Delete all posts associated with category
        foreach ($category->posts as $post){
            $post->forecDelete();
        }
        $category->delete();

        Session::flash('success', 'Category has been deleted successfully!');
        return redirect()->route('category');
    }
}
