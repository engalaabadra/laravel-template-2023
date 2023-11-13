<?php
namespace Modules\Geocode\Repositories\API\Admin\State\Additional;

use App\Repositories\EloquentRepository;
use Modules\Geocode\Entities\State;
use Modules\Geocode\Repositories\API\Admin\State\Additional\StateRepositoryInterface;
use GeneralTrait;

class StateRepository extends EloquentRepository implements StateRepositoryInterface
{
    use GeneralTrait;
    public function getAreasState($model,$request,$stateId){
        $state=$this->find($stateId,$model);
        if(is_string($state)){
            return $state;
        }
        $AreasState = $state->areas()->withoutGlobalScope(ActiveScope::class)->withoutGlobalScope(LanguageScope::class)->paginate($request->total);
        return  $AreasState;
   }
}