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

    public function getStatus($diff_time) : string
    {
        if (!isset($diff_time)) return "created";
        

        $unix_created = strtotime($this->created_at);
        $unix_deleted = strtotime($this->deleted_at);
        $unix_updated = strtotime($this->updated_at);
        
        $status = "";

        if(($unix_updated > $diff_time) && ($unix_updated > $unix_created))
        {
            $status = 'modified';
        }
        else if($unix_deleted > $diff_time)
        {
            $status = 'deleted';
        }
        else
        {
            $status = 'created';
        }
        
        return $status;
    }
    
}
