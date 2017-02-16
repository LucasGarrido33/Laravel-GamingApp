<?php

use Illuminate\Database\Seeder;

class GamesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('games')->insert([
            [
                'name' => 'League of Legend',
            ],
            [
                'name' => 'Counter Strike',
            ],
            [
                'name' => 'Dota 2',
            ],
            [
                'name' => 'World of Warcraft',
            ],
            [
                'name' => 'OverWatch',
            ],
            [
                'name' => 'Hearthstone',
            ]
        ]);    }


}
