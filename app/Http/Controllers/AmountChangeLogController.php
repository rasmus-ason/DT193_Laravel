<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\AmountChangeLog;

class AmountChangeLogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return full log
        return amountchangelog::all();
    }

  
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validate input values - lägg till vilken användare eventuellt
        $request->validate([
            'article_number' => 'required',
            'old_amount' => 'required',
            'new_amount' => 'required',
            'modified_with' => 'required',
            'product_id' => 'required'
        ]);

        //Store product in db
        return amountchangelog::create($request->all());
    }

    
    

    //Seach for article number in log where all changes in amount is stored
    public function searchArticleNumber($article) {

        $logResult = amountchangelog::where('article_number', 'like', '%' . $article . '%')->orderBy('updated_at', 'desc')->get();

        if(!$logResult -> isEmpty()){
            return $logResult;
        }else {
            return response()->json([
                'Ingen logg finns för sökt artikelnummer'
            ], 404 );
        }

    }

    //Seach for article number in log where all changes in amount is stored
    public function latestLogs() {

        $logResult = amountchangelog::orderBy('updated_at', 'desc')->take(30)->get();

        if(!$logResult -> isEmpty()){
            return $logResult;
        }else {
            return response()->json([
                'Ingen logg finns för sökt artikelnummer'
            ], 404 );
        }

    }

    



    

}
