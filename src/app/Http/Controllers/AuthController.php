<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Requests\LoginRequest;
use App\Actions\Fortify\CreateNewUser;
use App\Exports\ContactsExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\User;
use App\Models\Category;
use App\Models\Contact;
use Illuminate\Support\Facades\Auth;
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

    public function login(LoginRequest $request)
    {
            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {
                return redirect('/admin');
            }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        if ($request->hasSession()) {
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }

        return redirect('/login');
    }

    public function search(Request $request)
    {
        $genderMap = [
            '男性' => 1,
            '女性' => 2,
            'その他' => 3,
        ];
        $gender = $genderMap[$request->gender] ?? null;
        $contacts = Contact::with('category')
        ->KeywordSearch($request->keyword)
        ->GenderSearch($gender)
        ->CategorySearch($request->category_id)
        ->DateSearch($request->date)
        ->paginate(7);
        $categories = Category::all();
        $genderLabels = Contact::$genderLabels;

        return view('index', compact('contacts', 'categories', 'genderLabels'));
    }

    public function export(Request $request)
    {
        $genderMap = [
            '男性' => 1,
            '女性' => 2,
            'その他' => 3,
        ];
        $gender = $genderMap[$request->gender] ?? null;
        $contacts = Contact::with('category')
            ->keywordSearch($request->keyword)
            ->genderSearch($gender)
            ->categorySearch($request->category_id)
            ->dateSearch($request->date)
            ->get();
        return Excel::download(new ContactsExport($contacts), 'contacts.csv');
    }

    public function destroy(Request $request)
    {
        Contact::find($request->id)->delete();

        return redirect('/admin');
    }
}
