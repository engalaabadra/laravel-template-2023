<?php
namespace Modules\Chat\Repositories\User\Resources;

use App\Repositories\EloquentRepository;
use Modules\Chat\Repositories\User\Resources\ChatRepositoryInterface;
use Modules\Chat\Entities\Traits\User\ChatMethods;
use GeneralTrait;

class ChatRepository extends EloquentRepository implements ChatRepositoryInterface
{
    use GeneralTrait,ChatMethods;
    public function getAllChatsUserDoctor($doctorId,$request, $model){
        if(page()) return $this->getPaginatesDataMethod($doctorId,$request, $model);
        else return $this->getAllDataMethod($doctorId,$model);
    }
    public function store($request,$model){
        $user = $this->actionMethod($request,$model);
        return $user;
    }
    //methods for deleting
    public function destroy($id,$model){
        $forceDelete=0;
        return $this->deleteChatMethod($id,$model,$forceDelete);
    }

    public function deleteAll($request,$model){
        return $this->deleteAllMethod($request,$model);
    }
}
