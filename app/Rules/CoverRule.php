<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CoverRule implements Rule
{
    private $updatedCover;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($updatedCover)
    {
        $this->updatedCover=$updatedCover;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $cover)
    {
        if($this->updatedCover instanceof \Illuminate\Http\UploadedFile){
            return is_string($cover);
        }else{
            return (
                    is_string($cover) 
                        OR 
                    $cover instanceof \Illuminate\Http\UploadedFile
                    ); 
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }
}
