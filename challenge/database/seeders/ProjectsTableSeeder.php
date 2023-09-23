<?php

namespace Database\Seeders;
use App\Models\Project;
use Faker\Factory as Faker;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for($i = 0; $i < 9; $i++){
            $title = $faker->sentence;
            $subtitle = $faker->sentence;
            $description = $faker->paragraph;
            $image = $faker->imageUrl(640, 480);
            $link = $faker->url;

            Project::create([
                'title' => $title,
                'subtitle' => $subtitle,
                'description' => $description,
                'image' => $image,
                'link' => $link,
            ]);
        }
    }
}
