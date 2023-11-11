<?php
namespace Modules\RequestWithdrawing\Entities\Traits;

trait RequestWithdrawingAttributes{
    //Accessories
    public function getStatusAttribute(){//0: reason cancelation , 1:reason reschualing
        if(isset($this->attributes['status']))  return  $this->attributes['status'];
    }
    public function getOriginalStatusAttribute(){
        if(isset($this->attributes['status'])) {
            $value=$this->attributes['status'];
            if($value==0){
                return trans('attributes.Not Review');
            }elseif($value==1){
                return trans('attributes.Reviewing');
            }elseif($value==2){
                return trans('attributes.Accepted');
            }elseif($value==-1){
                return trans('attributes.Rejected');
            }
        }
    }

}
