<?php

namespace App\Http\Controllers;

use App\LeedStates;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        $result = $this->leedStatesValidate($request);
        if ($result) {
            return response()->json($result, 400);
        } else {
            $status = LeedStates::create($request->all());
            return response()->json($status, 201);
        }
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
        $result = $this->leedStatesValidate($request);
        if ($result) {
            return response()->json($result, 400);
        } else {
            $leedstates->update($request->all());
            return response()->json($leedstates, 200);
        }
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
    private function leedStatesValidate(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'state_leed_name' => 'required|unique:leed_states|max:200',
        ], [
            'required' => 'O campo :attribute é obrigatório',
            'unique' => 'Esse estágio ja existe',
            'max' => 'O nome do estágio deve conter um maximo de 200 caracteres',
        ], [
            'name'      => 'Nome do estágio do funil do leed',
        ]);


        if ($validator->fails()) {
            return $validator->errors();
        } else {
            return false;
        }
    }
}
