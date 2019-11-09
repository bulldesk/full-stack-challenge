<?php

namespace App\Http\Controllers;

use App\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return City::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $result = $this->cityValidate($request);
        if ($result) {            
            return response()->json($result, 400);
        } else {
            
            $state = City::create($request->all());
            return response()->json($state, 201);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        $city->load('state');
        $city->state->load('country');
        return $city;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, City $city)
    {
        $result = $this->cityValidate($request);
        if ($result) {
            return response()->json($result, 400);
        } else {
            $city->update($request->all());
            return response()->json($city, 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        $city->delete();
        return response()->json(null, 204);
    }
    private function cityValidate(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => ['required','max:200', 
                Rule::unique('cities')->where('state_id',$request->state_id)
            ],
            'state_id' => 'required|numeric'
        ], [
            'required' => 'O campo :attribute é obrigatório',
            'max' => 'O nome da cidade deve conter um maximo de 200 caracteres',
            'numeric' => 'O campo :attribute deve ser um numero',
            'unique' => 'Essa cidade ja existe'
        ], [
            'name'      => 'Nome de uma cidade',
            'state_id'=> 'Codigo identificador de estado no sistema'
        ]);


        if ($validator->fails()) {
            return $validator->errors();
        } else {
            return false;
        }
    }
}
