<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category')->insert([
            'name' => 'Vídeo',
            'slug' => 'video',
            'description' => 'Vídeos sobre programación y desarrollo de software.',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);

        DB::table('category')->insert([
            'name' => 'Audio',
            'slug' => 'audio',
            'description' => 'Audios, podcasts y charlas sobre programación y desarrollo de software.',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);

        DB::table('category')->insert([
            'name' => 'Web',
            'slug' => 'web',
            'description' => 'Enlaces a páginas web de programación y desarrollo de software.',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);

        DB::table('category')->insert([
            'name' => 'Diapositiva',
            'slug' => 'diapositivas',
            'description' => 'Diapositivas, presentaciones sobre programación y desarrollo de software.',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);

        DB::table('category')->insert([
            'name' => 'Documento',
            'slug' => 'documento-texto',
            'description' => 'Documentos y archivos sobre programación y desarrollo de software.',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);

    }
}
