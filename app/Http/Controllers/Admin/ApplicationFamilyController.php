<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Product;
use App\Appfamily;

class ApplicationFamilyController extends Controller
{
    //
    //
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $application_groups = DB::table('appfamilies');
        $application_groups = $application_groups->join('products', 'appfamilies.productid', '=', 'products.id');
        $application_groups = $application_groups->select('appfamilies.*', 'products.family');
        $application_groups = $application_groups ->paginate(15);
        return view('admin.appfamily.index', compact('application_groups'));
    }

    public function create()
    {
        $products = Product::all();
        return view('admin.appfamily.appfamilyAdd', compact('products'));
    }

    public function store(Request $request)
    {
        $application_groups = new Appfamily();
        $application_groups->productid = $request['product_family'];
        $application_groups->appfamily = $request['appfamily'];
        $application_groups->save();
        return redirect('admin/appfamily');

    }

    public function show($id)
    {
        return redirect('admin/appfamily');
    }

    public function edit($id)
    {
        $application_groups = Appfamily::find($id);
        $products = Product::all();
        return view('admin.appfamily.appfamilyEdit', compact('application_groups', 'products'));
    }

    public function update(Request $request, $id)
    {
        $application_group = Appfamily::findOrFail($id);
        $application_group->productid = $request['product_family'];
        $application_group->appfamily = $request['appfamily'];
        $application_group->save();
        return redirect('admin/appfamily');
    }

    public function destroy($id)
    {
        $application_group = Appfamily::find($id);
        $application_group->delete();
        return redirect('admin/appfamily');
    }
}
