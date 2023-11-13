<?php

namespace Modules\Auth\Http\Controllers\API\Admin\Role;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Auth\Http\Requests\Role\StoreRoleRequest;
use Modules\Auth\Http\Requests\Role\UpdateRoleRequest;
use Modules\Auth\Http\Requests\Role\DeleteRoleRequest;
use App\Repositories\EloquentRepository;
use Modules\Auth\Repositories\API\Admin\Role\Resources\RoleRepository;
use Modules\Auth\Entities\Role;
use GeneralTrait;
use Modules\Auth\Resources\Admin\RoleResource;

class RoleResourceController extends Controller
{
    use GeneralTrait;
    /**
     * @var EloquentRepository
     */
    protected $eloquentRepo;
    /**
     * @var RoleRepository
     */
    protected $roleRepo;
        /**
     * @var Role
     */
    protected $role;
    
    /**
     * RolesController constructor.
     *
     * @param RoleRepository $roles
     */
    public function __construct(EloquentRepository $eloquentRepo, Role $role,RoleRepository $roleRepo)
    {
       $this->eloquentRepo = $eloquentRepo;
        $this->role = $role;
        $this->roleRepo = $roleRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $roles=$this->roleRepo->all($request->total, $this->role);
        if(page()) $data=getDataResponse(RoleResource::collection($roles));
        else $data=RoleResource::collection($roles);
        return successResponse(0,$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRoleRequest $request)
    {
        $role=  $this->roleRepo->store($request->validated(),$this->role);
        if(is_string($role)) return  clientError(0,$role);
        return successResponse(1,new RoleResource($role));
    }

    /**
     * Display a listing of the resource via pagintation from search.
     *
     * @return \Illuminate\Http\Response
     */
    public function search($words,$col=null){
        $roles=$this->roleRepo->search($this->role,$words,$col);
        if(page()) $data=getDataResponse(RoleResource::collection($roles));
        else $data=RoleResource::collection($roles);
        return successResponse(0,$data);
    }
    /**
     * Display a listing of the resource (all , pagination) from trash.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash(){
        $roles=$this->roleRepo->trash($this->role);
        if(is_numeric($roles)) return  clientError(4);
        if(page()) $data=getDataResponse(RoleResource::collection($roles));
        else $data=RoleResource::collection($roles);
        return successResponse(0,$data);
    }

   
    public function storeTrans(StoreroleRequest $request,$id)
    {
        if(!is_numeric($id)) return clientError(0);
        $role=  $this->roleRepo->storeTrans($request->validated(),$this->role,$id);
        if(is_numeric($role)) return  clientError(4);
        return successResponse(1,new RoleResource($role));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role=$this->roleRepo->show($id,$this->role);
        if(is_numeric($role)) return  clientError(4,$role);
        return successResponse(0,new RoleResource($role));
    }

 

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateroleRequest $request,$id)
    {
        $role= $this->roleRepo->update($request->validated(),$this->role,$id);
        if(is_numeric($role)) return  clientError(4,$role);
        return successResponse(2,new RoleResource($role));
    }
    /**
     * Restore the specified resource in storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function restore($id){
        $role =  $this->roleRepo->restore($id,$this->role);
        if(is_numeric($role)) return  clientError(4);
        return successResponse(5,new RoleResource($role));
    }
    /**
     * Restore All.
     *
     * @return \Illuminate\Http\Response
     */
    public function restoreAll(){
        $roles =  $this->roleRepo->restoreAll($this->role);
        if(is_numeric($roles)) return  clientError(4);
        return successResponse(5);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeleteRoleRequest $request,$id)
    {
        $role= $this->roleRepo->destroy($id,$this->role);
        if(is_numeric($role)) return  clientError(4);
        return successResponse(2,new RoleResource($role));  
    }
    public function forceDelete(DeleteRoleRequest $request,$id)
    {
        //to make force destroy for a role must be this role  not found in roles table  , must be found in trash Categories
        $role=$this->roleRepo->forceDelete($id,$this->role);
        if(is_numeric($role)) return  clientError(4);
        return successResponse(4);
    }    
}
