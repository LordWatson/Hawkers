<?php

namespace Database\Seeders;

use App\Models\Post;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach(range(1,50) as $i){
            Post::insert([
                'user_id' => rand(1,20),
                'body' => $faker->text(100),
                'created_at' => $faker->dateTimeBetween('-1 week', '+1 week'),
            ]);
        }
    }
}
