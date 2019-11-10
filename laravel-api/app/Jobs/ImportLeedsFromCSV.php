<?php

namespace App\Jobs;

use App\City;
use App\Company;
use App\Country;
use App\Leed;
use App\LeedStates;
use App\LeedStatus;
use App\State;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class ImportLeedsFromCSV implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $path;

    //    "#"
    //    "Nome"
    //    "E-mail"
    //    "CPF / CNPJ"
    //    "Empresa"
    //    "Profissão / Cargo"
    //    "Telefone"
    //    "Cidade"
    //    "Estado"
    //    "País"
    //     "Status"
    //     "Estágio do Funil"
    //     "Título do Negócio"
    //     "Valor do Negócio"
    //     "Conversões"
    //     "Última Conversão"
    //     "Domínio"
    //     "Data de Cadastro"
    //     "URL"


    private $conversion = [
        '#'                 => 'code',
        'Nome'              => 'name',
        'E-mail'            => 'email',
        'CPF / CNPJ'        => 'cpf',
        'Empresa'           => 'company_name',
        'Profissão / Cargo' => 'job',
        'Telefone'          => 'phone',
        'Cidade'            => 'city_name',
        'Estado'            => 'state_name',
        'País'              => 'country_name',
        'Status'            => 'status_leed_name',
        'Estágio do Funil'  => 'state_leed_name',
        'Título do Negócio' => 'title',
        'Valor do Negócio'  => 'value',
        'Conversões'        => 'conversions',
        'Última Conversão'  => 'last_conversion',
        'Domínio'           => 'domain',
        'Data de Cadastro'  => 'registration_date',
        'URL'               => 'url',
        'code'              => 'code',
        'name'              => 'name',
        'email'             => 'email',
        'cpf'               => 'cpf',
        'company_name'      => 'company_name',
        'job'               => 'job',
        'phone'             => 'phone',
        'city_name'         => 'city_name',
        'state_name'        => 'state_name',
        'country_name'      => 'country_name',
        'status_leed_name'  => 'status_leed_name',
        'state_leed_name'   => 'state_leed_name',
        'title'             => 'title',
        'value'             => 'value',
        'conversions'       => 'conversions',
        'last_conversion'   => 'last_conversion',
        'domain'            => 'domain',
        'registration_date' => 'registration_date',
        'url'               => 'url'
    ];
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($filePath)
    {
        $this->path = $filePath;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()

    {
        if (!Storage::disk('local')->exists($this->path))
            throw new Exception(sprintf(
                'Não foi possivel acessar o arquivo',
                $this->path
            ));

        $fileData = Storage::get($this->path);


        $csvData = str_getcsv($fileData, "\n");

        $header = str_getcsv($csvData[0], ";");
        array_shift($csvData);

        $newField = array();

        foreach ($csvData as $row) {

            $fields = str_getcsv($row, ";");

            foreach ($fields as $key => &$field) {
                if ($this->conversion[$header[$key]] == 'registration_date') {

                    $date = $field;
                    if (strstr($date, '/')) {
                        $date = Carbon::createFromFormat('d/m/Y H:i', $date)->format('Y-m-d H:i:s');
                        $field = $date;
                    }

                }

                if ($this->conversion[$header[$key]] == 'value' && ($field!="" && $field!=" ")) {

                    if(substr_count($field,',') && (strlen($field)-strrpos($field,','))==3){
                        $field=str_replace('.','',$field);
                        $field=str_replace(',','.',$field);
            
                    }else{
                        $field=str_replace(',','',$field);
                    }
                    $field=number_format($field, 2, '.','');  
                }
                if($field!="" && $field!=" "){
                    $newField[$this->conversion[$header[$key]]] = $field;
                }
            }

            if(Leed::where('code', $newField['code'])->count()===0){
                $company = Company::firstOrCreate(['company_name' => $newField['company_name']]);
                $newField['company_id'] = $company->id;
    
                $leed_status = LeedStatus::firstOrCreate(['status_leed_name' => $newField['status_leed_name']]);
                $newField['leed_status_id'] = $leed_status->id;
    
                $leed_state = LeedStates::firstOrCreate(['state_leed_name' => $newField['state_leed_name']]);
                $newField['leed_states_id'] = $leed_state->id;
    
                $country = Country::firstOrCreate(['country_name' => $newField['country_name']]);
                $newField['country_id'] = $country->id;
    
                $state = State::firstOrCreate(['state_name' => $newField['state_name'], 'country_id' => $newField['country_id']]);
                $newField['state_id'] = $state->id;
    
                $city = City::firstOrCreate(['city_name' => $newField['city_name'], 'state_id' => $newField['state_id']]);
                $newField['city_id'] = $city->id;
    
                $leed = Leed::create($newField);
            }
        }
    }
}
