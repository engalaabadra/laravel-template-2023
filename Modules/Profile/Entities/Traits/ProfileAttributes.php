<?php
namespace Modules\Profile\Entities\Traits;

trait ProfileAttributes{
    //Accessories
 
    public function getGenderAttribute(){
        if(isset($this->attributes['gender']))  return  intval($this->attributes['gender']);
    }
    public function getOriginalGenderAttribute(){
        if(isset($this->attributes['gender'])) {
            $value=$this->attributes['gender'];
            if($value==0){
                return trans('attributes.Male');
            }elseif ($value==1) {
                return trans('attributes.Female');
            }
        }
    }

}
