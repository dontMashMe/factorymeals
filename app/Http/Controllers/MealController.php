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
        $this->_setLocale($request->lang);

    
        // return the payload
        return $this->buildQuery($request);
       
        
    }

    public function _setLocale($locale)
    {
        App::setlocale($locale);
    }

    public function buildQuery($request)
    {
        // pluck the optional filtering params out of URL
        $category = $request->input('category');
        $tags     = $request->input('tags');
        $per_page = $request->input('per_page');
        $page     = $request->input('page');

        // build the query and return collection.
        return MealResource::collection(
            Meal::when($category, function ($query, $category) {
                if(is_numeric($category)) $query->where('category_id', $category);
                elseif($category == "!NULL") $query->whereNotNull('category_id');
                else $query->whereNull('category_id');
            })
            ->when($tags, function($query, $tags) {
                foreach(explode(",", $tags) as $tag_id)
                {
                    $query->whereHas('tags', function($q) use($tag_id){
                        $q->where('id', $tag_id);
                    });
                }
            })
            ->withTrashed()
            ->get()
            ->toQuery()
            ->paginate($per_page, ['*'], 'page', $page)

        );
    }
}
