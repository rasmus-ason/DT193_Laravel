<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ReportMessage;

class ReportMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return all messages
        return reportmessage::all();
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
            'message' => 'required',
            'product_id' => 'required'
        ]);

        //Store message in db
        return reportmessage::create($request->all());
    }

    public function destroy($id)
    {
        //Find unique product
        $message = reportmessage::find($id);

        //Check if id exist, update product info if true, else return response message with 404-code
        if($message != null) {
            $message->delete();
            return response()->json([
                'Message is deleted!'
            ]);
        }else {
            return response()->json([
                'Message with selected id do not exist'
            ], 404);
        }
    }

    //Seach for article number in log where all changes in amount is stored
    public function searchArticleNumber($article) {

        $result = reportmessage::where('article_number', 'like', '%' . $article . '%')->get();

        if(!$result -> isEmpty()) {
            return $result;
        }else {
            //Koden går ej in i detta block
            return response()->json([
                'No reports regarding specified article number'
            ], 404);
        }
    }

}
