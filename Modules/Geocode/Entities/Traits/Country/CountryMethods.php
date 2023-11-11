<?php
namespace Modules\Geocode\Entities\Traits\Country;

trait CountryMethods{
    
    public function getRelationCitiesCountry($model,$request,$countryId){
        $country=$this->find($countryId,$model);
        if(is_string($country)){
            return $country;
        }
        $citiesCountry = $country->cities()->withoutGlobalScope(ActiveScope::class)->withoutGlobalScope(LanguageScope::class)->paginate($request->total);
        return  $citiesCountry;
    }
     //get data -paginates-//
  public function getPaginatesDataMethod($request, $model){
    if(isset(getallheaders()['lang']))  return $this->paginatesDataMethod($request, $model,getallheaders()['lang']);
    else return $this->paginatesDataMethod($request, $model);
    }
    public function paginatesDataMethod($request, $model,$lang=null){
        
        $result=array_key_exists($lang, config('languages'));
        if($lang && $result) return $model->where(['main_lang'=>$lang])->orderBy('code')->paginate($request->total);
        else return $model->orderBy('code')->paginate($request->total);
    }
    //get data -all- //
    public function getAllDataMethod($model){
        if(isset(getallheaders()['lang']))  return $this->allDataMethod($model,getallheaders()['lang']);
        else return $this->allDataMethod($model);
    }
    public function allDataMethod($model,$lang=null){
        $result=array_key_exists($lang, config('languages'));
        if($lang && $result) return $model->where(['main_lang'=>$lang])->orderBy('code')->get();
        else return $model->orderBy('code')->get();
    }

     //get data -paginates-//
  public function getPaginatesData($request, $model){
    if(isset(getallheaders()['lang']))  return $this->paginatesData($request, $model,getallheaders()['lang']);
    else return $this->paginatesData($request, $model);
    }
    public function paginatesData($request, $model,$lang=null){
        if(!$lang) $lang=localLang();
        return $model->orderBy('code')->where(['main_lang'=>$lang])->paginate($request->total);
    }
    //get data -all- //
    public function getAllData($model){
        if(isset(getallheaders()['lang']))  return $this->allData($model,getallheaders()['lang']);
        else return $this->allData($model);
    }
    public function allData($model,$lang=null){
        if(!$lang) $lang=localLang();
        return $model->orderBy('code')->where(['main_lang'=>$lang])->get();
    }

}