<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Language;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    
    public function definition()
    {

        $locales = Language::GetLocales();
        //dd($locales);
        $my_data = [
            'slug' => str_replace(' ', '_', strtolower(fake()->name()))
        ];
        /* Category::create([
            'slug' => "slug_".strval($i),
        '   en' => ['title' => $en.strval($i)],
            'fr' => ['title' => $fr.strval($i)],
        ]);
        */
        foreach($locales as $locale) {
            $my_data[$locale] = [
                'title' => strval(strtoupper($locale))."- "
                .fake()->sentence($nbWords = 3, $variableNbWords = true)
            ];
        }
        return $my_data;
    }
}
