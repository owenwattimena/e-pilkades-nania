<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = date('Y-m-d h:m:s');
        DB::table('users')
            ->insert([
                "name" => "Owen Wattimena",
                "email" => "wentoxwtt@gmail.com",
                "password" => Hash::make("password"),
                "created_at" => $date,
                "updated_at" => $date
            ]);
        DB::table('users')
            ->insert([
                "name" => "Admin",
                "email" => "admin@gmail.com",
                "password" => Hash::make("password"),
                "created_at" => $date,
                "updated_at" => $date
            ]);
    }
}
