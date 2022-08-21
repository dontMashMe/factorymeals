<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meal;
use App\Http\Requests\GetRequest;
use Illuminate\Support\Facades\App;
use App\Http\Resources\MealResource;



class MealController extends Controller
{
    
    public function get(GetRequest $request)
    {
        
        // set the locale
        $this->_setlocale($request->lang);

        // pluck the optional filtering params out of URL
        $category = $request->input('category');
        $tags     = $request->input('tags');

        // build the query and return collection.
        return MealResource::collection(
            Meal::when($category, function ($query, $category) {
                if(is_numeric($category)) $query->where('category_id', $category);
                elseif($category == "!NULL") $query->whereNotNull('category_id');
                else $query->whereNull('category_id');
            })
            ->when($tags, function($query, $tags) {
                $query->whereHas('tags', function($q) use($tags){
                    $q->whereIn('id', $tags);
                });
            })
            ->get()
        
        );
        
    }

    public function _setlocale($locale)
    {
        App::setlocale($locale);
    }
}
