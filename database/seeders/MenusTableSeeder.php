<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class MenusTableSeeder extends Seeder
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
                'label' => 'Home',
                'link' => '/',
                'created_at' => date('Y-m-d'),
                'updated_at' => date('Y-m-d'),
            ),
        );

        DB::table('menus')->insert($data);
    }
}
