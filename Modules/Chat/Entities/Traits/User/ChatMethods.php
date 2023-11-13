<?php
namespace Modules\Chat\Entities\Traits\User;
use Modules\Auth\Entities\User;
use App\Events\MessageCreated;
use GeneralTrait;

trait ChatMethods{
    use GeneralTrait{
        GeneralTrait::getPaginatesData as getPaginatesDataMethod;
        GeneralTrait::paginatesData as paginatesDataMethod;
        GeneralTrait::action as actionMethod;
    }
        //get data//
    public function getPaginatesDataMethod($doctorId,$request, $model){
        if(isset(getallheaders()['lang']))  return $this->paginatesDataMethod($doctorId,$request, $model,$lang);
        else return $this->paginatesDataMethod($doctorId,$request, $model);
    }
    public function paginatesDataMethod($doctorId,$request, $model,$lang=null){
        if($lang && $result) return $model->withoutGlobalScope(ActiveScope::class)->where(['main_lang'=>$lang])->where(['user_id'=>authUser()->id,'doctor_id'=>$doctorId])->with(['doctor','user'])->paginate($request->total);
        else return $model->withoutGlobalScope(ActiveScope::class)->where(['user_id'=>authUser()->id,'doctor_id'=>$doctorId])->with(['doctor','user'])->paginate($request->total);
    }
    //get data -all- //
    public function getAllDataMethod($doctorId,$model){
        //check if this user make a chat with  a doctor
        $doctor = User::where('id',$doctorId)->first();
        if(is_string($doctor)) return 404;
        $rolesDoctor= $this->rolesUserByName($doctor);
        if(!in_array('doctor',$rolesDoctor)) return trans('messages.This is Not a doctor to see  all  chats with  his');
        
        if(isset(getallheaders()['lang']))  return $this->allDataMethod($model,getallheaders()['lang']);
        else return $this->allDataMethod($doctorId,$model);
    }
    public function allDataMethod($doctorId,$model,$lang=null){
        //check if this user make a chat with  a doctor
        $doctor = User::where('id',$doctorId)->first();
        if(is_string($doctor)) return 404;
        $rolesDoctor= $this->rolesUserByName($doctor);
        if(!in_array('doctor',$rolesDoctor)) return trans('messages.This is Not a doctor to see  all  chats with  his');
        
        $result=array_key_exists($lang, config('languages'));
        if($lang && $result) return $model->where(['user_id'=>authUser()->id,'doctor_id'=>$doctorId])->with(['doctor','user'])->where(['main_lang'=>$lang])->get();
        else return $model->where(['user_id'=>authUser()->id,'doctor_id'=>$doctorId])->with(['doctor','user'])->get();
    }

    //actions : store
    public function actionMethod($request,$model,$id=null){
        $data = $request->validated();    
        $user=authUser();
        //check if this user make a chat with  a doctor
        $doctor=User::where('id',$data['doctor_id'])->first();
        $rolesDoctor= $this->rolesUserByName($doctor);
        if(!in_array('doctor',$rolesDoctor)) return trans('messages.This is Not a doctor to make a  chat with  his');
        $data['user_id'] =  $user->id;
        $data['sender_id']=$user->id;
        $data['recipient_id']=$data['doctor_id'];
        $enteredData=exceptData($data,['image']);
        $item = $model->create($enteredData);
        broadcast(new MessageCreated($item))->toOthers();
        if(!empty($data['image'])){
            $this->uploadImage($request,$item,$model,'chats-images',$id);
        }
        return $item;
    }
//methods for deleting
public function deleteChatMethod($id,$model,$forceDelete){
    $item = $this->find($model,$id,'id');
    if(is_numeric($item)){
        return 404;
    }
    
        if($item->user_id !== authUser()->id) return trans('messages.This is message not for you to clear it');
        if($item->deleted_at!==null){
            //this item already deleted permenetly , so now can make force delete for it
            if($forceDelete==0) return trans('messages.this item already deleted permenetly');
            else $this->forceDeleteMethod($id,$model);
    
        }else{// can make normal delete
            $item->delete($item);
            return $item;
        }
    
    }
    public function deleteAllMethod($request,$model){  
        $data = $request->validated();
        //check if this   a doctor
        $doctor=User::where('id',$data['doctor_id'])->first();
        $rolesDoctor= $this->rolesUserByName($doctor);
        if(!in_array('doctor',$rolesDoctor)) return trans('messages.This is Not a doctor  to delete chat with herself');

         //delete all
        $chatUserDoctor = $model->where(['user_id'=>authUser()->id,'doctor_id'=>$data['doctor_id']])->truncate();
       
    }
}