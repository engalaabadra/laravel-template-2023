<?php
namespace Modules\Chat\Repositories\Admin\Resources;

use App\Repositories\EloquentRepository;
use Modules\Chat\Repositories\Admin\Resources\ChatRepositoryInterface;
use Modules\Chat\Entities\Traits\Admin\ChatMethods;
use GeneralTrait;

class ChatRepository extends EloquentRepository implements ChatRepositoryInterface
{
    use GeneralTrait,ChatMethods;

}
