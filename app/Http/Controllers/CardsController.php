<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Card;

class CardsController extends Controller
{
    public function index() {
        // obtendo todos os registros da tabela cards
        $cards = Card::all();
    
        // verificando se obteve registros para listar
        if ($cards) {
            // retornando resposta JSON com todos os cards encontrados
            return view('cards.index')->with(['cards', $cards]);
        }
    }

    public function delete($id) {
        // encontrando registro pelo id atraves do metodo find
        $card = Card::find($id);

        // efetuando soft delete para não excluir registro efetivamente e sim popular a coluna deleted_at com a data atual, passando apenas a impressao que aquele registro deixou de existir, mas aquele registro ainda está na nossa base de dados
        if($card->delete()){
            return response()->json('Registro exclúido com sucesso!', 200);
        };
    }
}
