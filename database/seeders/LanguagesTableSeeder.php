<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LanguagesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::table('languages')->insert(array (
            0 => 
            array (
                'id'            => 1,
                'uid'           => Str::uuid()->toString(),
                'language_code' => 'en',
                'country_code'  => 'us',
                'name'          => 'English',
                'is_active'     => 1,
                'force_rtl'     => 0,
                'created_at'    => '2022-09-01 19:58:48',
            ),
        )); 
    }
}