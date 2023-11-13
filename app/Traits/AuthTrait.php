<?php
namespace App\Traits;
use App\Services\VonageCheckValidateNumber;
use App\Traits\EloquentTrait;
use Modules\Auth\Entities\User;
use Modules\Auth\Entities\Role;
use Modules\Geocode\Entities\Country;

trait AuthTrait{
    use EloquentTrait;
    /**
     * @var Role
     */
    protected $role;

    /**
     * Check if the user have the correct Credentials.
     *
     * @return object
     */
     public function checkEmailPhone($request){
         $user=$request->has('email')  ? $this->checkEmail($request) : null;
        if(empty($user)){
            $user=$request->has('phone_no')  ? $this->checkPhoneNo($request) : null;
        }
        return $user;

     }
    public function checkEmail($request){
        $user = User::where('email', $request->get('email'))->first();
        if(!$user) return trans('messages.Invalid credentials');
        return $user;
    }

    public function checkPhoneNo($request){
        $user = User::where('phone_no', $request->get('phone_no'))->first();
        if(!$user) return trans('messages.Invalid credentials');
        if($user->country_id != $request->get('country_id')) return trans('messages.your country is wrong , pls enter correct your country');
        return $user;
    }
    
    public function validatePhoneNo($phone,$country_id){
        $phone_no = fullNumber($phone,$country_id);
        $respone = app(VonageCheckValidateNumber::class)->checkPhoneNumberValidity($phone_no);
        if ($respone['message'])
        {
            return [
                'phone_no'=>$phone_no,
                'message' =>$respone['message'],
                ];
        }
        return $respone;

    }
   

    public function rolesUserByName($user){
        if(authUser()&&authUser()->id){
            $rolesUser= $user->roles->pluck('name')->toArray();
            return  $rolesUser;
        }
    }
    public function rolesUserByNameModel($model,$userId){
        if(authUser()&&authUser()->id){
            $user= $model->find($userId);//model->user
            $rolesUser= $user->roles()->get();
            return  $rolesUser;
        }
    }
    public function rolesUser($user){
        if(authUser()&&authUser()->id){
            $rolesUser= $user->roles->pluck('id')->toArray();
            return $rolesUser;
        }
    }
    public function usersRole($nameRole){
         $role=$this->find(Role::class,$nameRole,'name');
        //  $usersRole=$role->users->pluck('full_name')->toArray();
         $usersRole=$role->users;
         return $usersRole;
     }
     public function usersRoleRetrive($nameRole){
        $role=$this->find(Role::class,$nameRole,'name');
         $usersRole=$role->users();
         return $usersRole;
     }
    public function rolesPermission($permission){
        $rolesPermission= $permission->roles->pluck('id')->toArray();
        return $rolesPermission;
    }
        public function rolesPermissionByName($model,$permissionId){
           $permission= $model->find($permissionId);
        $rolesPermission= $permission->roles()->get();
        return $rolesPermission;
    }


    public function redirectTo(){
        if(authUser()&&authUser()->id){
            $user=User::find(authUser()->id);
            $rolesUser= $user->roles->pluck('name')->toArray();
            $existRolesuperadmin=  in_array('superadmin',$rolesUser);
            if ( $existRolesuperadmin==true) {
                return route(dashboard());
            }else{
                return route(home());
            }
        }
    }

    public function authorizeRole($roles){
        if(authUser()&&authUser()->id){
            $rolesUser=$this->rolesUserByName(authUser());
            $existRole=  array_diff($roles,$rolesUser);
            if($existRole==[]){
                return true;
            }else{
                return false;
            }
        }
    }
    
    public function checkIsUser($id){
        $user = User::where('id',$id)->first();
        if(!$user) return 404;
        $rolesuser= $user->roles->pluck('name')->toArray();
        if(in_array('user',$rolesuser)) return true;
        else return false;

    }


}

