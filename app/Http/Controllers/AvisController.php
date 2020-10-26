<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\avis;
use App\product;
use auth;

class AvisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect(route('product'));
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

       $comment=new Avis;
       $comment->text=$request->text;
       $comment->product_id=$request->product_id;
       $comment->user_id=Auth::user()->id;
        $comment->save();
       /* $product=product::findOrFail($request->product_id);
        $comments=$product->avis;
        return  (route('product',['product'=>$product,'comments'=>$comments]);*/
       return redirect(route('product.index',['id'=>$comment->product_id]));
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
    {   $comment=Avis::findOrFail($id);
        return redirect(route('product.index.edit',['id'=>$comment->product_id,'comment'=>$comment->id]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    { $comment=Avis::findOrFail($id);
    $comment->text=$request->text;
    $comment->save();
        return redirect(route('product.index',['id'=>$comment->product_id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $comment=Avis::findOrFail($id);
       $comment->delete();
        return redirect(route('product.index',['id'=>$comment->product_id]));
    }
}
