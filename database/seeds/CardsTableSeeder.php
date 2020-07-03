<?php

use Illuminate\Database\Seeder;
use App\Card;

class CardsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Card::create([
            'title' => 'Card Number X',
            'content' => 'Content referring to card number X'
        ]);
        
        factory(Card::class, 48)->create();
    }
}
