<?php

namespace Modules\Profile\Http\Controllers\API\User;

 
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Auth\Entities\User;
use Modules\Profile\Entities\Profile;
use Modules\Profile\Http\Requests\User\UpdateProfileRequest;
use Modules\Profile\Repositories\User\ProfileRepository;
use  Modules\Profile\Http\Requests\UpdatePasswordRequest;
use GeneralTrait;
use Modules\Profile\Resources\UserResource;
use Modules\Profile\Resources\DoctorResource;

class ProfileController extends Controller
{
    use GeneralTrait;

     /**
     * @var ProfileRepository
     */
    protected $profileRepo;
    /**
     * @var User
     */
    protected $user;
    /**
     * @var Profile
     */
    protected $profile;
    
    /**
     * ProfileController constructor.
     *
     * @param ProfileRepository $Profile
     */
    public function __construct(  ProfileRepository $profileRepo, User $user, Profile $profile)
    {
         
        $this->profileRepo = $profileRepo;
        $this->user = $user;
        $this->profile = $profile;
    }


    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id=null)
    {
        $data=  $this->profileRepo->show($this->user,$id);
        if(is_numeric($data)) return  clientError(4);
        if(is_string($data)) return  clientError(0,$data);
        $rolesUser = $this->rolesUserByName($data);
        if(in_array('doctor',$rolesUser)) return successResponse(0,new DoctorResource($data->load(['image','profile','reviewsDoctor.user'])));//will show user page not doctor page
        return successResponse(0,new UserResource($data->load(['image'])));

    }


    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(UpdateProfileRequest $request)
    {   
        $userId=authUser()->id;
        $user=$this->find($this->user,$userId,'id');
        if(is_numeric($user)) return clientError(4);
        $userUpdated=  $this->profileRepo->update($request,$this->profile,$user);
        return successResponse(2,new UserResource($userUpdated->load('image')));       
    }
    
    public function updatePassword(UpdatePasswordRequest $request){
        $userId=authUser()->id;
        $userUpdatedPassword=  $this->profileRepo->updatePassword($request,$this->user);
        if(is_string($userUpdatedPassword)){
            return clientError(0,$userUpdatedPassword);
        }
        return successResponse(2,new UserResource($userUpdatedPassword->load('image')));       

    }


}
