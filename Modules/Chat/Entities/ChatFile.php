<?php

namespace Modules\Chat\Entities\Traits;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatFile extends Model
{
   /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'chat_id',
        'filename'
    ];
    public function Chat(){
        return $this->belongsTo("Modules\Chat\Entities\Chat");
    }
}
