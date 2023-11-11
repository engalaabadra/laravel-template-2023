<?php

namespace Modules\Banner\Http\Controllers\API\Admin;
use App\Http\Controllers\Controller;
use App\Repositories\EloquentRepository;
use Modules\Banner\Repositories\Admin\Additional\BannerRepository;
use Modules\Banner\Entities\Banner;
use GeneralTrait;
use Modules\Banner\Http\Controllers\API\Admin\BannerResourceController;
class BannerController extends BannerResourceController
{
    use GeneralTrait;
    /**
     * @var EloquentRepository
     */
    protected $eloquentRepo;
    /**
     * @var BannerRepository
     */
    protected $bannerRepo;
        /**
     * @var Banner
     */
    protected $banner;
    
    /**
     * StoreController constructor.
     *
     * @param EloquentRepository $eloquentRepo
     * @param Banner $banner
     * @param BannerRepository $bannerRepo
     */
    public function __construct(EloquentRepository $eloquentRepo, Banner $banner,BannerRepository $bannerRepo)
    {
       $this->eloquentRepo = $eloquentRepo;
        $this->Banner = $banner;
        $this->BannerRepo = $bannerRepo;
    }

}
