<?php

use App\Models\Post;
use App\Models\Photo;
use Faker\Generator as Faker;

$factory->define(Photo::class, function (Faker $faker) {
    return [
        'post_id' => Post::all()->random()->id,
        'full_path' => $faker->imageUrl(),
    ];
});
