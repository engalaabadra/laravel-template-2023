<?php
namespace Modules\Notification\Entities\Traits\User;
use GeneralTrait;
trait NotificationMethods{

 //get data -paginates-//
 public function getPaginatesDataMethod($request, $model){
    if(isset(getallheaders()['lang']))  return $this->paginatesDataMethod($request, $model,getallheaders()['lang']);
    else return $this->paginatesDataMethod($request, $model);
    }
    public function paginatesDataMethod($request, $model,$lang=null){
        if(!$lang) $lang=localLang();
        $result=array_key_exists($lang, config('languages'));
        return $model->where(['main_lang'=>$lang,'user_id'=>authUser()->id])->orderBy('created_at', 'DESC')->paginate($request->total);
    }
    //get data -all- //
    public function getAllDataMethod($model){
    if(isset(getallheaders()['lang']))  return $this->allDataMethod($model,getallheaders()['lang']);
        else return $this->allDataMethod($model);
    }
    public function allDataMethod($model,$lang=null){
        if(!$lang) $lang=localLang();
        $result=array_key_exists($lang, config('languages'));
        return $model->where(['main_lang'=>$lang,'user_id'=>authUser()->id])->orderBy('created_at', 'DESC')->get();
    }


}