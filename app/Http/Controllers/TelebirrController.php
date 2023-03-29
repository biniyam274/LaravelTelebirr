<?php

namespace App\Http\Controllers;

use App\Models\Telebirr;
use App\Utils\TelebirrClass;
use Illuminate\Http\Request;

class TelebirrController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         return view('telebirr');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Telebirr $telebirr)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Telebirr $telebirr)
    {
        //
    }

        /**
     * Show the form for editing the specified resource.
     */
    public function getJson(Request $request)
    {
        $telebirr = new TelebirrClass($request->get('timeout'),$request->get('receiveName'),$request->get('amount'),$request->get('subject'));
        return  response()->json( [
            'appid' =>  env('TELEBIRR_APP_ID'),
            'sign' => $telebirr->getSign(),
            'ussd' =>  $telebirr->encryptRSA()
        ]) ;
    }

    public function requestTele(Request $request)
    {
        $telebirr = new TelebirrClass($request->get('timeout'),$request->get('receiveName'),$request->get('amount'),$request->get('subject'));
        return  response()->json( [
            'url' =>  $telebirr->getPyamentUrl()
        ]) ;
    }

    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Telebirr $telebirr)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Telebirr $telebirr)
    {
        //
    }
}
