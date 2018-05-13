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

        'user_id'      => factory(\Devoogle\Src\User\Model\User::class)->create()->id,
        'source_id'    => factory(\Devoogle\Src\Source\Model\Source::class)->create()->id,
        'category_id'  => factory(\Devoogle\Src\Category\Model\Category::class)->create()->id,
        'lang_id'      => factory(\Devoogle\Src\Lang\Model\Lang::class)->create()->id,
        'uuid'         => $faker->uuid,
        'title'        => $name = $faker->sentence(3),
        'description'  => $faker->text(),
        'published_at' => \Carbon\Carbon::now(),
        'url'          => $faker->url,
        'slug'         => $faker->word . '-' . $faker->word,
        'created_at'   => new DateTime(),
        'updated_at'   => new DateTime()
    ];
});
