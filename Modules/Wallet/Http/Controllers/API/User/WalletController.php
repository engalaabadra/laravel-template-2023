<?php

namespace Modules\Wallet\Http\Controllers\API\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Wallet\Repositories\User\Additional\WalletRepository;
use Modules\RequestWithdrawing\Entities\RequestWithdrawing;
use Modules\RequestWithdraw\Entities\RequestWithdraw;
use GeneralTrait;
use Modules\Wallet\Resources\Doctor\WalletResource;
use Modules\Wallet\Http\Requests\DeleteFromWalletRequest;
class WalletController extends Controller
{
    use GeneralTrait;
    /**
     * @var WalletRepository
     */
    protected $walletRepo;
    /**
     * @var Wallet
     */
    protected $wallet;

    /**
     * @var RequestWithdraw
     */
    protected $requestWithdraw;
    
    /**
     * WalletController constructor.
     *
     * @param WalletRepository $wallets
     */
    public function __construct( wallet $wallet,RequestWithdrawing $requestWithdrawing,WalletRepository $walletRepo)
    {
        $this->wallet = $wallet;
        $this->requestWithdrawing = $requestWithdrawing;
        $this->walletRepo = $walletRepo;
    }
    public function withdraw(DeleteFromWalletRequest $request)
    {
        $wallet= $this->walletRepo->withdraw($this->wallet,$this->requestWithdrawing,$request);
        if(is_string($wallet)) return  clientError(0,$wallet);
        return successResponse(2,new WalletResource($wallet));  
    }

    
    // public function payToReservation(payToReservationRequest $request,$reservationId){
    //     $wallet=$this->walletRepo->payToReservation($request,$this->wallet,$reservationId);
    //     if(is_string($wallet)) return clientError(0,$wallet);
    //     return successResponse(1,new WalletResource($wallet));
    // }

}
