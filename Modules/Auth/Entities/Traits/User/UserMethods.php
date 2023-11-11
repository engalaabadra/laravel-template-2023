<?php
namespace Modules\Auth\Entities\Traits\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Modules\Auth\Entities\User;
use Modules\Auth\Entities\Role;
use Modules\Favorite\Entities\Favorite;
use Modules\Appointment\Entities\Appointment;
use DB;
use GeneralTrait;
use Modules\Auth\Traits\UserTrait;

trait UserMethods{
    use UserTrait;
    use GeneralTrait{
        GeneralTrait::getPaginatesData as getPaginatesDataMethod;
        GeneralTrait::paginatesData as paginatesDataMethod;
        GeneralTrait::action as actionMethod;
    }

    /**
    * Method for get Relations  User.
    *
    * @return object
    */    
    public function getRelationsUser($model,$userId){
        $user=$this->find($model,$userId);
        if(is_numeric($user)) return 404;
        return $user->roles()->withoutGlobalScope(ActiveScope::class)->withoutGlobalScope(LanguageScope::class)->paginate(request()->total);
       }
}

