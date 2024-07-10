<?php
namespace Modules\Notification\Entities\Traits;
use Modules\Auth\Entities\User;
use App\Models\Image;
trait NotificationRelations{
    
    public function image(){
        return $this->morphOne(Image::class, 'imageable');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
