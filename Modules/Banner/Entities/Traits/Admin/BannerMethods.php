<?php
namespace Modules\Banner\Entities\Traits\Admin;
use GeneralTrait;
use Modules\Auth\Entities\User;
trait BannerMethods{
    use GeneralTrait;
    //actions : store,update , store-trans
    public function actionMethod($data,$model,$id=null){
        $enteredData=exceptData($data,['image']);
        $banner=null;
        if($id){ //update , storetrans
            if(isset(getallheaders()['lang'])){//storetrans
                $lang = getallheaders()['lang'];
                if(!$lang)  $lang = localLang();
                $enteredData['translate_id']=$id;
                $enteredData['main_lang']=$lang;
                $banner = $model->create($enteredData);
            }elseif(request()->method()=="PUT"){//update
                $banner=$this->find($model,$id);
                if(is_numeric($banner)) return 404;
                else $banner->update($enteredData);
            }else return 404;
        }else{//store
            $banner=$model->create($enteredData);
        }
        if(!empty($data['image'])){
            $this->uploadImage($data,$banner,$model,'banners-images',$id);
        } 
        return $banner->load('image');
    }

}