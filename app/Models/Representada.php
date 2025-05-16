<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Representada extends Model
{
    // Nome da tabela
    protected $table = 'representadas';

    // Atribuição em massa (mass assignment)
    protected $fillable = [
        'tipo_pessoa',
        'cpf_cnpj',
        'inscricao_estadual',
        'razao_social',
        'nome_fantasia',
        'responsavel',
        'email',
        'email_2',
        'email_3',
        'email_4',
        'email_nfe',
        'fone',
        'fone_2',
        'fone_3',
        'celular',
        'celular_2',
        'celular_3',
        'cep',
        'rua',
        'numero',
        'complemento',
        'bairro',
        'cidade',
        'uf',
        'observacoes',
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
