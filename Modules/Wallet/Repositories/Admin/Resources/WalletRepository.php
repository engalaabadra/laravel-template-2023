<?php
namespace Modules\Wallet\Repositories\Admin\Resources;

use App\Repositories\EloquentRepository;
use Modules\Wallet\Repositories\Admin\Resources\WalletRepositoryInterface;
use Modules\Wallet\Entities\Traits\Admin\WalletMethods;

class WalletRepository extends EloquentRepository implements WalletRepositoryInterface
{
    use WalletMethods;
}
