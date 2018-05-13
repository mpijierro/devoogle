<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(LangSeeder::class);
        $this->call(TypeSourceSeeder::class);
        $this->call(SourceSeeder::class);
        $this->call(YoutubeChannelSeeder::class);
    }
}
