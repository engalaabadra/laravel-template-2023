<?php

namespace Modules\Chat\Http\Controllers\API\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Chat\Repositories\User\Resources\ChatRepository;
use Modules\Chat\Entities\Chat;
use GeneralTrait;
use Modules\Chat\Resources\User\ChatResource;
use Modules\Chat\Http\Requests\User\AddChatRequest;
use Modules\Chat\Http\Requests\User\DeleteChatRequest;
use Modules\Chat\Http\Requests\User\DeleteAllChatsRequest;
use Pusher;
use Illuminate\Support\Facades\Broadcast;



use Agora\Agora;
use Agora\AgoraRtcSdk\AgoraRtcTokenBuilder;
use Agora\AgoraRtcSdk\IAgoraRtcEngine;
use Agora\AgoraRtcSdk\IAgoraRtcEngineEventHandler;
use AgoraIO\AgoraToken\RtcTokenBuilder;
use Modules\Chat\Traits\RtmTokenBuilder;
use Agora\AgoraRtcSdk\RtcChannel;
//require_once 'vendor/autoload.php'; // Include the Agora SDK for PHP

class ChatResourceController extends Controller
{
    use GeneralTrait;
    /**
     * @var RtmTokenBuilder
     */
    protected $RtmTokenBuilder;
    /**
     * @var ChatRepository
     */
    protected $chatRepo;
        /**
     * @var Chat
     */
    protected $chat;
    
    /**
     * ChatController constructor.
     *
     * @param ChatRepository $chats
     */
    public function __construct( Chat $chat,ChatRepository $chatRepo,RtmTokenBuilder $RtmTokenBuilder)
    {
        $this->chat = $chat;
        $this->chatRepo = $chatRepo;
        $this->RtmTokenBuilder = $RtmTokenBuilder;
    }
    public function getRtcToken(Request $request){
        $agora = new Agora(config('agora.app_id'), config('agora.app_certificate'));

        // Generate a user ID and token
        $user_id = uniqid();
        $token = $agora->generateAccessToken('your_channel_name', $user_id);
        
        // Create the channel
        $agora->createChannel($token, 'your_channel_name', $user_id);
        // dd($)
// $appId = YOUR_APP_ID; // Replace YOUR_APP_ID with your Agora App ID
// $appCertificate = YOUR_APP_CERTIFICATE; // Replace YOUR_APP_CERTIFICATE with your Agora App Certificate

$agora = new Agora($appId, $appCertificate);

$channelName = 'your-channel-name'; // Replace your-channel-name with the name of the channel you want to create

$uid = 0; // The user ID of the client that's joining the channel. Set to 0 for now, but you can replace it with your own user ID implementation later.

$token = $agora->generateAccessToken($channelName, $uid); // Generate a token for the client to join the channel

$channelKey = ''; // You can leave this empty for now, as it's only used for channels that require an additional security layer.

$channelId = $agora->createChannel($channelName, $uid, $token, $channelKey); // Create the channel and get the channel ID

dd("Channel created with ID: " . $channelId) ;


        $appId = config('services.agora.app_id');
        $appCertificate = config('services.agora.app_certificate');
        $uid=0;
        $user = authUser();
        $expireTimeSeconds = 7200;
        $token = $this->RtmTokenBuilder->buildToken($appId, $appCertificate, $user, $expireTimeSeconds);
        if(!empty($token)) return successResponse(0,$token);
        return clientResponse(0,$token);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function allChatsUserDoctor($doctorId,Request $request){
        $chats=$this->chatRepo->getAllChatsUserDoctor($doctorId,$request, $this->chat);
        if(is_string($chats)) return clientError(0,$chats);
        if(page()) $data=getDataResponse(ChatResource::collection($chats));
        else $data=ChatResource::collection($chats);
        return successResponse(0,$data);
    }
    /**
     * store.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(AddChatRequest $request){
        
        // $pusher = new Pusher\Pusher(
        //     env('PUSHER_APP_KEY'),
        //     env('PUSHER_APP_SECRET'),
        //     env('PUSHER_APP_ID'),
        //     [
        //         'cluster' => env('PUSHER_APP_CLUSTER'),
        //         'useTLS' => true
        //     ]
        // );
        // dd($pusher);
        // $pusher = app('pusher');
        // $socket_id = $pusher->socket_id;
        $chat=$this->chatRepo->store($request,$this->chat);
        if(is_string($chat)) return clientError(0,$chat);
        if(is_numeric($chat)) return clientError(4);
        return successResponse(1,new ChatResource($chat));
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
        if(is_numeric($chat)) return  clientError(4,$chat);
        if(is_string($chat)) return clientError(0,$chat);
        return successResponse(2,new ChatResource($chat));  
    }

    /**
     * Delete All the specified resource from storage.
     *
     * @param  int  $doctorId
     * @return \Illuminate\Http\Response
     */
    public function deleteAll(DeleteAllChatsRequest $request)
    {
        $chats= $this->chatRepo->deleteAll($request,$this->chat);
        if(is_string($chats)) return  clientError(0,$chats);
        return successResponse(2,$chats);  
    }



}
