<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Language;
use Config;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $locales = Config::get('translatable.locales');
        foreach($locales as $locale) {
            Language::create([
                'locale' => $locale
            ]);
        }
    }
}
