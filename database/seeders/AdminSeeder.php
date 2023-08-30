<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            [
                'first_name'=>'Gazi',
                'last_name'=>'mia',
                'phone'=>'01518366273',
                'password'=> Hash::make('9999'),
                'type'=>'super'

          ],

          [




        ],


        ]);
    }
}
