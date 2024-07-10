<?php
namespace Modules\Payment\Entities\Traits;
use Modules\Day\Entities\Day;
use App\Models\Image;
trait PaymentRelations{
    public function image(){
        return $this->morphOne(Image::class, 'imageable');
    }
}
