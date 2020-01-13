<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $table = 'leads';

    protected $fillable = [
        'codigo',
        'nome',
        'email',
        'cpf_cnpj',
        'empresa',
        'profissao_cargo',
        'telefone',
        'cidade',
        'estado',
        'pais',
        'status',
        'estagio_funil',
        'titulo_negocio',
        'valor_negocio',
        'conversoes',
        'ultima_conversao',
        'dominio',
        'data_cadastro',
        'url'
    ];

    protected $dates = [
        'data_cadastro', 'created_at', 'updated_at'
    ];

    public function setDataCadastroAttribute($value)
    {
        $this->attributes['data_cadastro'] = Carbon::createFromFormat('d/m/Y H:i', $value)
            ->format('Y-m-d H:i');
    }
}
