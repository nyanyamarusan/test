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
            'tel1',
            'tel2',
            'tel3',
            'address',
            'building',
            'category_id',
            'detail',
        ]);
        $contact['tel'] = $request->tel1 . $request->tel2 . $request->tel3;
        $genderLabels = [
            1 => '男性',
            2 => '女性',
            3 => 'その他',
        ];
        $contact['gender_label'] = $genderLabels[$request->gender] ?? '未設定';
        $categoryContent = Category::find($request->category_id)->content;
        $categoryId = $request->category_id;

        return view('confirm', compact('contact', 'categoryContent', 'categoryId'));
    }

    public function store(Request $request)
    {
        $contact = $request->only([
            'last_name',
            'first_name',
            'gender',
            'email',
            'tel',
            'address',
            'building',
            'category_id',
            'detail',
        ]);
        $contact['gender'] = match($contact['gender']) {
            '男性' => 1,
            '女性' => 2,
            'その他' => 3,
        };
        Contact::create($contact);

        return view('thanks', compact('contact'));
    }
}
