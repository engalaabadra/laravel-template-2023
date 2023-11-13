<?php
namespace Modules\Review\Entities\Traits\User;
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
 //actions : store
 public function actionMethod($request,$model,$id=null){
    $data = $request->validated();
    $user=authUser();
   //check if this user make Review for himself
    $userReviewHimSelf = $model->where(['user_id'=>$user->id,'doctor_id'=>$user->id])->first();
    if($userReviewHimSelf) return trans('messages.You cannt add Review on yourself');
    
    
    if($id){ //update
        $item = $this->find($model,$id,'id');
        if(is_numeric($item)) return 404;
        if($item->user_id !== authUser()->id) return trans('messages.This review not for you to update on it');
        $reservation=Reservation::where('id',$item->reservation_id)->first();
        $result = $this->conditionsReviewReservation($reservation);
        if($result) return $result;
        $item->update($data);//data:desc , rating
        return $item;
    }else{
        $data['user_id'] =  $user->id;
        //check if this user make a Review on a doctor
        $doctor = User::where('id',$data['doctor_id'])->first();
        if(!$doctor) return 404;
        $rolesDoctor= $doctor->roles->pluck('name')->toArray();
        if(!in_array('doctor',$rolesDoctor)) return trans('messages.This is Not a doctor to add Review on his');

        $reservation=Reservation::where('id',$data['reservation_id'])->first();
        $result = $this->conditionsReviewReservation($reservation);
        if($result) return $result;
        //check if you make a Review on same reservation with  same doctor 
        $userReviewDoctor = $model->where(['user_id'=>$user->id,'doctor_id'=>$data['doctor_id'],'reservation_id'=>$data['reservation_id']])->first();
        if($userReviewDoctor) return trans('messages.You Added Review on this reservation with this doctor before it');
        
        $item = $model->create($data);
        return $item;

    }
}

    public function deleteReview($id,$model,$forceDelete=0){
        $item = $this->find($model,$id,'id');
        if(is_numeric($item)) return 404;
        if($item->user_id !== authUser()->id) return trans('messages.This review not for you to delete  it');
        if($item->deleted_at!==null){
            //this item already deleted permenetly , so now can make force delete for it
            if($forceDelete==0) return trans('messages.this item already deleted permenetly');
            else $this->forceDeleteMethod($id,$model);

        }else{// can make normal delete
            $item->delete($item);
            return $item;
        }
    }
}
