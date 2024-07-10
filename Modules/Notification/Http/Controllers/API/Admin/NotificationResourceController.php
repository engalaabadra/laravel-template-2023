<?php

namespace Modules\Notification\Http\Controllers\API\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Notification\Http\Requests\StoreNotificationRequest;
use Modules\Notification\Http\Requests\UpdateNotificationRequest;
use Modules\Notification\Http\Requests\DeleteNotificationRequest;
use App\Repositories\EloquentRepository;
use Modules\Notification\Repositories\Admin\Resources\NotificationRepository;
use Modules\Notification\Entities\Notification;
use GeneralTrait;
use Modules\Notification\Resources\Admin\NotificationResource;

class NotificationResourceController extends Controller
{
    use GeneralTrait;
    /**
     * @var EloquentRepository
     */
    protected $eloquentRepo;
    /**
     * @var NotificationRepository
     */
    protected $notificationRepo;
        /**
     * @var Notification
     */
    protected $notification;
    
    /**
     * NotificationsController constructor.
     *
     * @param NotificationRepository $notifications
     */
    public function __construct(EloquentRepository $eloquentRepo, Notification $notification,NotificationRepository $notificationRepo)
    {
       $this->eloquentRepo = $eloquentRepo;
        $this->notification = $notification;
        $this->notificationRepo = $notificationRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $notifications=$this->notificationRepo->all($this->notification);
        if(page()) $data=getDataResponse(NotificationResource::collection($notifications));
        else $data=NotificationResource::collection($notifications);
        return successResponse(0,$data);
    }
     /**
     * Display a listing of the resource via pagintation from search.
     *
     * @return \Illuminate\Http\Response
     */
    public function search($words,$col=null){
        $notifications=$this->notificationRepo->search($this->notification,$words,$col);
        if(page()) $data=getDataResponse(NotificationResource::collection($notifications));
        else $data=NotificationResource::collection($notifications);
        return successResponse(0,$data);
    }
 /**
     * Display a listing of the resource (all , pagination) from trash.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash(){
        $notifications=$this->notificationRepo->trash($this->notification);
        if(is_numeric($notifications)) return  clientError(4);
        if(page()) $data=getDataResponse(NotificationResource::collection($notifications));
        else $data=NotificationResource::collection($notifications);
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
        $notification=$this->notificationRepo->show($id,$this->notification);
        if(is_numeric($notification)) return  clientError(4,$notification);
        return successResponse(0,new NotificationResource($notification));
    }
    /**
     * Restore the specified resource in storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function restore($id){
        $notification =  $this->notificationRepo->restore($id,$this->notification);
        if(is_numeric($notification)) return  clientError(4);
        return successResponse(5,new NotificationResource($notification));
    }
    /**
     * Restore All.
     *
     * @return \Illuminate\Http\Response
     */
    public function restoreAll(){
        $notifications =  $this->notificationRepo->restoreAll($this->notification);
        if(is_numeric($notifications)) return  clientError(4);
        return successResponse(5);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeleteNotificationRequest $request,$id)
    {
        $notification= $this->notificationRepo->destroy($id,$this->notification);
        if(is_numeric($notification)) return  clientError(4);
        return successResponse(2,new NotificationResource($notification));  
    }
    public function forceDelete(DeleteNotificationRequest $request,$id)
    {
        //to make force destroy for a notification must be this notification  not found in notifications table  , must be found in trash Categories
        $notification=$this->notificationRepo->forceDelete($id,$this->notification);
        if(is_numeric($notification)) return  clientError(4);
        return successResponse(4);
    } 
}
