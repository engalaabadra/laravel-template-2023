<?php
namespace Modules\Favorite\Repositories\Admin\Resources;

use App\Repositories\EloquentRepository;
use Modules\Favorite\Repositories\Admin\Resources\FavoriteRepositoryInterface;
use Modules\Favorite\Entities\Traits\Admin\FavoriteMethods;

class FavoriteRepository extends EloquentRepository implements FavoriteRepositoryInterface
{
    use FavoriteMethods;
}
