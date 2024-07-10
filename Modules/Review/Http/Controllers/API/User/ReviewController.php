<?php

namespace Modules\Review\Http\Controllers\API\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Review\Repositories\User\Additional\ReviewRepository;
use Modules\Review\Entities\Review;
use GeneralTrait;
use Modules\Review\Resources\User\ReviewResource;
class ReviewController extends Controller
{
    use GeneralTrait;
    /**
     * @var ReviewRepository
     */
    protected $reviewRepo;
        /**
     * @var Review
     */
    protected $review;
    
    /**
     * ReviewController constructor.
     *
     * @param ReviewRepository $reviews
     */
    public function __construct( Review $review,ReviewRepository $reviewRepo)
    {
        $this->review = $review;
        $this->reviewRepo = $reviewRepo;
    }

    /**
     * Display a listing of the resource (all , pagination).
     *
     * @return \Illuminate\Http\Response
     */
    public function reviewsDoctor(Request $request,$doctorId){
        $reviews = $this->reviewRepo->getReviewsDoctor($request,$this->review,$doctorId);
        if(page()) $data=getDataResponse(ReviewResource::collection($reviews));
        else $data=ReviewResource::collection($reviews);
        return successResponse(0,$data);
    }
}
