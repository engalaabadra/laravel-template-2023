<?php
namespace Modules\Geocode\Repositories\API\Admin\State\Additional;

interface StateRepositoryInterface
{
    public function getAreasState($model,$request,$stateId);
   
}
