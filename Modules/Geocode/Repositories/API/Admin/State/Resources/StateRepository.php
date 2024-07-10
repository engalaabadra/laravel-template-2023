<?php
namespace Modules\Geocode\Repositories\API\Admin\State\Resources;

use App\Repositories\EloquentRepository;
use Modules\Geocode\Entities\City;
use Modules\Geocode\Entities\State;
use Modules\Geocode\Repositories\API\Admin\State\Resources\StateRepositoryInterface;
use App\Scopes\ActiveScope;

class StateRepository extends EloquentRepository implements StateRepositoryInterface
{
    public function citystate($model,$stateId){
        $state=$model->where(['id'=>$stateId])->first();
        if(empty($state)){
            return trans('messages.this item not exist in system');
        }
        $cityState= $state->city;
        return $cityState;
    }
    public function getStatesCity($model,$cityId){
        $city=$model->where(['id'=>$cityId])->first();
        if(empty($city)){
            return trans('messages.this item not exist in system');
        }
        $statesCity= $city->states->all();
        return $statesCity;
    }



}
