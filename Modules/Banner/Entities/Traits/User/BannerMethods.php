<?php
namespace Modules\Banner\Entities\Traits\User;
use GeneralTrait;
use Modules\Auth\Entities\User;
trait BannerMethods{
    use GeneralTrait;
 //get data -paginates-//
 public function getPaginatesDataMethod($request, $model){
    if(isset(getallheaders()['lang']))  return $this->paginatesDataMethod($request, $model,getallheaders()['lang']);
    else return $this->paginatesDataMethod($request, $model,localLang());
    }
    public function paginatesDataMethod($request, $model,$lang=null){
        return $model->withoutGlobalScope(ActiveScope::class)->where(['main_lang'=>$lang])->with(['image'])->paginate($request->total);
    }
    //get data -all- //
    public function getAllDataMethod($model){
    if(isset(getallheaders()['lang']))  return $this->allDataMethod($model,getallheaders()['lang']);
        else return $this->allDataMethod($model,localLang());
    }
    public function allDataMethod($model,$lang=null){
        return $model->with(['image'])->where(['main_lang'=>$lang])->get();
    }

    //actions : store,update , store-trans
    public function actionMethod($request,$model,$id=null){
        $data=$request->validated();
        $enteredData=exceptData($data,['image']);
        
        $banner=null;
        if($id){ //update , storetrans
            if(isset(getallheaders()['lang'])){//storetrans
                $enteredData['translate_id']=$id;
                $enteredData['main_lang']=getallheaders()['lang'];
                $banner=$this->createUser($model,$enteredData);
              //  activity($model,'StoreTranslation');

            }else{//update
                $banner=$this->find($model,$id,'id');
                if(is_numeric($banner)){
                    return $banner;
                }
                $banner->update($enteredData);
                if(!empty($data['image'])){
                    $this->uploadImage($request,$banner,$model,'banners-images',$id);
                }
                //activity($model,'Update');
            }
        }else{//store
            $banner=$model->create($enteredData);
            if(!empty($data['image'])){
                $this->uploadImage($request,$banner,$model,'banners-images');
            }  
            //activity($model,'Store');

        }     
        return $banner;
    }

}