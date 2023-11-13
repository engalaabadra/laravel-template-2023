<?php
namespace Modules\Banner\Entities\Traits;
use Modules\Auth\Entities\User;
use App\Models\Image;
trait BannerRelations{
    
    public function image(){
        return $this->morphOne(Image::class, 'imageable');
    }

}
