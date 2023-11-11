<?php

namespace Modules\Contact\Http\Controllers\API\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Contact\Repositories\Admin\Resources\ContactRepository;
use Modules\Contact\Entities\Contact;
use GeneralTrait;
use Modules\Contact\Resources\Admin\ContactResource;
class ContactResourceController extends Controller
{
    use GeneralTrait;
    /**
     * @var ContactRepository
     */
    protected $contactRepo;
        /**
     * @var Contact
     */
    protected $contact;
    
    /**
     * ContactController constructor.
     *
     * @param ContactRepository $contacts
     */
    public function __construct( Contact $contact,ContactRepository $contactRepo)
    {
        $this->contact = $contact;
        $this->contactRepo = $contactRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $contacts=$this->contactRepo->all($request->total, $this->contact);
        if(page()) $data=getDataResponse(ContactResource::collection($contacts));
        else $data=ContactResource::collection($contacts);
        return successResponse(0,$data);
    }
 /**
     * Display a listing of the resource via pagintation from search.
     *
     * @return \Illuminate\Http\Response
     */
    public function search($words,$col=null){
        $contacts=$this->contactRepo->search($this->contact,$words,$col);
        if(page()) $data=getDataResponse(ContactResource::collection($contacts));
        else $data=ContactResource::collection($contacts);
        return successResponse(0,$data);
    }
 /**
     * Display a listing of the resource (all , pagination) from trash.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash(){
        $contacts=$this->contactRepo->trash($this->contact);
        if(is_numeric($contacts)) return  clientError(4);
        if(page()) $data=getDataResponse(ContactResource::collection($contacts));
        else $data=ContactResource::collection($contacts);
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
        $contact=$this->contactRepo->show($id,$this->contact);
        if(is_numeric($contact)) return  clientError(4,$contact);
        return successResponse(0,new ContactResource($contact));
    }
    /**
     * Restore the specified resource in storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function restore($id){
        $contact =  $this->contactRepo->restore($id,$this->contact);
        if(is_numeric($contact)) return  clientError(4);
        return successResponse(5,new ContactResource($contact));
    }
    /**
     * Restore All.
     *
     * @return \Illuminate\Http\Response
     */
    public function restoreAll(){
        $contacts =  $this->contactRepo->restoreAll($this->contact);
        if(is_numeric($contacts)) return  clientError(4);
        return successResponse(5);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeleteContactRequest $request,$id)
    {
        $contact= $this->contactRepo->destroy($id,$this->contact);
        if(is_numeric($contact)) return  clientError(4);
        return successResponse(2,new ContactResource($contact));  
    }
    public function forceDelete(DeleteContactRequest $request,$id)
    {
        //to make force destroy for a contact must be this contact  not found in contacts table  , must be found in trash Categories
        $contact=$this->contactRepo->forceDelete($id,$this->contact);
        if(is_numeric($contact)) return  clientError(4);
        return successResponse(4);
    } 
}
