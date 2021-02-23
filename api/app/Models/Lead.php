<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;

    protected $table = 'leads';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'lead',
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
        'estagio_do_funil',
        'titulo_do_negocio',
        'valor_do_negocio',
        'conversoes',
        'ultima_conversao',
        'dominio',
        'data_de_cadastro',
        'url'
    ];
}
