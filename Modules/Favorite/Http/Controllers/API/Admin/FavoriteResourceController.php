<?php

namespace Modules\Favorite\Http\Controllers\API\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Favorite\Http\Requests\StoreFavoriteRequest;
use Modules\Favorite\Http\Requests\UpdateFavoriteRequest;
use Modules\Favorite\Http\Requests\DeleteFavoriteRequest;
use App\Repositories\EloquentRepository;
use Modules\Favorite\Repositories\Admin\Resources\FavoriteRepository;
use Modules\Favorite\Entities\Favorite;
use GeneralTrait;
use Modules\Favorite\Resources\Admin\FavoriteResource;

class FavoriteResourceController extends Controller
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
     * FavoritesController constructor.
     *
     * @param FavoriteRepository $favorites
     */
    public function __construct(EloquentRepository $eloquentRepo, Favorite $favorite,FavoriteRepository $favoriteRepo)
    {
       $this->eloquentRepo = $eloquentRepo;
        $this->favorite = $favorite;
        $this->favoriteRepo = $favoriteRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $favorites=$this->favoriteRepo->all($this->favorite);
        if(page()) $data=getDataResponse(FavoriteResource::collection($favorites));
        else $data=FavoriteResource::collection($favorites);
        return successResponse(0,$data);
    }
     /**
     * Display a listing of the resource via pagintation from search.
     *
     * @return \Illuminate\Http\Response
     */
    public function search($words,$col=null){
        $favorites=$this->favoriteRepo->search($this->favorite,$words,$col);
        if(page()) $data=getDataResponse(FavoriteResource::collection($favorites));
        else $data=FavoriteResource::collection($favorites);
        return successResponse(0,$data);
    }
 /**
     * Display a listing of the resource (all , pagination) from trash.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash(){
        $favorites=$this->favoriteRepo->trash($this->favorite);
        if(is_numeric($favorites)) return  clientError(4);
        if(page()) $data=getDataResponse(FavoriteResource::collection($favorites));
        else $data=FavoriteResource::collection($favorites);
        return successResponse(0,$data);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $favorite=$this->favoriteRepo->show($id,$this->favorite);
        if(is_numeric($favorite)) return  clientError(4,$favorite);
        return successResponse(0,new FavoriteResource($favorite));
    }
    /**
     * Restore the specified resource in storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function restore($id){
        $favorite =  $this->favoriteRepo->restore($id,$this->favorite);
        if(is_numeric($favorite)) return  clientError(4);
        return successResponse(5,new FavoriteResource($favorite));
    }
    /**
     * Restore All.
     *
     * @return \Illuminate\Http\Response
     */
    public function restoreAll(){
        $favorites =  $this->favoriteRepo->restoreAll($this->favorite);
        if(is_numeric($favorites)) return  clientError(4);
        return successResponse(5);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeleteFavoriteRequest $request,$id)
    {
        $favorite= $this->favoriteRepo->destroy($id,$this->favorite);
        if(is_numeric($favorite)) return  clientError(4);
        return successResponse(2,new FavoriteResource($favorite));  
    }
    public function forceDelete(DeleteFavoriteRequest $request,$id)
    {
        //to make force destroy for a favorite must be this favorite  not found in favorites table  , must be found in trash Categories
        $favorite=$this->favoriteRepo->forceDelete($id,$this->favorite);
        if(is_numeric($favorite)) return  clientError(4);
        return successResponse(4);
    } 
}
