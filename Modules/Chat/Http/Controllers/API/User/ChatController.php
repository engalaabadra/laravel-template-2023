<?php

namespace Modules\Chat\Http\Controllers\API\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Chat\Entities\Chat;
use Modules\Reservation\Entities\Reservation;
use GeneralTrait;
use Modules\Chat\Resources\User\ChatResource;
use Modules\Chat\Http\Requests\User\StoreFilesChatRequest;

class ChatController extends Controller
{
    use GeneralTrait;
        /**
     * @var Chat
     */
    protected $chat;
    /**
     * @var Reservation
     */
    protected $reservation;
    
    /**
     * ChatController constructor.
     *
     * @param ChatRepository $chats
     */
    public function __construct( Chat $chat,Reservation $reservation)
    {
        $this->chat = $chat;
        $this->reservation = $reservation;
    }
    
    public function storeFiles(StoreFilesChatRequest $request,$id){
        $chat=$this->uploadFiles($request,$this->reservation,'chats-files',$id);
        if(is_numeric($chat)) return clientError(4);
        return successResponse(1,$chat);
    }
}
