<?php
namespace App\Traits;
use Modules\Auth\Entities\User;
use App\Providers\RouteServiceProvider;

trait GeneralAttributesTrait{
    //Accessories
    public function getActiveAttribute(){
        if(isset($this->attributes['active'])) return  $this->attributes['active'];
    }
    public function getOriginalActiveAttribute(){
        if(isset($this->attributes['active'])){
            $value=$this->attributes['active'];
            if($value==0){
                return trans('attributes.Not Active');
            }elseif ($value==1) {
                return trans('attributes.Active');
            }
            
        }
    }

    
    //mutators

    
}
