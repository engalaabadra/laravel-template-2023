<?php
namespace Modules\Wallet\Repositories\User\Resources;

use App\Repositories\EloquentRepository;
use Modules\Wallet\Repositories\User\Resources\WalletRepositoryInterface;
use Modules\Wallet\Entities\Traits\User\WalletMethods;
use GeneralTrait;

class WalletRepository extends EloquentRepository implements WalletRepositoryInterface
{
    use GeneralTrait,WalletMethods;
    
    public function store($request,$model){
        return $this->actionMethod($request,$model);
    }

}
