<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Models\Project;
use Illuminate\Support\Str;
use App\Models\Type;
use App\Models\Technology;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        // recuperiamo la collection dei tipi e trasformiamola in un collection dei soli id dei types
        $type_ids = Type::all()->pluck('id')->all();
        $technology_ids = Technology::all()->pluck('id')->all();

        for ($i=0; $i < 50; $i++) {

            $project = new Project();
            $project->title = $faker->unique->sentence( $faker->numberBetween(3,6) );
            $project->description = $faker->optional()->text( $faker->numberBetween(20,50) );
            $project->client_name = $faker->randomElement(['Sig. Rossi','Sig. Verdi', 'Sig. Bianchi', 'Sig. Gialli', 'Sig. Negri']);
            $project->client_tel = $faker->numberBetween(3331111111,3399999999);
            $project->slug = Str::slug($project->title, '-');
            $project->type_id = $faker->optional()->randomElement($type_ids);

            $project->save();

            // peschiamo ualche technologies in maniera random e assegniamola ad un project creato di volta in volta
            // attach scrive le righe della tabella ponte, gli servono gli id di entrambe le tabelle e per uesto va dopo il save
            $project->technologies()->attach($faker->randomElements($technology_ids, rand(0,5)));
        }
    }
}
