<?php
namespace Modules\Chat\Entities\Traits;
use Modules\Day\Entities\Day;
use App\Models\Image;
use Modules\Auth\Entities\User;
use Modules\Chat\Entities\Traits\Relations\ChatFile;

trait ChatRelations{
    public function image(){
        return $this->morphOne(Image::class, 'imageable');
    }
    
    public function files(){
        return $this->hasMany(ChatFile::class);
    }

    public function doctor(){
        return $this->belongsTo(User::class,'doctor_id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }



}
