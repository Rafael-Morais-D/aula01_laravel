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
}
