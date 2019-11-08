<?php

namespace App\Http\Controllers;

use App\LeedStates;
use Illuminate\Http\Request;

class LeedStatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return LeedStates::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $status = LeedStates::create($request->all());
        return response()->json($status, 201);;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LeedStates  $leedStates
     * @return \Illuminate\Http\Response
     */
    public function show(LeedStates $leedstates)
    {
        return $leedstates;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LeedStates  $leedstates
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LeedStates $leedstates)
    {
        $leedstates->update($request->all());
        return response()->json($leedstates, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LeedStates  $leedstates
     * @return \Illuminate\Http\Response
     */
    public function destroy(LeedStates $leedstates)
    {
        $leedstates->delete();
        return response()->json(null, 204);
    }
}
