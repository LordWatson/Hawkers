<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserRole;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach(range(1,4) as $i){
            $fakeDate = $faker->dateTimeBetween('-1 week', '+1 week');
            $adminUser = User::insert([
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => Hash::make('password'),
                'created_at' => $fakeDate,
                'updated_at' => $fakeDate,
            ]);

            $adminRole = UserRole::insert([
                'user_id' => $adminUser->id,
                'role_id' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ]);
        }
    }
}
