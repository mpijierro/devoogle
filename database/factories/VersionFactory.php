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

$factory->define(\Devoogle\Src\Version\Model\Version::class, function (Faker $faker) {

    return [
        'uuid' => $faker->uuid,
        'user_id' => factory(\Devoogle\Src\User\Model\User::class),
        'resource_id' => factory(\Devoogle\Src\Resource\Model\Resource::class),
        'category_id' => factory(\Devoogle\Src\Category\Model\Category::class),
        'url' => $faker->url,
        'comment' => $faker->sentence(10),
        'created_at' => new DateTime(),
        'updated_at' => new DateTime()
    ];
});

