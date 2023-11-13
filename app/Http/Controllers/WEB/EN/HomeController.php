<?php

namespace App\Http\Controllers\WEB\EN;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Auth\Http\Controllers\API\User\DoctorController;
use Modules\Auth\Entities\Role;
use Modules\Article\Entities\Article;
use Modules\Day\Entities\Day;
use GeneralTrait;

class HomeController extends Controller
{
    use GeneralTrait;
    /**
     * @var DoctorController
     */
    protected $doctorController;
    
    /**
     * HomeController constructor.
     *
     * @param BannerResourceController $bannerController
     */
    public function __construct(DoctorController $doctorController)
    {
       $this->doctorController = $doctorController;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){

    }



}
