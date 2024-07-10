<?php
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

    function customResponse( $status_code,$data = [],$message=null)
    {
        
        $status=false;
        if($status_code==200||$status_code==201||$status_code==205||$status_code==202){
            $status=true;
        }else{
            $status=false;
        }
        if($status_code==201||$status_code==205||$status_code==202||$status_code==204){
            $message=trans('messages.Successfully Done');
        }elseif($status_code==500){
            $message=trans('messages.Something went wrong');
        }elseif($status_code==310){
            $message=trans('messages.Email Not Verify');
        }elseif($status_code==401){
            $message=trans('messages.Un Authorized');
        }elseif($status_code==403){
            $message=trans('messages.User does not have the necessary access rights');
        }elseif($status_code==404&&$message==null){
            $message=trans('messages.Not Found');
        }elseif(($status_code==404&&$message!==null)||$status_code==400){
            $message=$message;
        }
        return response()->json([
                'status'=>$status,
                'message'=>$message,
                'data'=>$data
            ],$status_code);
    }

    function successResponse($num,$data=null,$message=null){
        return customResponse('20'.$num,$data,$message);
    }
    function clientError($num,$string=null){
        // dd(customResponse('40'.$num,[],$string));
        return customResponse('40'.$num,[],$string);
    }
    function serverError($num){
        return customResponse('50'.$num);
    }



    function getDataResponse($dataCollection){
        return $dataCollection->response()->getData(true);
    }

    
    function paginate($items, $perPage = 5, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }