<?php
namespace Modules\Contact\Repositories\User;

use Modules\Contact\Entities\Contact;
use Modules\Contact\Repositories\User\ContactRepositoryInterface;
use App\Repositories\EloquentRepository;
use GeneralTrait;
use Modules\Contact\Entities\Traits\GeneralContactTrait;

class ContactRepository extends EloquentRepository implements ContactRepositoryInterface
{
    use GeneralTrait, GeneralContactTrait;

}