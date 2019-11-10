<?php

namespace App\Http\Controllers;

use App\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class StatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return State::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $result = $this->stateValidate($request);
        if ($result) {            
            return response()->json($result, 400);
        } else {
            
            $state = State::create($request->all());
            return response()->json($state, 201);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\State  $state
     * @return \Illuminate\Http\Response
     */
    public function show(State $state)
    {
        return $state->load('country');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\State  $state
     * @return \Illuminate\Http\Response
     * 
     */
    public function update(Request $request, State $state)
    {
        $result = $this->stateValidate($request);
        if ($result) {
            return response()->json($result, 400);
        } else {
            $state->update($request->all());
            return response()->json($state, 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\State  $state
     * @return \Illuminate\Http\Response
     */
    public function destroy(State $state)
    {
        $state->delete();
        return response()->json(null, 204);
    }
    private function stateValidate(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'stare_name' => ['required','max:200', 
                Rule::unique('states')->where('country_id',$request->country_id)
            ],
            'country_id' => 'required|numeric'
        ], [
            'required' => 'O campo :attribute é obrigatório',
            'max' => 'O nome do estado deve conter um maximo de 200 caracteres',
            'numeric' => 'O campo :attribute deve ser um numero',
            'unique' => 'Esse estado ja existe'
        ], [
            'name'      => 'Nome de um estado',
            'country_id'=> 'Codigo identificador de pais no sistema'
        ]);


        if ($validator->fails()) {
            return $validator->errors();
        } else {
            return false;
        }
    }
}
