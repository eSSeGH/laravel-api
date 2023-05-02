<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Technology;
use Illuminate\Support\Str;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $technologies =['CSS','SASS','HTML','JavaScript','PHP','Vue','React','BootStrap','TailWind','SQL','NOSQL','LARAVEL','Vite','MongoDB'];

        foreach($technologies as $tech_name) {
            $technology = new Technology();

            $technology->name = $tech_name;
            $technology->slug = Str::slug($tech_name);
            $technology->save();

        }
    }
}
