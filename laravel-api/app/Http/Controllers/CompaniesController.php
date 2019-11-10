<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Company::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $result = $this->companyValidate($request);
        if ($result) {
            return response()->json($result, 400);
        } else {            
            $status = Company::create($request->all());
            return response()->json($status, 201);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        return $company;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        $result = $this->companyValidate($request);
        if ($result) {
            return response()->json($result, 400);
        } else {
            $company->update($request->all());
            return response()->json($company, 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $company->delete();
        return response()->json(null, 204);
    }

    private function companyValidate(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'company_name' => 'required|unique:companies|max:200',
        ], [
            'required' => 'O campo :attribute é obrigatório',
            'unique' => 'Essa empresa ja existe',
            'max' => 'O nome da empresa deve conter um maximo de 200 caracteres',
        ], [
            'name'      => 'Nome da empresa',
        ]);


        if ($validator->fails()) {
            return $validator->errors();
        } else {
            return false;
        }
    }
}
