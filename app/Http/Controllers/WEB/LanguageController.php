<?php

namespace App\Http\Controllers\WEB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class LanguageController extends Controller
{
    public function switchLang($lang)
    {

        if (array_key_exists($lang, Config::get('languages'))) {
            session()->put('lang',$lang);
            App::setLocale($lang);
            return redirect()->back();

        }
    }

    public function defaultLang(){
        $defaultLang=localLang();
        return view(200, localLang());
    }

    public function getAllLangs(){
        $getAllLangs=Config::get('languages');
        return view(200, $getAllLangs);
     }

}
