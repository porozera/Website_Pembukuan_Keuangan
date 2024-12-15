<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request){
        $query = Report::query();

        //sorting
        if ($request->has('sort') && $request->has('direction')) {
            $query->orderBy($request->input('sort'), $request->input('direction'));
        }

        $report = $query->paginate(4);

        return view('pages.report.index', compact('report'));
    }


    public function add(){
        return view('pages.report.add');
    }
}
