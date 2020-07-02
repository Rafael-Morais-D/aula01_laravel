<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Card extends Model
{
    use SoftDeletes;

    // indicando qual tabela do banco de dados o model Card ira representar
    protected $table = 'cards';
    // indicando quais colunas da tabela cards queremos trabalhar, seja, para inserir ou alterar registros.
    protected $fillable = [
        'title', 'content'
    ];
}
