<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Product;

class ProductController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $products = DB::table('products');
        $products = $products ->paginate(15);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.productAdd');
    }

    public function store(Request $request)
    {
        $products = new Product();
        $products->family = $request['family'];
        $products->save();
        return redirect('admin/products');

    }

    public function show($id)
    {
        return redirect('admin/products');
    }

    public function edit($id)
    {
        $product = Product::find($id);
        return view('admin.products.productEdit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->family = $request['family'];
        $product->save();
        return redirect('admin/products');
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect('admin/products');
    }
}
