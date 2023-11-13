<?php
namespace Modules\Contact\Repositories\Admin\Resources;

use App\Repositories\EloquentRepository;
use Modules\Contact\Repositories\Admin\Resources\ContactRepositoryInterface;
use Modules\Contact\Entities\Traits\GeneralContactTrait;
use GeneralTrait;

class ContactRepository extends EloquentRepository implements ContactRepositoryInterface
{
    use GeneralContactTrait,GeneralTrait;
    
    
}
