<?php

namespace App\Http\Controllers;

use App\Models\Debts_Receivables;
use Illuminate\Http\Request;

class Debts_ReceivablesController extends Controller
{
    public function index(Request $request)
    {
        $query = Debts_Receivables::query();
    
        // Sorting
        if ($request->has('sort') && $request->has('direction')) {
            $query->orderBy($request->input('sort'), $request->input('direction'));
        }

        
        $sortDirection = request('direction', 'desc'); 
        $debt_receivable = $query->orderBy('created_at', $sortDirection)->paginate(10);
    
        return view('pages.debt_receivable.index', compact('debt_receivable'));
    }

    public function delete($id){
        Debts_Receivables::where('id',$id) -> delete();
        return redirect('/debt_receivable')->with('success', 'Transaction deleted successfully!');
    }
    
}
