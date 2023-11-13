<?php
namespace App\Traits;
use Illuminate\Http\Request;

trait HandlerTrait{
    public function exceptions(){
        $this->reportable(function(\Exception $generalErr){
            return customResponse(500);
        });
    }
}
