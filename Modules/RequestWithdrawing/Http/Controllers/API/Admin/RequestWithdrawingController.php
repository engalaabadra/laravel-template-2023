<?php

namespace Modules\RequestWithdrawing\Http\Controllers\API\Admin;
use App\Http\Controllers\Controller;
use App\Repositories\EloquentRepository;
use Modules\RequestWithdrawing\Repositories\Admin\Additional\RequestWithdrawingRepository;
use Modules\RequestWithdrawing\Entities\RequestWithdrawing;
use GeneralTrait;
use Modules\RequestWithdrawing\Http\Controllers\API\Admin\RequestWithdrawingResourceController;
class RequestWithdrawingController extends RequestWithdrawingResourceController
{
    use GeneralTrait;
    /**
     * @var EloquentRepository
     */
    protected $eloquentRepo;
    /**
     * @var RequestWithdrawingRepository
     */
    protected $requestWithdrawingRepo;
        /**
     * @var RequestWithdrawing
     */
    protected $requestWithdrawing;
    
    /**
     * StoreController constructor.
     *
     * @param EloquentRepository $eloquentRepo
     * @param RequestWithdrawing $requestWithdrawing
     * @param RequestWithdrawingRepository $requestWithdrawingRepo
     */
    public function __construct(EloquentRepository $eloquentRepo, RequestWithdrawing $requestWithdrawing,RequestWithdrawingRepository $requestWithdrawingRepo)
    {
       $this->eloquentRepo = $eloquentRepo;
        $this->requestWithdrawing = $requestWithdrawing;
        $this->requestWithdrawingRepo = $requestWithdrawingRepo;
    }

}
