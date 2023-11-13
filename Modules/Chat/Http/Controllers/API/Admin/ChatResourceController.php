<?php

namespace Modules\Chat\Http\Controllers\API\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Chat\Http\Requests\StoreChatRequest;
use Modules\Chat\Http\Requests\UpdateChatRequest;
use Modules\Chat\Http\Requests\DeleteChatRequest;
use App\Repositories\EloquentRepository;
use Modules\Chat\Repositories\Admin\Resources\ChatRepository;
use Modules\Chat\Entities\Chat;
use GeneralTrait;
use Modules\Chat\Resources\Admin\ChatResource;

class ChatResourceController extends Controller
{
    use GeneralTrait;
    /**
     * @var EloquentRepository
     */
    protected $eloquentRepo;
    /**
     * @var ChatRepository
     */
    protected $chatRepo;
        /**
     * @var Chat
     */
    protected $chat;
    
    /**
     * ChatsController constructor.
     *
     * @param ChatRepository $chats
     */
    public function __construct(EloquentRepository $eloquentRepo, Chat $chat,ChatRepository $chatRepo)
    {
       $this->eloquentRepo = $eloquentRepo;
        $this->chat = $chat;
        $this->chatRepo = $chatRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $chats=$this->chatRepo->all($this->chat);
        if(page()) $data=getDataResponse(ChatResource::collection($chats));
        else $data=ChatResource::collection($chats);
        return successResponse(0,$data);
    }
    /**
     * Display a listing of the resource via pagintation from search.
     *
     * @return \Illuminate\Http\Response
     */
    public function search($words,$col=null){
        $chats=$this->chatRepo->search($this->chat,$words,$col);
        if(page()) $data=getDataResponse(ChatResource::collection($chats));
        else $data=ChatResource::collection($chats);
        return successResponse(0,$data);
    }
 /**
     * Display a listing of the resource (all , pagination) from trash.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash(){
        $chats=$this->chatRepo->trash($this->chat);
        if(is_numeric($chats)) return  clientError(4);
        if(page()) $data=getDataResponse(ChatResource::collection($chats));
        else $data=ChatResource::collection($chats);
        return successResponse(0,$data);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $chat=$this->chatRepo->show($id,$this->chat);
        if(is_numeric($chat)) return  clientError(4,$chat);
        return successResponse(0,new ChatResource($chat));
    }
    /**
     * Restore the specified resource in storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function restore($id){
        $chat =  $this->chatRepo->restore($id,$this->chat);
        if(is_numeric($chat)) return  clientError(4);
        return successResponse(5,new ChatResource($chat));
    }
    /**
     * Restore All.
     *
     * @return \Illuminate\Http\Response
     */
    public function restoreAll(){
        $chats =  $this->chatRepo->restoreAll($this->chat);
        if(is_numeric($chats)) return  clientError(4);
        return successResponse(5);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeleteChatRequest $request,$id)
    {
        $chat= $this->chatRepo->destroy($id,$this->chat);
        if(is_numeric($chat)) return  clientError(4);
        return successResponse(2,new ChatResource($chat));  
    }
    public function forceDelete(DeleteChatRequest $request,$id)
    {
        //to make force destroy for a chat must be this chat  not found in chats table  , must be found in trash Categories
        $chat=$this->chatRepo->forceDelete($id,$this->chat);
        if(is_numeric($chat)) return  clientError(4);
        return successResponse(4);
    }    

 

}
