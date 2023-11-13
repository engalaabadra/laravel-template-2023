<?php
namespace Modules\Geocode\Repositories\API\Admin\Address\Additional;

use App\Repositories\EloquentRepository;
use Modules\Geocode\Entities\Address;
use Modules\Geocode\Repositories\API\Admin\Address\Additional\AddressRepositoryInterface;
use Modules\Geocode\Entities\Traits\Address\GeneralAddressTrait;

class AddressRepository extends EloquentRepository implements AddressRepositoryInterface
{
    use GeneralAddressTrait;
}