<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Product;
use App\Application;
use App\Mrocompany;
use App\Contact;
use App\Airline;

class HomeController extends Controller
{
    //
    public function index(){
        $products = Product::all();
        return view("admin.home", compact('products'));
    }

    public function search(Request $request){
        $product_id = $request['product_id'];
        $application_id = $request['application_id'];
        $customer_type = $request['customer_type'];

        $product = Product::where('id','=',$product_id)->get()->first();
        $application = Application::where('id','=',$application_id)->get()->first();
        $applist = $application->application;
        if ( $customer_type == "mro" ){
            $results = Mrocompany::join('contacts','contacts.companyid','mrocompanies.id')->select('mrocompanies.*','contacts.email' , 'contacts.title')->where('applist', 'like', '%,'.$application_id.',%')->get();
            

            return ['content' => (string)view('admin.result_view')->with(compact('results', 'product', 'application', 'customer_type'))];
        }elseif ( $customer_type == "airline" ){
            $results = Airline::join('contacts','contacts.airline','airlines.operator')->select('airlines.id', 'airlines.operator','airlines.aircraftSeries','airlines.engineType','airlines.engineModel','airlines.apuModel','contacts.email','contacts.title')->where(function($query) use ($applist){
                $query->where('airlines.aircraftSeries', 'LIKE', '%'.$applist.'%');
                $query->orWhere('airlines.engineType', 'LIKE', '%'.$applist.'%');
                $query->orWhere('airlines.engineModel', 'LIKE', '%'.$applist.'%');
                $query->orWhere('airlines.apuModel', 'LIKE', '%'.$applist.'%');
            })->groupby('airlines.operator','airlines.aircraftSeries','airlines.engineType','airlines.engineModel','airlines.apuModel','contacts.email','contacts.title')->get();

            
            return ['content' => (string)view('admin.result_view')->with(compact('results', 'product', 'application', 'customer_type'))];
        }elseif ( $customer_type == "all" ){
            $results = Mrocompany::join('contacts','contacts.companyid','mrocompanies.id')->select('mrocompanies.*','contacts.email' , 'contacts.title')->where('applist', 'like', '%,'.$application_id.',%')->get();

            $airline_results = Airline::join('contacts','contacts.airline','airlines.operator')->select('airlines.id','airlines.operator','airlines.aircraftSeries','airlines.engineType','airlines.engineModel','airlines.apuModel','contacts.email','contacts.title')->where(function($query) use ($applist){
                $query->where('airlines.aircraftSeries', 'LIKE', '%'.$applist.'%');
                $query->orWhere('airlines.engineType', 'LIKE', '%'.$applist.'%');
                $query->orWhere('airlines.engineModel', 'LIKE', '%'.$applist.'%');
                $query->orWhere('airlines.apuModel', 'LIKE', '%'.$applist.'%');
            })->groupby('airlines.operator','airlines.aircraftSeries','airlines.engineType','airlines.engineModel','airlines.apuModel','contacts.email','contacts.title')->get();

            return ['content' => (string)view('admin.result_view')->with(compact('results', 'airline_results', 'product', 'application', 'customer_type'))];
        }
    }
    
}
