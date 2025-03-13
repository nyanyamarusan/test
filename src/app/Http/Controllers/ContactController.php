<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Models\Category;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('contact', compact('categories'));
    }

    public function confirm(ContactRequest $request)
    {
        $contact = $request->only([
            'last_name',
            'first_name',
            'gender',
            'email',
            'tel',
            'address',
            'building',
            'content',
            'detail',
        ]);
        $categoryContent = Category::find($request->category_id)->content;

        return view('confirm', compact('contact', 'categoryContent'));
    }

    public function store(ContactRequest $request)
    {
        $contact = $request->only([
            'last_name',
            'first_name',
            'gender',
            'email',
            'tel',
            'address',
            'building',
            'content',
            'detail',
        ]);
        $categoryContent = Category::find($request->category_id)->content;
        Contact::create($contact);

        return view('thanks', compact('contact', 'categoryContent'));
    }
}
