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

$factory->define(\Devoogle\Src\Resource\Model\Resource::class, function (Faker $faker) {

    return [
        'user_id' => factory(\Devoogle\Src\User\Model\User::class)->create()->id,
        'uuid' => $faker->uuid,
        'title' => $name = $faker->sentence(3),
        'description' => $faker->text(),
        'url' => $faker->url,
        'slug' => $faker->word . '-' . $faker->word,
        'created_at' => new DateTime(),
        'updated_at' => new DateTime()
    ];
});