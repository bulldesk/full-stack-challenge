<?php

namespace App\Http\Controllers;

use App\LeedStatus;
use Illuminate\Http\Request;
use App\Http\Requests\LeedStatusRequest;

class LeedStatusesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return LeedStatus::all();
        
    }
 

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LeedStatusRequest $request)
    {        
            
        $status = LeedStatus::create($request->all());
        return response()->json($status, 201);;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LeedStatus  $leedStatus
     * @return \Illuminate\Http\Response
     */
    public function show(LeedStatus $leedstatus)
    {
        return $leedstatus;
    }
 

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LeedStatus  $leedStatus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LeedStatus $leedstatus)
    {
        $leedstatus->update($request->all());

        return response()->json($leedstatus, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LeedStatus  $leedStatus
     * @return \Illuminate\Http\Response
     */
    public function destroy(LeedStatus $leedstatus)
    {
        $leedstatus->delete();

        return response()->json(null, 204);
    }
}
