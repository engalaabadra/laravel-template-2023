<?php
namespace Modules\Profile\Entities\Traits;
use App\Services\MsegatSmsService;
use App\Services\SendingMessagesService;
use GeneralTrait;
use Modules\Profile\Entities\Profile;
use App\Models\Image;

trait ProfileMethods{
    use GeneralTrait;

    public function updateProfile($request,$model,$user){//model:profile
        $data= $request->validated();
        $rolesDoctor= $this->rolesUserByName($user);
        if(in_array('doctor',$rolesDoctor)) $enteredData= exceptData($data,['image','specialties','license_number','bio','years_experience','gender','birth_date','price_half_hour']);
        else $enteredData= exceptData($data,['image','specialties','bio','gender','birth_date']);

        $user->update($enteredData);
        if (array_key_exists('bio',$data) || array_key_exists('gender',$data) || array_key_exists('birth_date',$data) || array_key_exists('years_experience',$data) || array_key_exists('license_number',$data) || array_key_exists('price_half_hour',$data)){
            $profile = $this->find($model,$user->id,'user_id');//if exist : will make update , if not exist will make create
            if(is_numeric($profile)){//not found any row. for this user in profiles table  , so will create profile for this user
                $data['user_id'] = $user->id;

                if(in_array('doctor',$rolesDoctor)){
                    $model->create($data);
                    //send to email
                    $dataEmail=[
                        'email'=>$user->email,
                        'doctor'=>$user->full_name,
                        'to'=>'doctor',
                        'type'=>'welcome'
                    ];
                    app(SendingMessagesService::class)->sendingMessage($dataEmail);
                }else{
                   $model->create($data);
                   //send to email
                   $dataEmail=[
                       'email'=>$user->email,
                       'user'=>$user->full_name,
                       'type'=>'welcome',
                       'to'=>'user'
                   ];
                   app(SendingMessagesService::class)->sendingMessage($dataEmail);
                }
            }else{

                if(in_array('doctor',$rolesDoctor)) $profile->update($data);
                else $profile->update($data);
            }
        }

        if(!empty($data['image'])) $this->uploadImage($request,$user,'Modules\Auth\Entities\User','profiles-images',$user->id);
        return $user->load(['image','profile']);
    }
    public function updatePass($request,$model){
        $userId=authUser()->id;
        $user= $model->where(['id'=>$userId])->first();
        $data=$request->validated();
        //check if oldPass = new pass
        if($data['old_password']==$data['new_password']){
            return trans('messages.You cannot modify your old password because the new password you entered is the same as the old one');
        }
        if(hashCheck($data['old_password'], $user->password)) {
            if($data['new_password']==$data['confirmation_new_password']){
                $user->password=hashData($data['new_password']);
                $user->save();
                return $user;
            }else{
                return trans('messages.Password does not match confirm password');
            }
        }else{
            return trans('messages.The old password is incorrect, please try again');
        }
    }

}
