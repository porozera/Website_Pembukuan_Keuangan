<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index(Request $request)
    {
        $query = Account::query();
    
        // Sorting
        if ($request->has('sort') && $request->has('direction')) {
            $query->orderBy($request->input('sort'), $request->input('direction'));
        }
    
        $sortDirection = request('direction', 'desc'); 
        $account = $query->orderBy('created_at', $sortDirection)->paginate(10);

    
        return view('pages.account.index', compact('account'));
    }
    
    

    public function add(){
        return view('pages.account.add');
    }

    public function create(Request $request){
        $attributes = $request->validate([
            'code' => 'required',
            'name' => 'required',
            'category' => 'required',
            'account_type' => 'required',
        ]);
        $data = Account::create([
            "code" => $attributes['code'],
            "name" => $attributes['name'],
            "category" => $attributes['category'],
            "account_type" => $attributes['account_type'],
            "description" => $request->input('description', null),
        ]);
        return redirect("/account")->with('success', 'Account created successfully!');
    }

    public function edit($id)
    {
        $account = Account::find($id);
        if (!$account) {
            return redirect('/account')->with('error', 'Account not found');
        }
    
        return view('pages.account.edit', compact('account'));
    }

    public function update($id, Request $request){
        $attributes = $request -> validate([
            'code' => 'required',
            'name' => 'required',
            'category' => 'required',
            'account_type' => 'required',
        ]);
        $data = Account::findorfail($id);
        $data -> update([
            "code" => $attributes['code'],
            "name" => $attributes['name'],
            "category" => $attributes['category'],
            "account_type" => $attributes['account_type'],
            "description" => $request->input('description', null),
        ]);
        return redirect('/account')->with('success', 'Account updated successfully!');
    }

    public function delete($id){
        Account::where('id',$id) -> delete();
        return redirect('/account')->with('success', 'Account deleted successfully!');
    }
}
