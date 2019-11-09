<?php

namespace App\Http\Controllers;

use App\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CountriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Country::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $result = $this->countryValidate($request);
        if ($result) {
            return response()->json($result, 400);
        } else {
            $status = Country::create($request->all());
            return response()->json($status, 201);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function show(Country $country)
    {
        return $country;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Country $country)
    {
        $result = $this->countryValidate($request);
        if ($result) {
            return response()->json($result, 400);
        } else {
            $country->update($request->all());
            return response()->json($country, 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function destroy(Country $country)
    {
        $country->delete();
        return response()->json(null, 204);
    }
    private function countryValidate(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:countries|max:200',
        ], [
            'required' => 'O campo :attribute é obrigatório',
            'unique' => 'Esse pais ja existe',
            'max' => 'O nome do pais deve conter um maximo de 200 caracteres',
        ], [
            'name'      => 'Nome de um pais',
        ]);


        if ($validator->fails()) {
            return $validator->errors();
        } else {
            return false;
        }
    }
}
