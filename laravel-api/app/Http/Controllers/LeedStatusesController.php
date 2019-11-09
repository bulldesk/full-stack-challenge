<?php

namespace App\Http\Controllers;

use App\LeedStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
    public function store(Request $request)
    {
        $result = $this->leedStatusValidate($request);
        if ($result) {
            return response()->json($result, 400);
        } else {
            $status = LeedStatus::create($request->all());
            return response()->json($status, 201);
        }
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
        $result = $this->leedStatusValidate($request);
        if ($result) {
            return response()->json($result, 400);
        } else {
            $leedstatus->update($request->all());
            return response()->json($leedstatus, 200);
        }
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

    private function leedStatusValidate(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:leed_statuses|max:200',
        ], [
            'required' => 'O campo :attribute é obrigatório',
            'unique' => 'Esse status ja existe',
            'max' => 'O nome do status deve conter um maximo de 200 caracteres',
        ], [
            'name'      => 'Nome do status do leed',
        ]);


        if ($validator->fails()) {
            return $validator->errors();
        } else {
            return false;
        }
    }
}
