<?php

namespace App\Http\Controllers;

use App\Leed;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LeedsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Leed::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $result = $this->leedValidate($request);
        if ($result) {
            return response()->json($result, 400);
        } else {

            $state = Leed::create($request->all());
            return response()->json($state, 201);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Leed  $leed
     * @return \Illuminate\Http\Response
     */
    public function show(Leed $leed)
    {        
        $leed->load('company');
        $leed->load('leedStatus');
        $leed->load('leedStates');
        $leed->load('city');        
        $leed->city->load('state');
        $leed->city->state->load('country');
        return $leed;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Leed  $leed
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Leed $leed)
    {
        $result = $this->leedValidate($request);
        if ($result) {
            return response()->json($result, 400);
        } else {
            $leed->update($request->all());
            return response()->json($leed, 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Leed  $leed
     * @return \Illuminate\Http\Response
     */
    public function destroy(Leed $leed)
    {
        $leed->delete();
        return response()->json(null, 204);
    }
    private function leedValidate(Request $request)
    {

        /**
         * Nome
         *E-mail 
         *CPF / CNPJ 
         *Empresa 
         *Profissão / Cargo 
         *Telefone 
         *Cidade 
         *Estado 
         *País 
         *Status 
         *Estágio do Funil 
         *Título do Negócio 
         *Valor do Negócio 
         *Conversões 
         *Última Conversão 
         *Domínio 
         *Data de Cadastro 
         *URL
         */
        // dd(date('Y-m-d',strtotime($request->registration_date)));

        $date= $request->registration_date;
        if(strstr($date,'/')){
            $date=Carbon::createFromFormat('d/m/Y H:i', $date)->format('Y-m-d H:i:s');
            $request['registration_date']=$date;
        }


        $validator = Validator::make($request->all(), [
            'code'            => 'required|unique:leeds|numeric',
            'name'              => 'required|max:200',
            'email'             => 'required|email|max:100',
            'cpf'               => 'required',                      //'required|min:11|max:14',
            'job'               => 'required|max:100',
            'phone'             => 'required|max:100',
            'title'             => 'string|max:100',
            'value'             => 'string|max:200',
            'conversions'       => 'required|numeric|max:11',
            'last_conversions'  => 'string',
            'domain'            => 'string',
            'registration_date' => 'required|date',
            'url'               => 'required',                      //'required|url',
            'company_id'        => 'required|numeric',
            'city_id'           => 'required|numeric',
            'leed_status_id'    => 'required|numeric',
            'leed_states_id'    => 'required|numeric',
        ], [
            'required' => 'O campo :attribute é obrigatório',
            'unique' => 'Esse leed ja existe',
            'max' => 'O campo :attribute esta acima do tamanho esperado',
            'min' => 'O campo :attribute esta abaixo do tamanho esperado',
            'numeric' => 'O campo :attribute deve ser um numero valido',
            'email' => 'O campo :attribute deve ser um email valido',
            'url' => 'O campo :attribute deve ser uma url valida',
            'string' => 'O campo :attribute deve ser uma string',
            'date_format' => 'O campo :attribute deve ser uma data',
            
        ], [
            'code'                  => 'Codigo externo do leed',
            'name'                  => 'Nome do leed',
            'email'                 => 'Email do leed',
            'cpf'                   => 'CPF OU CNPJ do leed',
            'job'                   => 'Profissão ou Cargo do leed',
            'phone'                 => 'Telefone de contato do leed',
            'title'                 => 'Título do Negócio',
            'value'                 => 'Valor do Negócio',
            'conversions'           => 'Conversões',
            'last_conversions'      => 'Última Conversão',
            'domain'                => 'Domínio',
            'registration_date'     => 'Data de Cadastro',
            'url'                   => 'URL',
            'company_id'            => 'Codigo da empresa no sistema',
            'city_id'               => 'Codigo da cidade no sistema',
            'leed_status_id'        => 'Codigo do status leed no sistema',
            'leed_states_id'        => 'Codigo do estágio do funil no sistema',
        ]);


        if ($validator->fails()) {
            return $validator->errors();
        } else {
            return false;
        }
    }
}
