<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\ActiveScope;
use App\Scopes\LanguageScope;
class BaseModel extends Model
{
    // public function getActiveAttribute($value)
    // {
    //     // Modify the value as needed
    //     $mutatedValue = intval($value);
    //     // Assign the mutated value to the attribute
    //     $this->attributes['active'] = $mutatedValue;
    // }

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new ActiveScope);
        static::addGlobalScope(new LanguageScope);
    }
}
