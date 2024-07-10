<?php
namespace Modules\Notification\Repositories\User;

use App\Repositories\EloquentRepository;
use Modules\Notification\Repositories\User\NotificationRepositoryInterface;
use Modules\Notification\Entities\Traits\NotificationMethods;
use GeneralTrait;

class NotificationRepository extends EloquentRepository implements NotificationRepositoryInterface
{
    use NotificationMethods,GeneralTrait;
    
    public function all($request, $model){
        if(page()) return $this->getPaginatesDataMethod($request, $model);
        else return $this->getAllDataMethod($model);
    }

}
