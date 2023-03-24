<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Validator;

class CategoryController extends Controller
{
    public function allCategory()
    {
        $categories = Category::all();
        
        return response()->json([
            "success" => true,
            "message" => "Category List",
            "data" => $categories
        ]);
    }

    public function addCategory(Request $request)
    {
        $input = $request->all();
        
        $validator = Validator::make($input, [
            'name' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['Validation Error.', $validator->errors()]);
        }

        $data = Category::create($input);

        return response()->json([
            "success" => true,
            "message" => "Category created successfully.",
            "data" => $data
        ]);
    }

    public function editCategory(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'id' => 'required',
            'name' => 'nullable',
            'enable' => 'nullable',
        ]);
        
        if($validator->fails()){
            return response()->json(['Validation Error.', $validator->errors()]);
        }

        $data = Category::where('id', $request->id)->update($input);

        return response()->json([
            "success" => true,
            "message" => "Category updated successfully.",
            "data" => $input
        ]);
    }
    
    public function deleteCategory(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'id' => 'required',
        ]);
        
        if($validator->fails()){
            return response()->json(['Validation Error.', $validator->errors()]);
        }

        Category::where('id', $request->id)->delete();

        return response()->json([
            "success" => true,
            "message" => "Category deleted successfully.",
        ]);
    }
}
