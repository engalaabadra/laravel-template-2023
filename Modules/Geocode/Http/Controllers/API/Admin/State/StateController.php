<?php

namespace Modules\Geocode\Http\Controllers\API\Admin\State;
use App\Http\Controllers\Controller;
use App\Repositories\EloquentRepository;
use Illuminate\Http\Request;
use Modules\Geocode\Repositories\API\Admin\State\Additional\StateRepository;
use Modules\Geocode\Entities\State;
use GeneralTrait;
use Modules\Product\Resources\ProductResource;
use Modules\Geocode\Resources\AreaResource;
use Modules\Geocode\Http\Controllers\API\Admin\State\StateResourceController;
class StateController extends StateResourceController
{
    use GeneralTrait;
    /**
     * @var EloquentRepository
     */
    protected $eloquentRepo;
    /**
     * @var StateRepository
     */
    protected $stateRepo;
        /**
     * @var State
     */
    protected $state;
    
    /**
     * StateController constructor.
     *
     * @param EloquentRepository $eloquentRepo
     * @param StateRepository $stateRepo
     * @param State $state
     */
    public function __construct(EloquentRepository $eloquentRepo, State $state,StateRepository $stateRepo)
    {
       $this->eloquentRepo = $eloquentRepo;
        $this->state = $state;
        $this->stateRepo = $stateRepo;
    }

    public function getAreasState(Request $request,$stateId){
            $AreasState=$this->stateRepo->getAreasState($this->state,$request,$stateId);
            if(is_string($AreasState)){
                return customResponse(404);
            }
            $data=AreaResource::collection($AreasState)->getDataResponse();
            return customResponse(200,$data);

    }
}