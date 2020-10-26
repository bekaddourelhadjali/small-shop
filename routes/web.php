<?php

use App\User;
use App\Product;
use App\Avis;
use App\Question;
use App\Category;
use App\Response;
use Illuminate\Support\Facades\Redirect;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',function(){
    return redirect('home');
}) ;


Auth::routes();

Route::get('/forum',function(){
    $questions=Question::all();
    return view('forum',["questions"=>$questions]);
})->name('forum');

Route::get('/dashboard',function(){
    return view('dashboard');
})->name('dashboard')->middleware('auth')->middleware('admin');

Route::get('/product/{id}',function(){
    return view('product');
})->name('product');

Route::get('/product',function(){
    return redirect('home');
})->name('product');

Route::get('/product/{id}',function($id){
    $product=product::findOrFail($id);
    $comments=$product->avis;
    return view('product',['product'=>$product,'comments'=>$comments]);
})->name('product.index');
Route::get('/product/{id}/{comment}',function($id,$comment){

    $product=product::findOrFail($id);
    $comments=$product->avis;
    $comment_e=Avis::findOrFail($comment);
    return view('product',['product'=>$product,'comments'=>$comments,'comment_e'=>$comment_e]);
})->name('product.index.edit');


Route::get('/home', 'HomeController@index')->name('home');

Route::get('/settings', function(){
    return view("settings");
})->name('settings')->middleware('auth');

Route::post('/settings',function(){
    $user=new User;
    $user=User::where('id',Auth::user()->id)->update(["name"=>$_POST['name'],"email"=>$_POST['email'],"daten"=>$_POST['daten'],"address"=>$_POST['address'],"phone"=>$_POST['phone']]);
    return redirect()->route('home');
})->name('settings')->middleware('auth');

Route::resource('category','CategoriesController')->middleware( 'auth')->middleware('admin') ;

Route::resource('products','ProductsController')->middleware('auth')->middleware('admin');

Route::resource('sales','SalesController')->middleware('auth');

Route::resource('avis','AvisController')->middleware('auth');
/* example */
Route::get('/store/category/{id}', function(Request $request,$id){
    $category=Category::findOrFail($id);
     $products = $category->products;
     return view('home',["products"=>$products,"category_s"=>$category]);


})->name('store.category');

Route::get('search', function( ){
    $products = Product::where('name','like',"%".$_GET["search"]."%")->orWhere('description','like',"%".$_GET["search"]."%")->get();

      return view('home',['products'=>$products]) ;

})->name('search');

Route::resource('question','QuestionsController')->middleware('auth');
Route::resource('response','ResponsesController')->middleware('auth');


/*Route::filter('search',function(){
    if(Auth::guest()){
        return Redirect::guest('login');
    }
    return Redirect::intended();
});*/
