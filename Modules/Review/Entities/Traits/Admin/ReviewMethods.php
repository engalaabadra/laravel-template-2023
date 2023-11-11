<?php
namespace Modules\Review\Entities\Traits\Admin;
use GeneralTrait;
use Modules\Auth\Entities\User;
use Modules\Reservation\Entities\Reservation;
use Modules\Review\Traits\ReviewTrait;
trait ReviewMethods{
    // use ReviewTrait;
    
    public function conditionsReviewReservation($reservation){
        if(!$reservation) return 404;
        if($reservation->user_id !=authUser()->id) return trans('messages.this reservation not for you to add or update review on it');
        if($reservation->status=='0') return trans('messages.this reservation has been canceled , so you cannt add or update review on it');
      //  if($reservation->status!=='2') return trans('messages.this is reservation not complete until now  , so you cannt add or update review on it');
    }
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

   
}
