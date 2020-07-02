<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Card;

class CardsController extends Controller
{
    public function index() {
        // obtendo todos os registros da tabela cards
        $cards = [
            "Card 1", "Card 2", "Card 3", "Card 4", 
            "Card 5", "Card 6", "Card 7", "Card 8" 
        ];
    
        if ($cards) {
            return view('welcome')->with(['cards' => $cards]);
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
