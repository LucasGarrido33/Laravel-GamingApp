<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'Lucas Garrido',
            'email' => 'lucasgarrido33@gmail.com',
            'password' => bcrypt('coucou'),
        ]);
        DB::table('profiles')->insert([
            'user_id' => '1',
            'bio' => 'Salut c\'est moi l\'admin !',
        ]);

        factory(App\User::class, 50)->create()->each(function($u) {
            $u->profile()->save(factory(App\Profile::class)->make());
        });

    }
}
