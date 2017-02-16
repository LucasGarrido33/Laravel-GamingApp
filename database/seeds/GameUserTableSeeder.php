<?php

use Illuminate\Database\Seeder;

class GameUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = App\User::all();
        $games = App\Game::all();
        $lastGame = count($games) - 1;

        $levels = App\Level::all();
        $lastLevel = count($levels) - 1;

        foreach($users as $user){

            DB::table('game_user')->insert([
                'user_id' => $user->id,
                'game_id' => $games[ rand(0, $lastGame )]->id,
                'level_id' =>$levels[ rand(0, $lastLevel )]->id,
            ]);

        }
    }
}
