<?php
namespace Modules\Board\Entities\Traits\Admin;
use GeneralTrait;

trait BoardMethods{
    //search
    public function searchMethod($model,$words,$col=null){
        if(!$col) $col = 'description';
        $modelData = $model->where(function ($query) use ($words,$col) {
                        $query->where($col, 'like', '%' . $words . '%');
                    })->get();
        return  $modelData;
    }
     //actions : store,update , store-trans
     public function actionMethod($data,$model,$id=null){
        $enteredData=exceptData($data,['image']);
        $board=null;
        if($id){ //update , storetrans
            if(isset(getallheaders()['lang'])){//storetrans
                $lang = getallheaders()['lang'];
                if(!$lang)  $lang = localLang();
                $enteredData['translate_id']=$id;
                $enteredData['main_lang']=$lang;
                $board = $model->create($enteredData);
            }elseif(request()->method()=="PUT"){//update
                $board=$this->find($model,$id);
                if(is_numeric($board)) return 404;
                else $board->update($enteredData);
            }else return 404;
        }else{//store
            $board=$model->create($enteredData);
        }
        if(!empty($data['image'])){
            $this->uploadImage($data,$board,$model,'boards-images',$id);
        } 
        return $board->load('image');
    }
}