<?php

namespace Modules\Auth\Entities;

use Laratrust\Models\LaratrustPermission;
use GeneralTrait;
class Permission extends LaratrustPermission
{
    use GeneralTrait;
    protected $appends = ['original_active'];
    public $guarded = [];
}
