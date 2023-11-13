<?php
namespace Modules\Favorite\Services\User;

use Modules\Favorite\Entities\Favorite;
use Modules\Favorite\Services\User\UserServiceInterface;
use Modules\Favorite\Traits\GeneralFavoriteTrait;

class FavoriteService  implements FavoriteServiceInterface
{
    use GeneralFavoriteTrait;


}
