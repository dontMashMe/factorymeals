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
        if (!isset($diff_time)) {
            return "created";
        } 
        
        $unix_created = strtotime($this->created_at);
        $unix_deleted = strtotime($this->deleted_at);
        $unix_updated = strtotime($this->updated_at);
        
        $status = "";
        // if is soft deleted, and 'deleted_at' is greater than diff_time
        if (!empty($unix_deleted) && $diff_time > $unix_deleted) {
            $status = 'deleted';
        // if diff_time is greater than 'updated_at' and is different than 'created_at'
        } elseif (($diff_time > $unix_updated) && ($unix_updated != $unix_created)) {
            $status = 'modified';
        // if else fails, 'created'
        } else {
            $status = 'created';
        }
        
        return $status;
    }
    
}
