<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(\Devoogle\Src\Category\Model\Category::class, function (Faker $faker) {

    return [
        'name' => 'Categoría',
        'slug' => 'categoria',
        'description' => 'Categoría de prueba',
        'created_at' => new DateTime(),
        'updated_at' => new DateTime()
    ];
});
