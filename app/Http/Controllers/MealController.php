<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meal;
use App\Http\Requests\GetRequest;

class MealController extends Controller
{
    
    public function get(GetRequest $request)
    {
        $request->validate([
            'lang' => [
                'required',
                'size:2',
                'string',
                'exists:languages,locale'
            ]
        ]);


    }

    
   
    
    
}
