<?php

namespace Modules\Favorite\Http\Controllers\API\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Favorite\Repositories\User\Resources\FavoriteRepository;
use Modules\Favorite\Entities\Favorite;
use GeneralTrait;
use Modules\Favorite\Resources\User\FavoriteResource;
use Modules\Favorite\Http\Requests\AddToFavoriteRequest;
use Modules\Favorite\Http\Requests\DeleteFavoriteRequest;
class FavoriteResourceController extends Controller
{
    use GeneralTrait;
    /**
     * @var FavoriteRepository
     */
    protected $favoriteRepo;
        /**
     * @var Favorite
     */
    protected $favorite;
    
    /**
     * FavoriteResourceController constructor.
     *
     * @param FavoriteRepository $favorites
     */
    public function __construct( Favorite $favorite,FavoriteRepository $favoriteRepo)
    {
        $this->favorite = $favorite;
        $this->favoriteRepo = $favoriteRepo;
    }
    /**
     * Display a listing of the resource (all , pagination).
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $favorites = $this->favoriteRepo->all($request,$this->favorite);
        if(page()) $data=getDataResponse(FavoriteResource::collection($favorites));
        else $data=FavoriteResource::collection($favorites);
        return successResponse(0,$data);
    }
    /**
     * store.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(AddToFavoriteRequest $request){
        $favorite=$this->favoriteRepo->store($request,$this->favorite);
        if(is_numeric($favorite)) return clientError(4);
        if(is_string($favorite)) return clientError(0,$favorite);
        return successResponse(1,new FavoriteResource($favorite->load(['user','doctor'])));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeleteFavoriteRequest $request)
    {
        $favorite= $this->favoriteRepo->delete($this->favorite,$request);
        if(is_numeric($favorite)) return  clientError(4);
        if(is_string($favorite)) return  clientError(0,$favorite);
        return successResponse(2,$favorite);
    }

}
