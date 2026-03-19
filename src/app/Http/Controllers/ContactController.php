<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function confirm(ContactRequest $request)
    {
        $contact = $request->only(['last','first','gender','email','tel1','tel2','tel3','address','building','category','content']);
        return view('confirm',compact('contact'));
    }

    public function store(ContactRequest $request)
    {
        $contact = $request->only(['last','first','gender','email','tel1','tel2','tel3','address','building','category','content']);
        $contact['tel']= $contact['tel1'].'-'.$contact['tel2'].'-'.$contact['tel3'];
        unset($contact['tel1'],$contact['tel2'],$contact['tel3']);
        Contact::create($contact);
        return view('thanks');
    }
}
