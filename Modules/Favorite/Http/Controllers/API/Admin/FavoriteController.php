<?php

namespace Modules\Favorite\Http\Controllers\API\Admin;
use App\Http\Controllers\Controller;
use App\Repositories\EloquentRepository;
use Modules\Favorite\Repositories\Admin\Additional\FavoriteRepository;
use Modules\Favorite\Entities\Favorite;
use GeneralTrait;
use Modules\Favorite\Http\Controllers\API\Admin\FavoriteResourceController;
class FavoriteController extends FavoriteResourceController
{
    use GeneralTrait;
    /**
     * @var EloquentRepository
     */
    protected $eloquentRepo;
    /**
     * @var FavoriteRepository
     */
    protected $favoriteRepo;
        /**
     * @var Favorite
     */
    protected $favorite;
    
    /**
     * StoreController constructor.
     *
     * @param EloquentRepository $eloquentRepo
     * @param Favorite $favorite
     * @param FavoriteRepository $favoriteRepo
     */
    public function __construct(EloquentRepository $eloquentRepo, Favorite $favorite,FavoriteRepository $favoriteRepo)
    {
       $this->eloquentRepo = $eloquentRepo;
        $this->favorite = $favorite;
        $this->favoriteRepo = $favoriteRepo;
    }

}
