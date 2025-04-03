<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model
{

    // Nome da tabela
    protected $table = 'fornecedores';

    // Atribuição em massa (mass assignment)
    protected $fillable = [
        'tipo_pessoa',
        'cpf_cnpj',
        'razao_social',
        'nome_fantasia',
        'responsavel',
        'email',
        'fone',
        'celular',
        'cep',
        'rua',
        'numero',
        'complemento',
        'bairro',
        'cidade',
        'uf',
    ];

    public static $tipos = [
        1 => 'Pessoa Jurídica',
        2 => 'Pessoa Física'
    ];

    public static function asArray(){
        $data = self::all();
        $array = [];
        foreach($data as $d){
            $array[$d->id] = $d;
        }
        return $array;
    }
}
