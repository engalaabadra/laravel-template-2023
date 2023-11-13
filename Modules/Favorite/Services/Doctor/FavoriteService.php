<?php
namespace Modules\Favorite\Services\Doctor;

use Modules\Favorite\Entities\Favorite;
use Modules\Favorite\Services\Doctor\FavoriteServiceInterface;
use Modules\Favorite\Traits\GeneralFavoriteTrait;

class FavoriteService  implements FavoriteServiceInterface
{
    use GeneralFavoriteTrait;


}
