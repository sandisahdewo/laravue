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
            'name' => 'Secret',
            'email' => 'secret@secret.com',
            'password' => bcrypt('secret'),
        ]);
    }
}
