<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $primaryKey = 'locale';
    protected $keyType = "string";
    public $timestamps = false;
    
    /**
     * scopeGetLocales
     * Returns an array of locales in the database.
     * Callable anywhere.
     * 
     * @return array
     */
    public function scopeGetLocales() : array
    {
        $values = [];
        foreach($this->all()->toArray() as $locale)
        {
            array_push($values, $locale["locale"]);
        }
        return $values;
    }
}
