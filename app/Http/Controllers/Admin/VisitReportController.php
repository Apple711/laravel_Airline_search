<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Visit;

class VisitReportController extends Controller
{
    //
    public function index(){
        $visits = DB::table('visits');
        $visits = $visits->paginate(15);

        return view('admin.visit.index', compact('visits'));
    }

    public function create()
    {
        return view('admin.visit.visitAdd');
    }

    public function store(Request $request)
    {
        $visit = new Visit();
        $visit->reportowner = $request['report_owner'];
        $visit->attendess = $request['attendess'];
        $visit->save();
        return redirect('admin/visit');

    }

    public function edit($id)
    {
        $visit = Visit::find($id);
        return view('admin.visit.visitEdit', compact('visit'));
    }

    public function update(Request $request, $id)
    {
        $visit = Visit::findOrFail($id);
        $visit->reportowner = $request['report_owner'];
        $visit->attendess = $request['attendess'];

        $visit->save();
        return redirect('admin/visit');
    }

    public function destroy($id)
    {
        $visit = Visit::find($id);
        $visit->delete();
        return redirect('admin/visit');
    }
}
