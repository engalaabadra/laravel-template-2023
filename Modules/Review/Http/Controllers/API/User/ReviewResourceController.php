<?php

namespace Modules\Review\Http\Controllers\API\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Review\Repositories\User\Resources\ReviewRepository;
use Modules\Review\Entities\Review;
use GeneralTrait;
use Modules\Review\Resources\User\ReviewResource;
use Modules\Review\Http\Requests\User\AddReviewRequest;
use Modules\Review\Http\Requests\User\UpdateReviewRequest;
class ReviewResourceController extends Controller
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
     * ReviewResourceController constructor.
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
    public function index(Request $request){
        $reviews = $this->reviewRepo->all($request,$this->review);
        if(page()) $data=getDataResponse(ReviewResource::collection($reviews));
        else $data=ReviewResource::collection($reviews);
        return successResponse(0,$data);
    }
    /**
     * store.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(AddReviewRequest $request){
        $review=$this->reviewRepo->store($request,$this->review);
        if(is_string($review)) return clientError(0,$review);
        return successResponse(1,new ReviewResource($review->load(['user','doctor'])));
    }
    /**
     * update.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReviewRequest $request,$id){
        $review=$this->reviewRepo->update($request,$id,$this->review);
        if(is_numeric($review)) return clientError(4);
        if(is_string($review)) return clientError(0,$review);
        return successResponse(1,new ReviewResource($review->load(['user','doctor'])));
    }
    /**
     * destroy.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $review=$this->reviewRepo->delete($id,$this->review);
        if(is_numeric($review)) return clientError(4);
        if(is_string($review)) return clientError(0,$review);
        return successResponse(2,new ReviewResource($review->load(['user','doctor'])));
    }
  

}
