<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        $result = [
            'data' => $categories,
            'code' => 200,
            'message' => 'listing category successfully!',
        ];

        return response()->json($result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $category=new Category;
        $validated = $request->validate([
            'name_category' => 'required',
        ]);
        $category->name_category= $request->name_category;
        $category->save();
        
        $result = [
            'data' => $category,
            'code' => 200,
            'message' => 'inserted category successfully!',
        ];

        return response()->json($result);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category =Category::findOrFail($id);
        
        $result = [
            'data' => $category,
            'code' => 200,
            'message' => 'edit category successfully!',
        ];
        return response()->json($result);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $category =Category::findOrFail($id);
        $validated = $request->validate([
            'name_category' => 'required',
        ]);
        $category->name_category= $request->name_category;
        $category->update();
        $result = [
            'data' => $category,
            'code' => 200,
            'message' => 'update category successfully!',
        ];
        return response()->json($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category =Category::findOrFail($id);
        $category->delete();
        
        $result = [
            'data' => $category,
            'code' => 200,
            'message' => 'deleted category successfully!',
        ];
        return response()->json($result);
    }
}
