<?php
    function validation_messages( $status_code,$data = [],$message=null)
    {
        $status=false;
        if($status_code==200||$status_code==201||$status_code==205||$status_code==202){
            $status=true;
        }else{
            $status=false;
        }
        if($status_code==201||$status_code==205||$status_code==202){
            $message=trans('messages.Operation has been successfully');
        }elseif($status_code==500){
            $message=trans('messages.Something went wrong');
        }elseif($status_code==310){
            $message=trans('messages.Email Not Verify');
        }elseif($status_code==401){
            $message=trans('messages.Un Authorized');
        }elseif($status_code==403){
            $message=trans('messages.User does not have the necessary access rights');
        }elseif($status_code==400){
            $message=$message;
        }
        return response()->json([
                'status'=>$status,
                'message'=>$message,
                'data'=>$data
            ],$status_code);
    }

    function getDataResponse($dataResource){
        return $dataResource->getDataResponse();
    }