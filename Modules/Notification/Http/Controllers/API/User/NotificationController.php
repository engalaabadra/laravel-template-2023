<?php

namespace Modules\Notification\Http\Controllers\API\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Notification\Repositories\User\NotificationRepository;
use Modules\Notification\Entities\Notification;
use GeneralTrait;
use App\Traits\GeneralMethodsTrait;
use Modules\Notification\Resources\User\NotificationResource;
use Modules\Notification\Http\Requests\UpdateFcmRequest;
use Modules\Notification\Http\Requests\SendNotificationRequest;
use SendingNotificationsService;

class NotificationController extends Controller
{
    use GeneralTrait,GeneralMethodsTrait;
    /**
     * @var NotificationRepository
     */
    protected $notificationRepo;
        /**
     * @var Notification
     */
    protected $notification;
    
    /**
     * NotificationController constructor.
     *
     * @param NotificationRepository $notifications
     */
    public function __construct( Notification $notification,NotificationRepository $notificationRepo)
    {
        $this->notification = $notification;
        $this->notificationRepo = $notificationRepo;
    }
    /**
     * Display a listing of the resource via (all , pagination).
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $notifications=$this->notificationRepo->all($request, $this->notification);
        if(page()) $data = getDataResponse(NotificationResource::collection($notifications));
        else $data = NotificationResource::collection($notifications);
        return successResponse(0,$data);
    }
    public function updateFcm(UpdateFcmRequest $request){
        $user=$this->updateFcmMethod($request);
        return successResponse(2,$user);
    }
    public function sendNotificationMethod(SendNotificationRequest $request,$userId){
        $data=$request->validated();
        $notification=app(SendingNotificationsService::class)->sendNotification($data,$userId,$type=null);
        if(is_numeric($notification)) return clientError(4);
        return successResponse(2,$notification);
    }
}

