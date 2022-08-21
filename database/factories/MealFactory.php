<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Config;
use App\Models\Category;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Meal>
 */
class MealFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $locales = Config::get('translatable.locales');
        $p = mt_rand(0, 99);
        $my_data = [
            // 75% chance of attaching the category ID, else NULL
            'category_id' => $p > 25 ? Category::factory()->create()->id : NULL
        ];
        foreach($locales as $locale){
            $my_data[$locale] = [
                'title' => strval(strtoupper($locale))."- "
                        .fake()->sentence($nbWords = 3, $variableNbWords = true),

                'description' => strval(strtoupper($locale))."- "
                        .fake()->sentence($nbWords = 3, $variableNbWords = true),
            ];
            
        }
        return $my_data;
    }
}
