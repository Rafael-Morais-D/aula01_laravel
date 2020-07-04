<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Card;

class CardsController extends Controller
{
    public function index() {
        // obtendo todos os registros da tabela cards
        $cards = Card::all();

        // obtendo apenas registros com id menor ou igual a 50
        // sempre que for utilizar metodos diferente do all() e paginate(), lembre-se de utilizar o metodo get() no final da sua query
        // $cards = Card::where('id', '<=', '50')->get();
        
        // obtendo todos os registros e aplicando paginacao para exibir apenas 10 registros por pagina
        $cards = Card::paginate(10);
    
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

        // aplicando validacao nos campos com o validate do laravel
        $request->validate([
            'title' => 'required|min:5',
            'content' => 'required|min:20'
        ]);

        // obtendo objeto imagem
        $image = $request->file('image');

        // verificando se o usuario nao enviou imagem
        if(empty($image)) {
            $pathRelative = null;
        } else {
            //
            $image->storePublicly('uploads');
            
            // criando caminho ate a pasta uploads
            $absolutePath = public_path()."/storage/uploads";
            
            // obtendo o nome do arquivo
            $name = $image->getClientOriginalName();

            // mover a imagem para o projeto
            $image->move($absolutePath, $name);

            // obtendo caminho relativo para passar ao banco de dados
            $pathRelative = "storage/uploads/$name";
        };

        // instanciando objeto card
        $card = new Card;

        // atribuindo valores recebidos no corpo da requisicao as respectivas colunas
        $card->title = $request->title;
        $card->image = $pathRelative;
        $card->content = $request->content;

        // efetuando o insert do registro na base de dados
        $card->save();

        // verificando se obteve registros para listar
        if ($card) {
            // retornando resposta de que card foi criado
            return view('cards.create')->with('success', 'Cartão inserido com sucesso');
        }
    }

    public function edit($id) {
        $card = Card::find($id);

        if ($card) {
            return view('cards.edit')->with('card', $card);
        }
    }

    public function update(Request $request, $id) {
        
        // aplicando validacao nos campos com o validate do laravel
        $request->validate([
            'title' => 'required|min:5',
            'content' => 'required|min:20'
        ]);

        // obtendo objeto imagem
        $image = $request->file('image');

        // encontrando registro pelo id atraves do metodo find
        $card = Card::find($id);

        // verificando se o usuario nao enviou imagem
        if(empty($image)) {
            $pathRelative = $card->image;
        } else {
            //
            $image->storePublicly('uploads');
            
            // criando caminho ate a pasta uploads
            $absolutePath = public_path()."/storage/uploads";
            
            // obtendo o nome do arquivo
            $name = $image->getClientOriginalName();

            // mover a imagem para o projeto
            $image->move($absolutePath, $name);

            // obtendo caminho relativo para passar ao banco de dados
            $pathRelative = "storage/uploads/$name";
        };
        
        // atribuindo valores recebidos no corpo da requisicao as respectivas colunas
        $card->title = $request->title;
        $card->image = $pathRelative;
        $card->content = $request->content;

        $card->update();

        // verificando se obteve registros para listar
        if ($card) {
            // retornando resposta JSON com card alterado
            return view('cards.edit')->with([
                'card' => $card,
                'success' => 'Cartão alterado com sucesso'
            ]);
        }
    }

    public function delete($id) {
        // encontrando registro pelo id atraves do metodo find
        $card = Card::find($id);

        // efetuando soft delete para não excluir registro efetivamente e sim popular a coluna deleted_at com a data atual, passando apenas a impressao que aquele registro deixou de existir, mas aquele registro ainda está na nossa base de dados
        if($card->delete()){
            // após excluir o registro precisamos retornar para a listagem de cartoes em index.blade.php, porem teremos que obter todos os registros da tabela cards para que nao tenhamos erros ao renderizar a view index, afinal de contas ela percorre um array $cards para montar a listagem de cards dentro de uma table

            // obtendo todos cards
            $cards = Card::all();

            return view('cards.index')->with([
                'cards' => $cards,
                'success' => 'Registro excluído com sucesso'
            ]);
        };
    }

    public function search(Request $request) {
        
        $search = $request->input('search');
        
        $cards = Card::where('title', 'like', '%' . $search . '%')->orWhere('content', 'like', '%' . $search . '%')->paginate(10);

        return view('cards.index')->with([
            'search' => $search,
            'cards' => $cards
        ]);
    }
}