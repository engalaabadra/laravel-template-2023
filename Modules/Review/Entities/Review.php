<?php

namespace Modules\Review\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use GeneralTrait;
use Modules\Review\Entities\Traits\GeneralReviewTrait;

class Review extends Model
{
    use GeneralTrait,GeneralReviewTrait,SoftDeletes;
    public $guarded = [];

}
