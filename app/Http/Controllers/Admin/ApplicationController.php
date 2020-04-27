<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Product;
use App\Application;
use App\Appfamily;

class ApplicationController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $applications = DB::table('applications');
        $applications = $applications->join('products', 'applications.productid', '=', 'products.id');
        $applications = $applications->join('appfamilies', 'applications.appfamilyid', '=', 'appfamilies.id');
        $applications = $applications->select('applications.*', 'products.family', 'appfamilies.appfamily');
        $applications = $applications ->paginate(15);
        return view('admin.applications.index', compact('applications'));
    }

    public function create()
    {
        $products = Product::all();
        return view('admin.applications.applicationAdd', compact('products'));
    }

    public function store(Request $request)
    {
        $applications = new Application();
        $applications->productid = $request['family'];
        $applications->appfamilyid = $request['appfamily'];
        $applications->application = $request['application'];
        $applications->save();
        return redirect('admin/applications');

    }

    public function show($id)
    {
        return redirect('admin/applications');
    }

    public function edit($id)
    {
        $application = Application::find($id);
        $products = Product::all();
        $appfamily = Appfamily::where('productid', '=', $application->productid)->get();
        return view('admin.applications.applicationEdit', compact('application', 'products', 'appfamily'));
    }

    public function update(Request $request, $id)
    {
        $application = Application::findOrFail($id);
        $application->productid = $request['family'];
        $application->appfaimlyid = $request['appfaimly'];
        $application->application = $request['application'];
        $application->save();
        return redirect('admin/applications');
    }

    public function destroy($id)
    {
        $application = Application::find($id);
        $application->delete();
        return redirect('admin/applications');
    }
}
