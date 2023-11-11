<?php

namespace Modules\Contact\Http\Controllers\WEB\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Contact\Repositories\User\ContactRepository;
use Modules\Contact\Entities\Contact;
use GeneralTrait;
use Modules\Contact\Resources\User\ContactResource;
use Modules\Contact\Http\Requests\StoreContactRequest;

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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|max:255',
            'phone' => 'required',
            'message' => 'required|string|max:65535',
        ], [
            'name.required' => 'Name is required',
            'email.required' => 'email is required',
            'email.email' => 'email must be email',
            'email.max:255' => 'email is max:225 char',
            'phone.required' => 'phone is required',
            'message.required' => 'message is required',
            'message.string' => 'message is string',
            'message.max:65535' => 'message is max:65535 char',

            
        ]);

        $contact=$this->contact->create($request->all());
        return $request->session()->flash('success');
         redirect()->back();

         redirect()->back()->with('flash_message_success','created successfully');

    }


}
