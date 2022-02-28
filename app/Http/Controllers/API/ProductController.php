<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('created_at')->get();

        return response()->json($products, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:50',
            'type' => 'required|string|max:50',
            'price' => 'required|numeric',
            'rating' => 'nullable|integer',
            'description' => 'nullable|string|max:150'
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 422);
        }

        $product = Product::create($request->all());

        return response()->json(['message' => 'Product ' . $product->title . ', created with success!'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);

        return response()->json(['product' => $product], 200);
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
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:50',
            'type' => 'required|string|max:50',
            'price' => 'required|numeric',
            'rating' => 'nullable|integer',
            'description' => 'nullable|string|max:150'
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 422);
        }

        $product = Product::findOrFail($id);
        $product->update($request->all());

        return response()->json(['message' => 'Product ' . $product->title . ', updated with success!'], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json(['message' => 'Product ' . $product->title . ', deleted with success!'], 201);
    }
}
