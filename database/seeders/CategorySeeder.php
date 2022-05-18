<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Faker\Factory as Faker;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cs = Category::factory(2)->create();
        foreach($cs as $c) {
            $cs2 = Category::factory(2)->create();
            foreach($cs2 as $c2) {
                $c->appendNode($c2);
                $cs3 = Category::factory(2)->create();
                foreach($cs3 as $c3) {
                    $c2->appendNode($c3);
                }
            }
        }
        $categories = Category::get();
        $faker = Faker::create();
        foreach($categories as $category) {
            $tw = mt_rand(300, 500);
            $th = mt_rand(300, 500);
            $imageUrl = $faker->imageUrl($tw,$th, null, false);
            $category->addMediaFromUrl($imageUrl)->toMediaCollection('thumbnail');

            for($i=1;$i<=5;$i++) {
                $gw = mt_rand(1024, 1920);
                $gh = mt_rand(1024, 1920);
                $gImageUrl = $faker->imageUrl($gw,$gh, null, false);
                $category->addMediaFromUrl($gImageUrl)->toMediaCollection('gallery');
            }
        }
    }
}
