<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class OneOrMultiple implements Rule
{
    private $accepted_params = ["category", "ingredients", "tags"];
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {   
        // check if value contains colon
        if(!str_contains($value, ','))
        {
            //if not, simply check if given value is in accepted params
            return in_array($value, $this->accepted_params);
        }
        else
        {
            $param_vals = explode(",", $value);
            //if contains, explode the string to array, and check if all values are valid
            foreach($param_vals as $param)
            {   
                
                if(!in_array($param, $this->accepted_params)) 
                {
                    return false;
                }
            }
            return true;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "Can only contain ".implode(',', $this->accepted_params);
    }
}
