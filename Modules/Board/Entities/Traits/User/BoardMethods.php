<?php
namespace Modules\Board\Entities\Traits\User;
use GeneralTrait;

trait BoardMethods{
 //get data -paginates-//
    public function getPaginatesDataMethod($request, $model){
        if(isset(getallheaders()['lang']))  return $this->paginatesDataMethod($request, $model,getallheaders()['lang']);
        else return $this->paginatesDataMethod($request, $model);
    }
    public function paginatesDataMethod($request, $model,$lang=null){
        if(!$lang) $lang=localLang();
        return $model->where(['main_lang'=>$lang])->with(['image'])->paginate($request->total);
    }
    //get data -all- //
    public function getAllDataMethod($model){
        if(isset(getallheaders()['lang']))  return $this->allDataMethod($model,getallheaders()['lang']);
        else return $this->allDataMethod($model);
    }
    public function allDataMethod($model,$lang=null){
        if(!$lang) $lang=localLang();
        return $model->where(['main_lang'=>$lang])->with(['image'])->get();
    }
    //
    public function actionMethod($request,$model,$id=null){
        $data=$request->validated();
        $enteredData=exceptData($data,['image']);
        
        $board=null;
        if($id){ //update , storetrans
            if(isset(getallheaders()['lang'])){//storetrans
                $enteredData['translate_id']=$id;
                $enteredData['main_lang']=getallheaders()['lang'];
                $board=$this->createUser($model,$enteredData);
              //  activity($model,'StoreTranslation');

            }else{//update
                $board=$this->find($model,$id,'id');
                if(is_numeric($board)){
                    return $board;
                }
                $board->update($enteredData);
                if(!empty($data['image'])){
                    $this->uploadImage($request,$board,$model,'boards-images',$id);
                }
                //activity($model,'Update');
            }
        }else{//store
            $board=$model->create($enteredData);
            if(!empty($data['image'])){
                $this->uploadImage($request,$board,$model,'boards-images');
            }  
            //activity($model,'Store');

        }     
        return $board;
    }
}