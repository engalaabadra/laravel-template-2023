<?php

namespace Modules\Auth\Http\Controllers\API\Admin\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Auth\Http\Requests\User\StoreUserRequest;
use Modules\Auth\Http\Requests\User\UpdateUserRequest;
use Modules\Auth\Http\Requests\User\DeleteUserRequest;
use App\Repositories\EloquentRepository;
use Modules\Auth\Repositories\API\Admin\User\Resources\UserRepository;
use Modules\Auth\Entities\User;
use GeneralTrait;
use Modules\Auth\Resources\Admin\UserResource;

class UserResourceController extends Controller
{
    use GeneralTrait;
    /**
     * @var EloquentRepository
     */
    protected $eloquentRepo;
    /**
     * @var UserRepository
     */
    protected $userRepo;
        /**
     * @var User
     */
    protected $user;
    
    /**
     * UsersController constructor.
     *
     * @param UserRepository $users
     */
    public function __construct(EloquentRepository $eloquentRepo, User $user,UserRepository $userRepo)
    {
       $this->eloquentRepo = $eloquentRepo;
        $this->user = $user;
        $this->userRepo = $userRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $users=$this->userRepo->all($request->total, $this->user);
        if(page()) $data=getDataResponse(UserResource::collection($users));
        else $data=UserResource::collection($users);
        return successResponse(0,$data);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $user=  $this->userRepo->store($request->validated(),$this->user);
        if(is_string($user)) return  clientError(0,$user);
        return successResponse(1,new UserResource($user));
    }

    /**
     * Display a listing of the resource via pagintation from search.
     *
     * @return \Illuminate\Http\Response
     */
    public function search($words,$col=null){
        $users=$this->userRepo->search($this->user,$words,$col);
        if(page()) $data=getDataResponse(UserResource::collection($users));
        else $data=UserResource::collection($users);
        return successResponse(0,$data);
    }
    /**
     * Display a listing of the resource (all , pagination) from trash.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash(){
        $users=$this->userRepo->trash($this->user);
        if(is_numeric($users)) return  clientError(4);
        if(page()) $data=getDataResponse(UserResource::collection($users));
        else $data=UserResource::collection($users);
        return successResponse(0,$data);
    }

   
    public function storeTrans(StoreuserRequest $request,$id)
    {
        if(!is_numeric($id)) return clientError(0);
        $user=  $this->userRepo->storeTrans($request->validated(),$this->user,$id);
        if(is_numeric($user)) return  clientError(4);
        return successResponse(1,new UserResource($user));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user=$this->userRepo->show($id,$this->user);
        if(is_numeric($user)) return  clientError(4,$user);
        return successResponse(0,new UserResource($user));
    }

 

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request,$id)
    {
        $user= $this->userRepo->update($request->validated(),$this->user,$id);
        if(is_numeric($user)) return  clientError(4,$user);
        return successResponse(2,new UserResource($user));
    }
    /**
     * Restore the specified resource in storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function restore($id){
        $user =  $this->userRepo->restore($id,$this->user);
        if(is_numeric($user)) return  clientError(4);
        return successResponse(5,new UserResource($user));
    }
    /**
     * Restore All.
     *
     * @return \Illuminate\Http\Response
     */
    public function restoreAll(){
        $users =  $this->userRepo->restoreAll($this->user);
        if(is_numeric($users)) return  clientError(4);
        return successResponse(5);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeleteUserRequest $request,$id)
    {
        $user= $this->userRepo->destroy($id,$this->user);
        if(is_numeric($user)) return  clientError(4);
        return successResponse(2,new UserResource($user));  
    }
    public function forceDelete(DeleteUserRequest $request,$id)
    {
        //to make force destroy for a user must be this user  not found in users table  , must be found in trash Categories
        $user=$this->userRepo->forceDelete($id,$this->user);
        if(is_numeric($user)) return  clientError(4);
        return successResponse(4);
    }    
}
