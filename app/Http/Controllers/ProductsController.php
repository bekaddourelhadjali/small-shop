<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use Illuminate\Support\Facades\Storage as Storage;
class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //    $d= Storage::disk('local')->getAdapter()->getPathPrefix();
        //    echo $d;
       // echo "<img src='".asset("../storage/app/products/product2/module_table_bottom.png")."'>";

        $products =   Product::all();
        $categories = Category::all();
     return view ('products',['products'=>$products,'categories'=>$categories ] );
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
    $product = new Product();
    $product->name=$request->name;
    $product->quantity=$request->quantity;
    $product->price=$request->price;
    $product->description=$request->description;
    $product->category_id=$request->category_id;
    $array=array();
    foreach ($request->images as $image){
        array_push($array,$image->getClientOriginalName());
    }
    $product->images=implode(',',$array);

    foreach ($request->images as $image){
   $image->storeAs('products/'.$product->name,$image->getClientOriginalName());
    }
   $product->save();
   return redirect(route('products.index'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   $product_e=Product::findOrFail($id);
        $products =   Product::all();
        $categories = Category::all();
        return view ('products',['products'=>$products,'categories'=>$categories ,'product_e'=>$product_e] );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    { $product =Product::findOrFail($id);
        $product->name=$request->name;
        $product->quantity=$request->quantity;
        $product->price=$request->price;
        $product->description=$request->description;
        $product->category_id=$request->category_id;
        $product->save();
        return redirect(route('products.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product=Product::findOrFail($id);
        $product->delete();
        Storage::deleteDirectory('products/'.$product->name);
        return redirect(route('products.index'));
    }
}
