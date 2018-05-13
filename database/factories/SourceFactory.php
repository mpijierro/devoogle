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

$factory->define(\Devoogle\Src\Source\Model\Source::class, function (Faker $faker) {

    $name = $faker->word();

    return [
        'type_source_id'      => factory(\Devoogle\Src\Source\Model\TypeSource::class)->create()->id,
        'name'                => $name,
        'slug'                => str_slug($name),
        'last_time_processed' => null,
        'created_at'          => new DateTime(),
        'updated_at'          => new DateTime()
    ];
});

