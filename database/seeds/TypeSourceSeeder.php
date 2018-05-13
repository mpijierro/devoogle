<?php

use Illuminate\Database\Seeder;

class TypeSourceSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('type_source')->insert([
            'name'       => 'Api',
            'slug'       => 'api',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);

        DB::table('type_source')->insert([
            'name'       => 'Rss',
            'slug'       => 'rss',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);

    }
}
