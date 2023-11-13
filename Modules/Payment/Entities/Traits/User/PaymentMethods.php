<?php
namespace Modules\Payment\Entities\Traits\User;
use GeneralTrait;

trait PaymentMethods{

 //get data -paginates-//
    public function getPaginatesDataMethod($request, $model){
        if(isset(getallheaders()['lang']))  return $this->paginatesDataMethod($request, $model,getallheaders()['lang']);
        else return $this->paginatesDataMethod($request, $model);
    }
    public function paginatesDataMethod($request, $model,$lang=null){
        if(!$lang) $lang=localLang();
        return $model->where(['main_lang'=>$lang])->with(['image'])->paginate($request->total);
    }
    //get data -all- //
    public function getAllDataMethod($model){
        if(isset(getallheaders()['lang']))  return $this->allDataMethod($model,getallheaders()['lang']);
        else return $this->allDataMethod($model);
    }
    public function allDataMethod($model,$lang=null){
        if(!$lang) $lang=localLang();
        return $model->with(['image'])->where(['main_lang'=>$lang])->get();
    }
    
}