<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Meal;
use App\Models\Tag;
use App\Models\Ingredient;

/**
 * Seeds the Meal - Tag & Meal - Ingredient pivot tables.
 */
class RecipesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         
        //seed Meal-Tag
        $tags = Tag::all();
        Meal::all()->each(function($meal) use ($tags){
            $meal->tags()->attach(
                $tags->random(rand(1,3))->pluck('id')->toArray()
            );
        });

        //seed Meal-Ingredient
        $ingreds = Ingredient::all();
        Meal::all()->each(function($meal) use ($ingreds){
            $meal->ingredients()->attach(
                $ingreds->random(rand(1,3))->pluck('id')->toArray()
            );
        });
    }
}
