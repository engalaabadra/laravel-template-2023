<?php

namespace Modules\Review\Http\Controllers\API\Admin;
use App\Http\Controllers\Controller;
use App\Repositories\EloquentRepository;
use Modules\Review\Repositories\Admin\Additional\ReviewRepository;
use Modules\Review\Entities\Review;
use GeneralTrait;
use Modules\Review\Http\Controllers\API\Admin\ReviewResourceController;
class ReviewController extends ReviewResourceController
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
     * StoreController constructor.
     *
     * @param EloquentRepository $eloquentRepo
     * @param Review $review
     * @param ReviewRepository $reviewRepo
     */
    public function __construct(EloquentRepository $eloquentRepo, Review $review,ReviewRepository $reviewRepo)
    {
       $this->eloquentRepo = $eloquentRepo;
        $this->review = $review;
        $this->reviewRepo = $reviewRepo;
    }

}
