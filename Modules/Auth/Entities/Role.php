<?php

namespace Modules\Auth\Entities;

use App\Models\Admin;
use GeneralTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laratrust\Models\LaratrustRole;
use Modules\Auth\Entities\Traits\Role\GeneralRoleTrait;

class Role extends LaratrustRole
{
    use SoftDeletes,GeneralTrait,GeneralRoleTrait;
    protected $appends = ['original_active'];
    public $guarded = [];

    public function users(){
        return $this->belongsToMany(User::class,'role_user','role_id','user_id');
    }
    public function permissions(){
        return $this->belongsToMany(Permission::class,'permission_role','role_id','permission_id');
    }

    public function admins(){
        return $this->belongsToMany(Admin::class,'role_user','role_id','user_id');
    }
}
