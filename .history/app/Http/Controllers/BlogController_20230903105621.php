<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():View
    {
        $blogs = Blog::latest()->paginate(5);

        return view('blogs.index',compact('blog'))

                    ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create():View
    {
        return view('blog.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([

            'name' => 'required',

            'detail' => 'required',

        ]);

        

       Blog::create($request->all());

         

        return redirect()->route('blog.index')

                        ->with('success','Blog created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog):View
    {
        return view('blog.show',compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog):View
    {
        return view('blog.edit',compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog): RedirectResponse
    {
        $request->validate([

            'name' => 'required',

            'detail' => 'required',

        ]);

        $blog->update($request->all());

        return redirect()->route('blog.index')

                        ->with('success','Blog updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog): RedirectResponse
    {
        $blog->delete();

        return redirect()->route('blog.index')

                        ->with('success','Blog deleted successfully');

    
    }
}
