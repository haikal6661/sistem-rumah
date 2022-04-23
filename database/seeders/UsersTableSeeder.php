<?php
namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
            'name' => 'Haikal',
            'email' => 'haikal.ariff13@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('lovemetal6661'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
