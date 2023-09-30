<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Section;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections = Section::all();
        $products = Product::all();
        return view('products.products', compact('sections','products'));
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
     * @param  \IlluminateApp\Models\Product  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Product::create([
            'Product_name' => $request->Product_name,
            'section_id' => $request->section_id,
            'description' => $request->description,
        ]);
        session()->flash('Add', 'تم اضافة المنتج بنجاح ');
        return redirect('/products');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product $products
     * @return \Illuminate\Http\Response
     */
    public function show(Product $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $products
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

       $id = section::where('section_name', $request->section_name)->first()->id;

       $Products = Product::findOrFail($request->pro_id);

       $Products->update([
       'Product_name' => $request->Product_name,
       'description' => $request->description,
       'section_id' => $id,
       ]);

       session()->flash('Edit', 'تم تعديل المنتج بنجاح');
       return back();
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product $products
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
         $Products = Product::findOrFail($request->pro_id);
         $Products->delete();
         session()->flash('delete', 'تم حذف المنتج بنجاح');
         return back();
    }
}