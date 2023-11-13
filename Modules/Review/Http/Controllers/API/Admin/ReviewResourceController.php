<?php

namespace Modules\Review\Http\Controllers\API\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Review\Http\Requests\StoreReviewRequest;
use Modules\Review\Http\Requests\UpdateReviewRequest;
use Modules\Review\Http\Requests\DeleteReviewRequest;
use App\Repositories\EloquentRepository;
use Modules\Review\Repositories\Admin\Resources\ReviewRepository;
use Modules\Review\Entities\Review;
use GeneralTrait;
use Modules\Review\Resources\Admin\ReviewResource;

class ReviewResourceController extends Controller
{
    use GeneralTrait;
    /**
     * @var EloquentRepository
     */
    protected $eloquentRepo;
    /**
     * @var ReviewRepository
     */
    protected $reviewRepo;
        /**
     * @var Review
     */
    protected $review;
    
    /**
     * ReviewsController constructor.
     *
     * @param ReviewRepository $reviews
     */
    public function __construct(EloquentRepository $eloquentRepo, Review $review,ReviewRepository $reviewRepo)
    {
       $this->eloquentRepo = $eloquentRepo;
        $this->review = $review;
        $this->reviewRepo = $reviewRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $reviews=$this->reviewRepo->all($this->review);
        if(page()) $data=getDataResponse(ReviewResource::collection($reviews));
        else $data=ReviewResource::collection($reviews);
        return successResponse(0,$data);
    }
     /**
     * Display a listing of the resource via pagintation from search.
     *
     * @return \Illuminate\Http\Response
     */
    public function search($words,$col=null){
        $reviews=$this->reviewRepo->search($this->review,$words,$col);
        if(page()) $data=getDataResponse(ReviewResource::collection($reviews));
        else $data=ReviewResource::collection($reviews);
        return successResponse(0,$data);
    }
 /**
     * Display a listing of the resource (all , pagination) from trash.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash(){
        $reviews=$this->reviewRepo->trash($this->review);
        if(is_numeric($reviews)) return  clientError(4);
        if(page()) $data=getDataResponse(ReviewResource::collection($reviews));
        else $data=ReviewResource::collection($reviews);
        return successResponse(0,$data);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $review=$this->reviewRepo->show($id,$this->review);
        if(is_numeric($review)) return  clientError(4,$review);
        return successResponse(0,new ReviewResource($review));
    }
    /**
     * Restore the specified resource in storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function restore($id){
        $review =  $this->reviewRepo->restore($id,$this->review);
        if(is_numeric($review)) return  clientError(4);
        return successResponse(5,new ReviewResource($review));
    }
    /**
     * Restore All.
     *
     * @return \Illuminate\Http\Response
     */
    public function restoreAll(){
        $reviews =  $this->reviewRepo->restoreAll($this->review);
        if(is_numeric($reviews)) return  clientError(4);
        return successResponse(5);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeleteReviewRequest $request,$id)
    {
        $review= $this->reviewRepo->destroy($id,$this->review);
        if(is_numeric($review)) return  clientError(4);
        return successResponse(2,new ReviewResource($review));  
    }
    public function forceDelete(DeleteReviewRequest $request,$id)
    {
        //to make force destroy for a review must be this review  not found in reviews table  , must be found in trash Categories
        $review=$this->reviewRepo->forceDelete($id,$this->review);
        if(is_numeric($review)) return  clientError(4);
        return successResponse(4);
    } 
}

