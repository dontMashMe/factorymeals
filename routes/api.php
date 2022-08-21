<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
//use App\Http\Resources\MealResource;
use App\Http\Controllers\MealController;

//use Config;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/meals', [MealController::class, 'get'])->name('meals');

// test route
Route::get('/test', function() {
    //return MealResource::collection(Meal::all());
      /*
    $locales = Config::get('translatable.locales');
    $my_data = [
        'slug' => str_replace(' ', '_', strtolower(fake()->name()))
    ];
    foreach($locales as $locale){
        $my_data[$locale] = [
            'title' => strval(strtoupper($locale))."- "
            .fake()->sentence($nbWords = 3, $variableNbWords = true)
        ];
    }
    return $my_data;
  
    $tag_data = [
        'slug' => "cc",
        'en' => ['title' => "Title on englishccc"],
        'fr' => ['title' => "Title on frnch"],
    ];
     
    //Tag::create($tag_data);
    //dd(Tag::all());
    $tag = Tag::where('slug', 'cc')->first();
    //dd($tag->hasTranslation());
    $tag->translate('fr')->title;
    dd($tag->title);

    $meal_data = [
        'en' => ['title' => "Title on english 5", 'description' => "English description 5"],
        'fr' => ['title' => "Title on french 5", 'description' => "French description 5"]
    ];

   //Meal::create($meal_data);
   $meal = Meal::where('id', 4)->first();
   //dd($meal);
   //App::setlocale('fr');
   //$meal->translate('fr')->title;
   
   return $meal;


   $category_data = [
    'slug' => "slug_predjelo",
    'en' => ['title' => "Predjelo mrcina na engleskom"],
    'fr' => ['title' => "Predjelo mrcina na francuskom"],
   ];
   $en = "Predjelo mrcina na engleskom ";
   $fr = "Predjelo mrcina na francuskom ";

   for($i = 0; $i < 10; $i++){
        
        Category::create([
            'slug' => "slug_".strval($i),
            'en' => ['title' => $en.strval($i)],
            'fr' => ['title' => $fr.strval($i)],
        ]);
   }

   //return Category::all();

   $categories = Category::all();

   for($i = 21; $i < 31; $i++){
        $p = rand(0, 99);
        $category = $categories->random()->id;
        Meal::create([
            'category_id' => $p>25 ? $category : NULL,
            'en' => ['title' => "Title on english ".strval($i), 'description' => "English description ".strval($i)],
            'fr' => ['title' => "Title on french ".strval($i), 'description' => "French description ".strval($i)]
        ]);
   }*/
   /*
   //$category = Category::find(1)->meal;
   $meals = Meal::where('id', 5)->with('category')->get();
   return $meals;*/
   //App::setlocale('en');
   //$cates = Category::all();
   //return $cates;
   //$meals = Meal::with('ingredients', 'tags', 'category')->get();
   //return $meals;
    //Meal::create($meal_data);
});