<?php

namespace Modules\Banner\Http\Controllers\API\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Banner\Http\Requests\StoreBannerRequest;
use Modules\Banner\Http\Requests\UpdateBannerRequest;
use Modules\Banner\Http\Requests\DeleteBannerRequest;
use App\Repositories\EloquentRepository;
use Modules\Banner\Repositories\API\Admin\Resources\BannerRepository;
use Modules\Banner\Entities\Banner;
use GeneralTrait;
use Modules\Banner\Resources\Admin\BannerResource;

class BannerResourceController extends Controller
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
     * BannersController constructor.
     *
     * @param BannerRepository $banners
     */
    public function __construct(EloquentRepository $eloquentRepo, Banner $banner,BannerRepository $bannerRepo)
    {
       $this->eloquentRepo = $eloquentRepo;
        $this->banner = $banner;
        $this->bannerRepo = $bannerRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $banners=$this->bannerRepo->all($this->banner);
        if(page()) $data=getDataResponse(BannerResource::collection($banners));
        else $data=BannerResource::collection($banners);
        return successResponse(0,$data);
    }
     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBannerRequest $request)
    {
        $banner=  $this->bannerRepo->store($request->validated(),$this->banner);
        if(is_string($banner)) return  clientError(0,$banner);
        return successResponse(1,new BannerResource($banner));
    }
    /**
     * Display a listing of the resource via pagintation from search.
     *
     * @return \Illuminate\Http\Response
     */
    public function search($words,$col=null){
        $banners=$this->bannerRepo->search($this->banner,$words,$col='title');
        if(page()) $data=getDataResponse(BannerResource::collection($banners));
        else $data=BannerResource::collection($banners);
        return successResponse(0,$data);
    }
    /**
     * Display a listing of the resource (all , pagination) from trash.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash(Request $request){
        $banners=$this->bannerRepo->trash($this->banner,$request);
        if(is_numeric($banners)) return  clientError(4);
        if(page()) $data=getDataResponse(BannerResource::collection($banners));
        else $data=BannerResource::collection($banners);
        return successResponse(0,$data);
    }

   
    public function storeTrans(StoreBannerRequest $request,$id)
    {
        if(!is_numeric($id)) return clientError(0);
        $banner=  $this->bannerRepo->storeTrans($request->validated(),$this->banner,$id);
        if(is_numeric($banner)) return  clientError(4);
        return successResponse(1,new BannerResource($banner));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $banner=$this->bannerRepo->show($id,$this->banner);
        if(is_numeric($banner)) return  clientError(4,$banner);
        return successResponse(0,new BannerResource($banner));
    }

 

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBannerRequest $request,$id)
    {
        $banner= $this->bannerRepo->update($request->validated(),$this->banner,$id);
        if(is_numeric($banner)) return  clientError(4,$banner);
        return successResponse(2,new BannerResource($banner));
    }
    /**
     * Restore the specified resource in storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function restore($id){
        $banner =  $this->bannerRepo->restore($id,$this->banner);
        if(is_numeric($banner)) return  clientError(4);
        return successResponse(5,new BannerResource($banner));
    }
    /**
     * Restore All.
     *
     * @return \Illuminate\Http\Response
     */
    public function restoreAll(){
        $banners =  $this->bannerRepo->restoreAll($this->banner);
        if(is_numeric($banners)) return  clientError(4);
        return successResponse(5);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeleteBannerRequest $request,$id)
    {
        $banner= $this->bannerRepo->destroy($id,$this->banner);
        if(is_numeric($banner)) return  clientError(4);
        return successResponse(2,new BannerResource($banner));  
    }
    public function forceDelete(DeleteBannerRequest $request,$id)
    {
        //to make force destroy for a Banner must be this Banner  not found in Banners table  , must be found in trash Categories
        $banner=$this->bannerRepo->forceDelete($id,$this->banner);
        if(is_numeric($banner)) return  clientError(4);
        return successResponse(4);
    }

}
