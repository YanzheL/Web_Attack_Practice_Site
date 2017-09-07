<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        for ($i = 0; $i < 100; $i++) {
            \App\User::create([
                'name' => 'username_test' . $i,
                'email' => 'test' . $i . '@' . 'test.test',
                'password' => hash('sha256', 'testpassword' . $i),
//                 'password' => bcrypt('testpassword'.$i),
            ]);
        }
    }
}
