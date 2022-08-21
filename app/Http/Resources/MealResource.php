<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\TagResource;
use App\Http\Resources\IngredientResource;

class MealResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {         
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            $this->mergeWhen(str_contains($request->with, "category"), [
                'category' => new CategoryResource($this->category),    
            ]),
            $this->mergeWhen(str_contains($request->with, "tags"), [
                'tag' => TagResource::collection($this->tags)
            ]),
            $this->mergeWhen(str_contains($request->with, "ingredients"), [
                'ingredients' => IngredientResource::collection($this->ingredients)
            ]),
            
        ];
    }
}
