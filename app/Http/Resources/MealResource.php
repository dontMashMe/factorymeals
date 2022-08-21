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
            // only one can exist, so no collection
            'category' => new CategoryResource($this->category),
            'ingredient' => IngredientResource::collection($this->ingredients),
            'tag' => TagResource::collection($this->tags)
        ];
    }
}
