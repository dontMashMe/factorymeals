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
        $this->_setlocale($request->lang);
        return MealResource::collection(Meal::all());  
    }

    public function _setlocale($locale)
    {
        App::setlocale($locale);
    }
}
