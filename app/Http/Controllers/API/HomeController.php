<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Banner\Http\Controllers\API\BannerResourceController;
use Modules\Auth\Http\Controllers\API\User\DoctorController;
use Modules\Specialty\Http\Controllers\API\User\SpecialtyController;
use GeneralTrait;
use App\Models\MobileVersion;
use Modules\Reservation\Entities\Reservation;
use Modules\Reservation\Resources\User\ReservationResource;

class HomeController extends Controller
{
    use GeneralTrait;
    /**
     * @var BannerResourceController
     */
    protected $bannerController;
    /**
     * @var DoctorController
     */
    protected $doctorController;
    /**
     * @var SpecialtyController
     */
    protected $specialtyController;
    
    /**
     * HomeController constructor.
     *
     * @param BannerResourceController $bannerController
     */
    public function __construct(BannerResourceController $bannerController,DoctorController $doctorController,SpecialtyController $specialtyController)
    {
       $this->bannerController = $bannerController;
       $this->doctorController = $doctorController;
       $this->specialtyController = $specialtyController;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $banners=$this->bannerController->index($request);
        $originalBanners=$banners->original;
        $topDoctors=$this->doctorController->getAllTopDoctors($request);
        $originaltopDoctors=$topDoctors->original;
        $topSpecialties=$this->specialtyController->getTopSpecialties($request);
        $originaltopSpecialties=$topSpecialties->original;
        $mobileVersions=MobileVersion::get();

        if(!authUser()){
            $data=[
                'top_doctors'=>$originaltopDoctors['data'],
                'top_specialties'=>$originaltopSpecialties['data'],
                'banners'=> $originalBanners['data'],
                'array_mobile_versions'=>$mobileVersions,
                'reservations_ended'=>[],
                'reservations_started'=>[],
            ];
        }else{
            //get reservations has been ended and not review on it 
            $reservationsEnded = Reservation::doesntHave('review')->where(['user_id'=>authUser()->id,'status'=>'1','is_end'=>'1'])->get();
            //get reservations started but not end
            $reservationsStarted = Reservation::doesntHave('review')->where(['user_id'=>authUser()->id,'status'=>'1','is_start'=>'1','is_end'=>'0'])->get();
            $data=[
                'top_doctors'=>$originaltopDoctors['data'],
                'top_specialties'=>$originaltopSpecialties['data'],
                'banners'=> $originalBanners['data'],
                'array_mobile_versions'=>$mobileVersions,
                'reservations_ended'=>ReservationResource::collection($reservationsEnded),
                'reservations_started'=>ReservationResource::collection($reservationsStarted),
            ];

        }
        return successResponse(0,$data);
    }



}
