<?php
namespace Modules\Favorite\Services\Admin;

use Modules\Favorite\Entities\Favorite;
use Modules\Favorite\Services\Admin\UserServiceInterface;
use Modules\Favorite\Traits\GeneralFavoriteTrait;

class FavoriteService  implements FavoriteServiceInterface
{
    use GeneralFavoriteTrait;


}
