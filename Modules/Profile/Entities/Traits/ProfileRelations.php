<?php
namespace Modules\Profile\Entities\Traits;
use Modules\Auth\Entities\User;

trait ProfileRelations{
    public function user() { 
        return $this->belongsTo(User::class); 
    }
}
