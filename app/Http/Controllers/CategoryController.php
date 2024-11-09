<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Http\Resources\ErrorResource;
use App\Http\Resources\SuccessResource;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::latest()->get();
        return new  SuccessResource(['data' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $data = Validator::make($request->all(), [
            'name' => 'required|string|unique:categories',
        ]);

        if ($data->fails()) {

            return (new ErrorResource($data->getMessageBag()))->response()->setStatusCode(422);
        };
        $fromData = $data->validate();
        $fromData['slug'] = Str::slug($fromData['name']);
        Category::create($fromData);

        // retun json
        return (new SuccessResource(['message' => 'Successfully created']))->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {


        if (!is_numeric($id)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid ID format.',
                'errors' => [
                    'id' => 'The provided ID must be a valid numeric value.'
                ]
            ], 400);
        }
        $category = Category::find($id);

        if (!$category) {
            return (new ErrorResource($category->getMessageBag()))->response()->setStatusCode(422);
        }

        return new  SuccessResource(['data' => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(string $id)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Error',
                'errors' => $category->getMessageBag()
            ], 404);
        }

        $data = Validator::make($request->all(), [
            'name' => 'required|string|unique:categories,name,' . $category->id,
        ]);

        if ($data->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Error',
                'errors' => $data->getMessageBag()
            ], 422);
        };

        $fromData = $data->validate();
        $fromData['slug'] = Str::slug($fromData['name']);
        $category->update($fromData);

        // retun json
        return new SuccessResource(['data' => $category]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Error',
                'errors' => $category->getMessageBag()
            ], 404);
        }

        $category->delete();

        return (new SuccessResource(['message' => 'Successfully Deleted']))->response()->setStatusCode(201);
    }
}
