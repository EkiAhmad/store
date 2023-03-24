<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CategoryProduct;
use App\Models\Image;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Validator;

class ProductController extends Controller
{
    public function allProduct()
    {
        // $products = Product::all();
        $products = Product::GetProduct();
        
        return response()->json([
            "success" => true,
            "message" => "Product List",
            "data" => $products
        ]);
    }
    
    public function addProduct(Request $request)
    {
        $input = $request->all();
        
        $validator = Validator::make($input, [
            'name' => 'required',
            'description' => 'required',
            'category_id' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['Validation Error.', $validator->errors()]);
        }

        $product_id = Product::create($input)->id;

        $uploadFolder = 'products';
        $image = $request->file('image');
        if ($image) {
            $image_uploaded_path = $image->store($uploadFolder, 'public');
            
            // $uploadedImageResponse = array(
            //     "image_name" => basename($image_uploaded_path),
            //     "image_url" => Storage::disk('public')->url($image_uploaded_path),
            //     "mime" => $image->getClientMimeType()
            // );
    
            $input_img = [
                'name' => basename($image_uploaded_path),
                'file' => Storage::disk('public')->url($image_uploaded_path),
            ];
            
            $image_id = Image::create($input_img)->id;

            $data_ip = [
                'image_id' => $image_id,
                'product_id' => $product_id,
            ];
            $product_image = ProductImage::create($data_ip);
        }

        $data_cp = [
            'category_id' => $request->category_id,
            'product_id' => $product_id,
        ];
        $product_category = CategoryProduct::create($data_cp);
        
        return response()->json([
            "success" => true,
            "message" => "Product created successfully.",
            // "data" => $data
        ]);
    } 

    // public function show($id)
    // {
    //     $product = Product::find($id);
    //     if (is_null($product)) {
    //         return $this->sendError('Product not found.');
    //     }

    //     return response()->json([
    //         "success" => true,
    //         "message" => "Product retrieved successfully.",
    //         "data" => $product
    //     ]);
    // }
    
    public function editProduct(Request $request, Product $product)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'id' => 'required',
            'name' => 'nullable',
            'description' => 'nullable',
            'category_id' => 'nullable',
            'enable' => 'nullable',
        ]);
        
        if($validator->fails()){
            return response()->json(['Validation Error.', $validator->errors()]);
        }

        $input_product = [
            'name' => $request->name,
            'description' => $request->description,
            'enable' => $request->enable,
        ];

        $product_id = Product::where('id', $request->id)->update($input_product);

        $uploadFolder = 'products';
        $image = $request->file('image');
        if ($image) {
            $image_uploaded_path = $image->store($uploadFolder, 'public');
            
            // $uploadedImageResponse = array(
            //     "image_name" => basename($image_uploaded_path),
            //     "image_url" => Storage::disk('public')->url($image_uploaded_path),
            //     "mime" => $image->getClientMimeType()
            // );
    
            $input_img = [
                'name' => basename($image_uploaded_path),
                'file' => Storage::disk('public')->url($image_uploaded_path),
            ];
            
            $image_id = ProductImage::where('product_id', $request->id)->first();
            $image_id->image_id;
            Image::where('id', $image_id)->update($input_img);
        }

        // $data_cp = [
        //     'category_id' => $request->category_id,
        //     'product_id' => $request->id,
        // ];
        // $product_category = CategoryProduct::create($data_cp);
        
        // $product->name = $input['name'];
        // $product->detail = $input['detail'];
        // $product->save();

        return response()->json([
            "success" => true,
            "message" => "Product updated successfully.",
            // "data" => $product
        ]);
    }
    
    public function deleteProduct(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'id' => 'required',
        ]);
        
        if($validator->fails()){
            return response()->json(['Validation Error.', $validator->errors()]);
        }

        Product::where('id', $request->id)->delete();

        CategoryProduct::where('product_id', $request->id)->delete();

        $image_id = ProductImage::where('product_id', $request->id)->first();

        if ($image_id) {
            $image_id->image_id;
            Image::where('id', $image_id)->delete();
            
            ProductImage::where('product_id', $request->id)->delete();
        }

        return response()->json([
            "success" => true,
            "message" => "Product deleted successfully.",
            // "data" => $product
        ]);
    }
}
