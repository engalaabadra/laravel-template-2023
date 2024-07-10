<?php

namespace Modules\Review\Http\Controllers\API\User;
use App\Http\Controllers\Controller;
use Modules\Review\Entities\Review;
use GeneralTrait;
use Modules\Review\Services\User\ReviewService;
class ReviewServiceController extends Controller
{
    use GeneralTrait;
    /**
     * @var ReviewService
     */
    protected $reviewService;
        /**
     * @var Review
     */
    protected $review;
    
    /**
     * ReviewServiceController constructor.
     *
     * @param ReviewService $reviews
     */
    public function __construct( Review $review,ReviewService $reviewService)
    {
        $this->review = $review;
        $this->reviewService = $reviewService;
    }

}
