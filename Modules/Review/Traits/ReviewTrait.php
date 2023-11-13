<?php
use Modules\Review\Traits;
trait ReviewTrait{

    public function conditionsReviewReservation($reservation){
        if(!$reservation) return 404;
        if($reservation->user_id !=authUser()->id) return trans('messages.this reservation not for you to add or update review on it');
        if($reservation->status=='0') return trans('messages.this reservation has been canceled , so you cannt add or update review on it');
        if($reservation->is_end!=='1') return trans('messages.this is reservation not complete until now  , so you cannt add or update review on it');
    }
}