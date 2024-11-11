<?php

namespace App\Http\Controllers;

use App\Http\Resources\ErrorResource;
use App\Http\Resources\SuccessResource;
use App\Models\Post;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $post = Post::latest()->get();
        return new SuccessResource(['data' => $post]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'categories_id' => 'required|integer',
            'title' => 'required|string|max:180|unique:posts',
            'photo' => 'nullable|image|mimes:png,jpg,jpeg|max:2028',
            'content' => 'required|string'
        ]);

        if ($validator->fails()) {
            return new ErrorResource(['message' => $validator->errors()]);
        }

        $data = $validator->validated();
        $data['slug'] = Str::slug($data['title']);

        if ($request->hasFile('photo')) {
            $data['photo'] = Storage::putFile('photos', $request->file('photo'));
        }

        $post = Post::create($data);

        return new SuccessResource([
            'message' => 'Post Created Successfully',
            'data' => $post
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return new SuccessResource([
            'data' => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
