<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Meal extends Model implements TranslatableContract
{
    use HasFactory;
    use Translatable;
    use SoftDeletes;

    public $translatedAttributes = ['title', 'description'];
    protected $hidden = ['translations', 'category_id', 'created_at', 'updated_at'];
    protected $softDelete = true;
    protected $dates = ['deleted_at'];   
    protected $fillable = [
        'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class, 'ingredient_meals');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'meal_tags');
    }
    
    /**
     * getStatus
     * Sets the 'status' attribute for the given Meal instance,
     * based on the 'diff_time' parameter.
     * 
     * If the param 'status' is emitted from the request, returns "created".
     * 
     * 
     * @param  integer $diff_time
     * @return string
     */
    public function getStatus($diff_time) : string
    {
        if ($this->deleted_at != null) {
            return 'deleted';
        }
        $createdAtDate = new \DateTime($this->created_at);
        $updatedAtDate = new \DateTime($this->updated_at);

        if ($createdAtDate != $updatedAtDate) {
            return 'updated';
        }
        return 'created';
    }
    
}
