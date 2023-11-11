<?php
namespace Modules\Payment\Entities\Traits\Admin;
use GeneralTrait;

trait PaymentMethods{
    //actions : store,update , store-trans
    public function actionMethod($data,$model,$id=null){
        $enteredData=exceptData($data,['image']);
        $payment=null;
        if($id){ //update , storetrans
            if(isset(getallheaders()['lang'])){//storetrans
                $lang = getallheaders()['lang'];
                if(!$lang)  $lang = localLang();
                $enteredData['translate_id']=$id;
                $enteredData['main_lang']=$lang;
                $payment = $model->create($enteredData);
            }elseif(request()->method()=="PUT"){//update
                $payment=$this->find($model,$id);
                if(is_numeric($payment)) return 404;
                else $payment->update($enteredData);
            }else return 404;
        }else{//store
            $payment=$model->create($enteredData);
        }
        if(!empty($data['image'])){
            $this->uploadImage($data,$payment,$model,'payments-images',$id);
        } 
        return $payment->load('image');
    }
}