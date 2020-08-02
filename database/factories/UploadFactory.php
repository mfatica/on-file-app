<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Upload;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

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

$factory->define(Upload::class, function (Faker $faker) {
    return [
        'uuid' => $faker->uuid,
        'key' => $faker->lexify('/tmp/????-????-????'),
        'bucket' => 'factory',
        'name' => $faker->lexify('????????.pdf'),
        'content_type' => 'application/test-data',
        'user_id' => factory(App\User::class)->create()->id
    ];
});
