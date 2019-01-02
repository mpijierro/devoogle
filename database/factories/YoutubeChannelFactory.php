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

$factory->define(\Devoogle\Src\SourceReader\Model\YoutubeChannel::class, function (Faker $faker) {

    $name = $faker->sentence(4);


    return [
        'source_id' => factory(\Devoogle\Src\Source\Model\Source::class)->create(),
        'slug_id' => str_random(),
        'slug_name' => str_slug($name),
        'name' => $name,
        'is_user_channel' => 0,
        'last_time_processed' => \Carbon\Carbon::now(),
        'created_at' => \Carbon\Carbon::now(),
        'updated_at' => \Carbon\Carbon::now(),
    ];
});
