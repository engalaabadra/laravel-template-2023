<?php
namespace Modules\Board\Entities\Traits;
use App\Models\Image;

trait BoardRelations{
    public function image(){
        return $this->morphOne(Image::class, 'imageable');
    }
}
