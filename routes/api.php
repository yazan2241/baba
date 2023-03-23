<?php

use App\Models\baba;
use App\Models\customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/insert_customer' , function(Request $request){
    $name = $request->input('name');
    $customer = new customer();
    $customer->name = $name;
    if($customer->save()){

    return Response::json(
        $customer
    , 200);
    }
    else{
        return Response::json(
            ['error' => 'no database']
        , 404);
    }

});

Route::post('clear_database' , function(Request $request){
    DB::select("truncate table babas");
    DB::select("truncate table customers");
    return Response::json(
        ['success' => 'database cleared']
    , 200);
});

Route::post('insert_product' , function(Request $request){
    $name = $request->input('name');
    $type = $request->input('type');
    $weight = $request->input('weight');
    $price = $request->input('price');
    $date = $request->input('date');
    $cid = $request->input('customer_id');

    $baba = new baba();
    $baba->name = '';
    $baba->type = $type;
    $baba->weight = $weight;
    $baba->price = $price;
    $baba->date = $date;
    $baba->customer_id = $cid;
    
    if($baba->save()){

    return Response::json(
        $baba
    , 200);
    }
    else{
        return Response::json(
            ['error' => 'no database']
        , 404);
    }

});


Route::post('/getUserProducts' , function(Request $request) {
    $id = $request->input('id');
    $products = baba::where('customer_id' , '=' , $id)->get();

    return Response::json(
        $products
    , 200);
});


Route::post('/getCustomers' , function(Request $request) {
    
    $customers = customer::all();

    return Response::json(
        $customers
    , 200);
});
Route::post('/getProducts' , function(Request $request) {
    
    $customers = baba::all();

    return Response::json(
        $customers
    , 200);
});

Route::post('/updateProduct' , function(Request $request) {
    
    $baba = baba::where('id' , '=' , $request->input('id'));

    $baba->name = $request->input('name');
    $baba->type = $request->input('type');
    $baba->weight = $request->input('weight');
    $baba->price = $request->input('price');
    $baba->date = $request->input('date');
    $baba->customer_id = $request->input('customer_id');

    if($baba->update()){
    
        return Response::json(
            $baba
        , 200);
    }
    else {
        return Response::json(
            ['error' => 'no database']
        , 404);
    }
});

Route::post('/delete' , function(Request $request){
    $id = $request->input('id');
    $baba = baba::where('id' , '=' , $id)->delete();
    if($baba) {
        return Response::json(
            ['success' => 'product deleted']
        , 200);
    }
    else {
        return Response::json(
            ['error' => 'product not found']
        , 404);
    }
});


Route::post('/searchProducts' , function(Request $request){
    $text = $request->input('text');
    $id = $request->input('id');
    $products = baba::where('type' , 'like' , '%' . $text . '%')->where('customer_id' , '=' , $id)->get();
    
    return Response::json(
        $products
    , 200);
});

Route::post('/searchCustomers' , function(Request $request){
    $text = $request->input('text');
    $products = DB::select('select customer.id , customer.name from customer , baba where customer.id = baba.customer_id and baba.type like %'.$text.'%');
    return Response::json(
        $products
    , 200);
});

