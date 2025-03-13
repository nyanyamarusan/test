<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Actions\Fortify\CreateNewUser;
use App\Exports\ContactsExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\User;
use App\Models\Category;
use App\Models\Contact;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index()
    {
        $contacts = Contact::with('category')->Paginate(7);
        $categories = Category::all();
        $genderLabels = Contact::$genderLabels;

        return view('index', compact('contacts', 'categories', 'genderLabels'));
    }

    public function store(UserRequest $request, CreateNewUser $creator)
    {
        $input = $request->validated();
        $user = $creator->create($input);

        return redirect('/login');
    }

    public function search (Request $request)
    {
        $contacts = Contact::with('category')
        ->KeywordSearch($request->keyword)
        ->GenderSearch($request->gender)
        ->CategorySearch($request->category_id)
        ->DateSearch($request->date)
        ->get();
        $categories = Category::all();

        return view('index', compact('contacts', 'categories'));
    }

    public function export(Request $request)
    {
        return Excel::download(new ContactsExport($request), 'contacts.csv');
    }

    public function destroy (Request $request)
    {
        Contact::find($request->id)->delete();

        return redirect('/admin');
    }
}
