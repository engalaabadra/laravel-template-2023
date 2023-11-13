<?php
namespace Modules\Profile\Repositories\Doctor;

use Illuminate\Support\Facades\Storage;
use Modules\Profile\Repositories\Doctor\ProfileRepositoryInterface;
use Modules\Profile\Entities\Traits\GeneralProfileTrait;
use DB;
class ProfileRepository implements ProfileRepositoryInterface{
    use GeneralProfileTrait;
    public function show($model,$id){
        if(!$id) $id=authUser()->id;
        //check if exist or not and if this id not admin , super
        $item = $this->find($model,$id,'id');
        if(is_numeric($item)) return 404;
        $rolesUser = $this->rolesUserByName($item);
        if(in_array('superadmin',$rolesUser) || in_array('admin',$rolesUser)) return trans('messages.You cannt see this');
        if(in_array('user',$rolesUser)) return $model->where(['id'=>$id])->with(['image','profile'])->first();
        $modelData=$model->where(['id'=>$id])->with(['image','profile','reviewsDoctor'])->first();
        return $modelData;
    }


    public function update($request,$model,$doctor){
        $doctor = $this->updateProfile($request,$model,$doctor);
        return $doctor;   
    }
    
    public function updatePassword($request,$model){
       $result = $this->updatePass($request,$model);
       return $result;
    }
}

