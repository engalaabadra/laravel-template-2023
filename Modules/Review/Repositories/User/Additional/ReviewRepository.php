<?php
namespace Modules\Review\Repositories\User\Additional;

use Modules\Review\Repositories\User\Additional\ReviewRepositoryInterface;
use Modules\Review\Entities\Traits\User\ReviewMethods;

class ReviewRepository implements ReviewRepositoryInterface
{
    use ReviewMethods;
    public function getReviewsDoctor($request, $model,$doctorId){
        if(page()) return $model->where('doctor_id',$doctorId)->paginate($request->total);
        else return $model->where('doctor_id',$doctorId)->get();
    }
   
}
