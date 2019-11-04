<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class Leads extends Model
{

    /**
     * @var string
     */
    protected $table = 'leads';

    /**
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * @var array
     */
    protected $fillable = ['nome', 'e-mail', 'cpfcnpj', 'empresa', 'profissaocargo', 'telefone', 'cidade', 'estado', 'pais', 'status',
        'estagiodofunil', 'titulodonegocio', 'valordonegocio', 'conversoes', 'ultimaconversao', 'dominio', 'datadecadastro','url', 'created_at', 'updated_at'];

    public function insertLead($leadData)
    {

        try {
                dd($leadData);
            self::save($leadData->all());

        } catch (QueryException $exception) {
            dd($exception);
            Log::error('Erro ao tentar salvar informação de leads');
            return false;

        }

        return true;
    }
}
