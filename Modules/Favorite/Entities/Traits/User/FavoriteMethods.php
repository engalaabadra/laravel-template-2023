<?php
namespace Modules\Favorite\Entities\Traits\User;
use GeneralTrait;
use Modules\Auth\Entities\User;
trait FavoriteMethods{

      //get data//
      public function getPaginatesDataMethod($request, $model){
        if(isset(getallheaders()['lang']))  return $this->paginatesDataMethod($request, $model,$lang);
        else return $this->paginatesDataMethod($request, $model);
    }
    public function paginatesDataMethod($request, $model,$lang=null){
        if(!$lang) $lang=localLang();
        return $model->where(['main_lang'=>$lang])->where('user_id',authUser()->id)->with(['doctor','user'])->paginate($request->total);
    }
    //get data -all- //
    public function getAllDataMethod($model){
        if(isset(getallheaders()['lang']))  return $this->allDataMethod($model,getallheaders()['lang']);
        else return $this->allDataMethod($model);
    }
    public function allDataMethod($model,$lang=null){
        if(!$lang) $lang=localLang();
        return $model->where('user_id',authUser()->id)->with(['doctor','user'])->where(['main_lang'=>$lang])->get();
    }

    public function actionMethod($request,$model,$id=null){
        $data = $request->validated();    
        $user=authUser();
        //check if this user make Favorite for himself
        $userFavoriteHimSelf = $model->where(['user_id'=>$user->id,'doctor_id'=>$user->id])->first();
        if($userFavoriteHimSelf) return trans('messages.You cannt add Favorite on yourself');
        //check if you make a Favorite on same doctor
        $userFavoriteDoctor = $model->where(['user_id'=>$user->id,'doctor_id'=>$data['doctor_id']])->first();
        if($userFavoriteDoctor) return trans('messages.You Added Favorite on this doctor before it');
        //check if this user make a Favorite on a doctor
        
        $doctor = User::where('id',$data['doctor_id'])->first();
        if(!$doctor) return 404;
        $rolesDoctor= $this->rolesUserByName($doctor);
        if(!in_array('doctor',$rolesDoctor)) return trans('messages.This is Not a doctor to add Favorite on his');
        $data['user_id'] =  $user->id;
        $item = $model->create($data);
        return $item;
    }

    public function normalDeleteItemMethod($model,$request){
        $data=$request->validated();
        $item=$model->where(['doctor_id'=>$data['doctor_id'],'user_id'=>authUser()->id])->first();
        if(!$item){
            return 404;
        }
        
        $item->delete();
    }
}
