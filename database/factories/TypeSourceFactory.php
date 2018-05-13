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

$factory->define(\Devoogle\Src\Source\Model\TypeSource::class, function (Faker $faker) {

    $name = $faker->word();

    return [
        'name'       => $name,
        'slug'       => str_slug($name),
        'created_at' => new DateTime(),
        'updated_at' => new DateTime()
    ];
});

