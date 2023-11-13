<?php

namespace Modules\Banner\Http\Controllers\API\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Banner\Repositories\Resources\User\BannerRepository;
use Modules\Banner\Entities\Banner;
use GeneralTrait;
use Modules\Banner\Resources\User\BannerResource;
class BannerResourceController extends Controller
{
    use GeneralTrait;
    /**
     * @var BannerRepository
     */
    protected $bannerRepo;
        /**
     * @var Banner
     */
    protected $banner;
    
    /**
     * BannerResourceController constructor.
     *
     * @param BannerRepository $banners
     */
    public function __construct( Banner $banner,BannerRepository $bannerRepo)
    {
        $this->banner = $banner;
        $this->bannerRepo = $bannerRepo;
    }
    /**
     * Display a listing of the resource via (all , pagination).
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $banners=$this->bannerRepo->all($request, $this->banner);
        if(page()) $data = getDataResponse(BannerResource::collection($banners));
        else $data = BannerResource::collection($banners);
        return successResponse(0,$data);
    }

}
