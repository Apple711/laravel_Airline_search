<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Product;
use App\Application;
use App\Mrocompany;
use App\Contact;
use App\Airline;
use App\Appfamily;

class HomeController extends Controller
{
    //
    public function index(){
        $products = Product::all();
        $current_product = "";
        $current_appfamily = "";
        $current_application = "";
        $company_type = "";
        return view("admin.home", compact('products','current_product','current_appfamily','current_application','company_type'));
    }

    public function search(Request $request){
        $product_id = $request['product_id'];
        $appfamily_id = $request['appfamily_id'];
        $application_id = $request['application_id'];
        $customer_type = $request['customer_type'];

        $product = Product::where('id','=',$product_id)->get()->first();
        $appfamily = Appfamily::where('id','=',$appfamily_id)->get()->first();
        $application = "";
        if ($application_id){
            $application = Application::where('id','=',$application_id)->get()->first();
            $applist = $application->application;
        }else{
            $applist = $appfamily->appfamily;
        }
        
        
        if ( $customer_type == "mro" ){
            if ($application_id){
                $results = Mrocompany::leftjoin('contacts','contacts.companyid','mrocompanies.id')->select('mrocompanies.*','contacts.email' , 'contacts.title')->where('applist', 'like', '%'.$application_id.',%')->get();
            }else{
                $results = Mrocompany::leftjoin('contacts','contacts.companyid','mrocompanies.id')->select('mrocompanies.*','contacts.email' , 'contacts.title')->where('appfamilylist', 'like', '%'.$appfamily_id.',%')->get();
            }
            
            return ['content' => (string)view('admin.result_view')->with(compact('results', 'product', 'appfamily', 'application', 'customer_type'))];
        }elseif ( $customer_type == "airline" ){
            $results = Airline::leftjoin('contacts','contacts.airline','airlines.operator')->select('airlines.country', 'airlines.operator','airlines.aircraftFamily','airlines.aircraftSeries','airlines.engineType','airlines.engineModel','airlines.apuModel','contacts.email','contacts.title')->where(function($query) use ($applist){
                $query->where('airlines.aircraftFamily', 'LIKE', '%'.$applist.'%');
                $query->orwhere('airlines.aircraftSeries', 'LIKE', '%'.$applist.'%');
                $query->orWhere('airlines.engineType', 'LIKE', '%'.$applist.'%');
                $query->orWhere('airlines.engineModel', 'LIKE', '%'.$applist.'%');
                $query->orWhere('airlines.apuModel', 'LIKE', '%'.$applist.'%');
            })->groupby('airlines.country', 'airlines.operator','airlines.aircraftFamily','airlines.aircraftSeries','airlines.engineType','airlines.engineModel','airlines.apuModel','contacts.email','contacts.title')->get();

            
            return ['content' => (string)view('admin.result_view')->with(compact('results', 'product', 'appfamily', 'application', 'customer_type'))];
        }elseif ( $customer_type == "all" ){
            if ($application_id){
                $results = Mrocompany::leftjoin('contacts','contacts.companyid','mrocompanies.id')->select('mrocompanies.*','contacts.email' , 'contacts.title')->where('applist', 'like', '%'.$application_id.',%')->get();
            }else{
                $results = Mrocompany::leftjoin('contacts','contacts.companyid','mrocompanies.id')->select('mrocompanies.*','contacts.email' , 'contacts.title')->where('appfamilylist', 'like', '%'.$appfamily_id.',%')->get();
            }

            $airline_results = Airline::leftjoin('contacts','contacts.airline','airlines.operator')->select('airlines.country', 'airlines.operator','airlines.aircraftFamily','airlines.aircraftSeries','airlines.engineType','airlines.engineModel','airlines.apuModel','contacts.email','contacts.title')->where(function($query) use ($applist){
                $query->where('airlines.aircraftFamily', 'LIKE', '%'.$applist.'%');
                $query->orwhere('airlines.aircraftSeries', 'LIKE', '%'.$applist.'%');
                $query->orWhere('airlines.engineType', 'LIKE', '%'.$applist.'%');
                $query->orWhere('airlines.engineModel', 'LIKE', '%'.$applist.'%');
                $query->orWhere('airlines.apuModel', 'LIKE', '%'.$applist.'%');
            })->groupby('airlines.country', 'airlines.operator','airlines.aircraftFamily','airlines.aircraftSeries','airlines.engineType','airlines.engineModel','airlines.apuModel','contacts.email','contacts.title')->get();
            
            return ['content' => (string)view('admin.result_view')->with(compact('results', 'airline_results', 'product', 'appfamily', 'application', 'customer_type'))];
        }
    }

    public function getAppfamily(Request $request)
    {
        $id = $request['id'];
        $appfamily = Appfamily::where('productid','=',$id)->get();
        return ['appfamily' => $appfamily];
    }

    public function getApplication(Request $request)
    {
        $id = $request['id'];
        $applications = Application::where('appfamilyid','=',$id)->get();
        return ['applications' => $applications];
    }
    
}
