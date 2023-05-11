<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Faker\Generator as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $user = User::create([
            'name' => 'Stefano Virgadaula',
            'email' => 'ste.virgadaula@gmail.com',
            'password' => Hash::make('8codkilla8'),
        ]);

        for ($i=0; $i <20; $i++) {

            User::create([
                'name' => $faker->name(),
                'email' => $faker->unique()->email(),
                'password' => Hash::make($faker->word())
            ]);
        }
    }
}
