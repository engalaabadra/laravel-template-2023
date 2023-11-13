<?php

namespace Modules\Wallet\Http\Controllers\API\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Wallet\Http\Requests\StoreWalletRequest;
use Modules\Wallet\Http\Requests\UpdateWalletRequest;
use Modules\Wallet\Http\Requests\DeleteWalletRequest;
use App\Repositories\EloquentRepository;
use Modules\Wallet\Repositories\Admin\Resources\WalletRepository;
use Modules\Wallet\Entities\Wallet;
use GeneralTrait;
use Modules\Wallet\Resources\Admin\WalletResource;

class WalletResourceController extends Controller
{
    use GeneralTrait;
    /**
     * @var EloquentRepository
     */
    protected $eloquentRepo;
    /**
     * @var WalletRepository
     */
    protected $walletRepo;
        /**
     * @var Wallet
     */
    protected $wallet;
    
    /**
     * WalletsController constructor.
     *
     * @param WalletRepository $wallets
     */
    public function __construct(EloquentRepository $eloquentRepo, Wallet $wallet,WalletRepository $walletRepo)
    {
       $this->eloquentRepo = $eloquentRepo;
        $this->wallet = $wallet;
        $this->walletRepo = $walletRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $wallets=$this->walletRepo->all($request->total, $this->wallet);
        if(page()) $data=getDataResponse(WalletResource::collection($wallets));
        else $data=WalletResource::collection($wallets);
        return successResponse(0,$data);
    }

    
     /**
     * Display a listing of the resource via pagintation from search.
     *
     * @return \Illuminate\Http\Response
     */
    public function search($words,$col=null){
        $wallets=$this->walletRepo->search($this->wallet,$words,$col);
        if(page()) $data=getDataResponse(WalletResource::collection($wallets));
        else $data=WalletResource::collection($wallets);
        return successResponse(0,$data);
    }
 /**
     * Display a listing of the resource (all , pagination) from trash.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash(){
        $wallets=$this->walletRepo->trash($this->wallet);
        if(is_numeric($wallets)) return  clientError(4);
        if(page()) $data=getDataResponse(WalletResource::collection($wallets));
        else $data=WalletResource::collection($wallets);
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
        $wallet=$this->walletRepo->show($id,$this->wallet);
        if(is_numeric($wallet)) return  clientError(4,$wallet);
        return successResponse(0,new WalletResource($wallet));
    }
    /**
     * Restore the specified resource in storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function restore($id){
        $wallet =  $this->walletRepo->restore($id,$this->wallet);
        if(is_numeric($wallet)) return  clientError(4);
        return successResponse(5,new WalletResource($wallet));
    }
    /**
     * Restore All.
     *
     * @return \Illuminate\Http\Response
     */
    public function restoreAll(){
        $wallets =  $this->walletRepo->restoreAll($this->wallet);
        if(is_numeric($wallets)) return  clientError(4);
        return successResponse(5);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeleteWalletRequest $request,$id)
    {
        $wallet= $this->walletRepo->destroy($id,$this->wallet);
        if(is_numeric($wallet)) return  clientError(4);
        return successResponse(2,new WalletResource($wallet));  
    }
    public function forceDelete(DeleteWalletRequest $request,$id)
    {
        //to make force destroy for a wallet must be this wallet  not found in wallets table  , must be found in trash Categories
        $wallet=$this->walletRepo->forceDelete($id,$this->wallet);
        if(is_numeric($wallet)) return  clientError(4);
        return successResponse(4);
    } 
}
