<?php
namespace Modules\Notification\Repositories\Admin\Resources;

use App\Repositories\EloquentRepository;
use Modules\Notification\Repositories\Admin\Resources\NotificationRepositoryInterface;
use Modules\Notification\Entities\Traits\Admin\NotificationMethods;

class NotificationRepository extends EloquentRepository implements NotificationRepositoryInterface
{
    use NotificationMethods;
}
