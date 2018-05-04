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
        'user_id' => factory(\Devoogle\Src\User\Model\User::class)->create()->id(),
        'resource_id' => factory(\Devoogle\Src\Resource\Model\Resource::class)->create()->id(),
        'category_id' => factory(\Devoogle\Src\Category\Model\Category::class)->create()->id(),
        'url' => $faker->url,
        'comment' => $faker->sentence(10),
        'reviewed' => false,
        'created_at' => new DateTime(),
        'updated_at' => new DateTime()
    ];
});

