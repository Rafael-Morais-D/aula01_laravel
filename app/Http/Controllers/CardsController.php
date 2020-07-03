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
            return view('cards.index')->with('cards', $cards);
        }
    }

    public function add() {
        return view('cards.create');
    }

    public function create(Request $request) {

        $request->validate([
            'title' => 'required|min:5',
            'content' => 'required|min:20'
        ]);

        // instanciando objeto card
        $card = new Card;

        // atribuindo valores recebidos no corpo da requisicao as respectivas colunas
        $card->title = $request->title;
        $card->content = $request->content;

        // efetuando o insert do registro na base de dados
        $card->save();

        // verificando se obteve registros para listar
        if ($card) {
            // retornando resposta JSON com card criado
            return view('cards.create')->with('success', 'Cartão inserido com sucesso');
        }
    }

    public function edit(Request $request, $id) {
        // encontrando registro pelo id atraves do metodo find
        $card = Card::find($id);

        // atribuindo valores recebidos no corpo da requisicao as respectivas colunas
        $card->title = $request->title;
        $card->content = $request->content;

        $card->update();

        // verificando se obteve registros para listar
        if ($card) {
            // retornando resposta JSON com card alterado
            return response()->json($card, 200);
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