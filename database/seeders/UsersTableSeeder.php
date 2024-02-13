<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;
use Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            array(
                'level' => 1,
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => bcrypt('admin@admin.com'),
                'remember_token' => Str::random(60),
                'created_at' => date('Y-m-d'),
                'updated_at' => date('Y-m-d'),
            ),
        );

        DB::table('users')->insert($data);
    }
}
