<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//add
use App\Models\ProductCategories;
use App\Models\Products;

class ProductCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return productcategories::all();  
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
            'category_name' => 'required',
            'category_description' => '' 
        ]);

        //Store product in db
        return productcategories::create($request->all());
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
        $category = productcategories::find($id);

        //Check if id exist, return product info if true, else return response message with 404-code
        if($category != null) {
            return $category;
        }else {
            return response()->json([
                'Kategori finns inte'
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
        $category = productcategories::find($id);

        //Check if id exist, update product info if true, else return response message with 404-code
        if($category != null) {
            $category->update($request->all());
            return $category;
        }else {
            return response()->json([
                'Kategori finns inte'
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
        $category = productcategories::find($id);

        //Check if id exist, update product info if true, else return response message with 404-code
        if($category != null) {
            $category->delete();
            return response()->json([
                'Kategorin borttagen'
            ]);
        }else {
            return response()->json([
                'Kategori med id finns inte'
            ], 404);
        }
    }

    //Seach for category name
    public function getCategoryName($categoryname) {

        $Result = products::where('product_category', $categoryname)->get();
        
        if(!$Result -> isEmpty()){
            return $Result;
        }else {
            return response()->json([
                'Category does not exist'
            ], 404 );
        }
    
    }

    //Change category on the product
    public function updateCategoryOnProduct(Request $request, $categoryname) {

        $result = products::where('product_category', $categoryname)->update($request->all());
        
    }

    //Seach for category name
    public function searchCategoryName($categoryname) {

        $Result = productcategories::where('category_name', $categoryname)->get();
        
        if(!$Result -> isEmpty()){
            return $Result;
        }else {
            return response()->json([
                'Category does not exist'
            ], 404 );
        }
    
    }

   

     
}
