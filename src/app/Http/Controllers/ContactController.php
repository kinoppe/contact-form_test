<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact.index');
    }

    public function confirm(ContactRequest $request)
    {
        $contact = $request->only(['last_name','first_name','gender','email','tel1','tel2','tel3','address','building','category_id','detail']);
        $categories = [
            1 => '商品のお届けについて',
            2 => '商品の交換について',
            3 => '商品トラブル',
            4 => 'ショップへのお問い合わせ',
            5 => 'その他',
        ];
        $contact['category_name'] = $categories[$contact['category_id']] ?? '';
        return view('contact.confirm',compact('contact'));
    }

    public function store(ContactRequest $request)
    {
        $contact = $request->only(['last_name','first_name','gender','email','tel1','tel2','tel3','address','building','category_id','detail']);
        $contact['tel']= $contact['tel1'].'-'.$contact['tel2'].'-'.$contact['tel3'];
        unset($contact['tel1'],$contact['tel2'],$contact['tel3']);
        Contact::create($contact);
        return view('contact.thanks');
    }
}
