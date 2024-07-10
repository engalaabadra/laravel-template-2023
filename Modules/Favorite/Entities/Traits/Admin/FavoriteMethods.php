<?php
namespace Modules\Favorite\Entities\Traits\Admin;
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
        return $model->where(['main_lang'=>$lang])->where('user_id',authUser()->id)->with(['user'])->paginate($request->total);
    }
    //get data -all- //
    public function getAllDataMethod($model){
        if(isset(getallheaders()['lang']))  return $this->allDataMethod($model,getallheaders()['lang']);
        else return $this->allDataMethod($model);
    }
    public function allDataMethod($model,$lang=null){
        if(!$lang) $lang=localLang();
        return $model->where('user_id',authUser()->id)->with(['user'])->where(['main_lang'=>$lang])->get();
    }

}
