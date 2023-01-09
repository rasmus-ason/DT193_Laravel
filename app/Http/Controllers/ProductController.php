<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//add
use App\Models\Products;
use App\Models\AmountChangeLog;
use App\Models\ReportMessage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return products::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validate input values
        $request->validate([
            'article_number' => 'required',
            'product_name' => 'required',
            'product_description' => 'required',
            'product_category' => 'required',
            'amount_in_stock' => 'required',
            'status' => 'required'
        ]);

        //Store product in db
        return products::create($request->all());
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Display unique product
        $product = products::find($id);

        //Check if id exist, return product info if true, else return response message with 404-code
        if($product != null) {
            return $product;
        }else {
            return response()->json([
                'Product with selected id do not exist'
            ], 404);
        }
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
        //Find unique product
        $product = products::find($id);

        //Check if id exist, update product info if true, else return response message with 404-code
        if($product != null) {
            $product->update($request->all());
            return $product;
        }else {
            return response()->json([
                'Product with selected id do not exist'
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Find unique product
        $product = products::find($id);
        $log = amountchangelog::where('product_id', $id)->delete();
        $report = reportmessage::where('product_id', $id)->delete();


        //Check if id exist, update product info if true, else return response message with 404-code
        if($product != null) {
            $product->delete();
            return response()->json([
                'Product and log is deleted!'
            ]);
        }else {
            return response()->json([
                'Product with selected id do not exist'
            ], 404);
        }
    }

    //Seach for article number in log where all changes in amount is stored
    public function searchArticleNumber($article) {

        $Result = products::where('article_number', 'like', '%' .  $article . '%')->get();
        
        if(!$Result -> isEmpty()){
            return $Result;
        }else {
            return response()->json([
                'Article number does not exist'
            ], 404 );
        }

    }

    //Seach for article number in log where all changes in amount is stored
    public function searchProductName($productname) {

        $Result = products::where('product_name', 'like', '%' . $productname . '%')->get();
        
        if(!$Result -> isEmpty()){
            return $Result;
        }else {
            return response()->json([
                'Product name does not exist'
            ], 404 );
        }
    
    }

    //Seach for article number in log where all changes in amount is stored
    public function searchProductCategory($productcategory) {

        $Result = products::where('product_category', $productcategory)->get();
        
        if(!$Result -> isEmpty()){
            return $Result;
        }else {
            return response()->json([
                'Product category does not exist'
            ], 404 );
        }
    }

   

    //Seach for category name
    public function searchCategoryName($categoryname) {

        $Result = products::where('product_category', $categoryname)->get();
        
        if(!$Result -> isEmpty()){
            return $Result;
        }else {
            return response()->json([
                'Category does not exist'
            ], 404 );
        }
    
    }

    //Seach for category name
    public function searchStatus($status) {

        $Result = products::where('status', $status)->get();
        
        if(!$Result -> isEmpty()){
            return $Result;
        }else {
            return response()->json([
                'No products in selected status'
            ], 404 );
        }
    
    }

    //Seach for article number in log where all changes in amount is stored
    public function addToLog(request $request, $id) {

        $post = products::find($id);

        // $log = new AmountChangeLog();
        // $log->log = $request->log;

        // $post->create()->save($log);

        // return response()->json([
        //     'Log added'
        // ], 200);
        

    }

}
