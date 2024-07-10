<?php
    use Modules\Activity\Entities\Activity;
    function activity($model,$action){
        if(authUser()&&authUser()->id){
            $user=authUser();
            $nameClassModel=class_basename(get_class($model));
            Activity::insert(['user_id'=>$user->id,'name'=>$user->username." ".$action." ".$nameClassModel,'created_at'=>now()]);
        }
    }