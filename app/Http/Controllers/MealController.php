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
        $this->setAppLocale($request->lang);

        // return the payload
        return $this->buildQuery($request);
    }
    
    /**
     * setAppLocale
     * Sets the locale of the App to the language provided 
     * by the 'lang' param in the URL. 
     * 
     * @param  string $locale
     * @return void
     */
    public function setAppLocale($locale)
    {
        App::setlocale($locale);
    }
    
    /**
     * buildQuery
     * Returns an instance of Meal collection query builder.
     * Filters the collection with URL parameters.
     * 
     * Is called every time a /meals route is hit.
     * @param  mixed $request
     * @return QueryBuilder
     */
    public function buildQuery($request)
    {
        // pluck the optional filtering params out of URL
        $category = $request->input('category');
        $tags     = $request->input('tags');
        $per_page = $request->input('per_page');
        $page     = $request->input('page');

        return MealResource::collection(
            //handle 'category' parameter, if it exists.
            Meal::when($category, function ($query, $category) {
                if(is_numeric($category)) {
                    $query->where('category_id', $category);
                } elseif($category == "!NULL") {
                    $query->whereNotNull('category_id');
                } else {
                    $query->whereNull('category_id');
                } 
            })
            //handle 'tags' parameter, if it exists.
            ->when($tags, function($query, $tags) {
                // append multiple conditions to the query to match for exactly each tag_id passed
                foreach(explode(",", $tags) as $tag_id) {
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
