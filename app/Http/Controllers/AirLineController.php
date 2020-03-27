<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Airline;
use App\Product;
use App\Application;
use App\Mrocompany;
use App\Contact;


class AirLineController extends Controller
{
    //
    public function index(){
        $airlines = Airline::select('operator','country')->groupBy('operator','country')->get();
        return view('airline.index', compact('airlines'));
    }

    public function edit($company_name, $country){
        
        $contacts = Contact::where([['airline', '=', $company_name], ['country', '=', $country]])->get();

        $total_lists = Airline::select('aircraftFamily', DB::raw('count(aircraftFamily) as total'))->where([['operator', '=', $company_name], ['country', '=', $country]])->groupby('aircraftFamily')->get();

        $app_lists = Airline::select('registration','aircraftFamily','aircraftSeries','engineType','engineModel','apuModel')->where([['operator', '=', $company_name], ['country', '=', $country]])->groupby('registration','aircraftFamily','aircraftSeries','engineType','engineModel','apuModel')->get();

        return view('airline.airlineEdit', compact('company_name', 'country', 'contacts', 'total_lists', 'app_lists'));

    }

    public function store(Request $request){
        $company_name = $request['company_name'];
        $country = $request['country'];
        if ( $request['contact_name'] ){
            $contactNames = $request['contact_name'];
            $contactEmails = $request['contact_email'];
            $contactTitles = $request['contact_title'];
            
            foreach ( $contactNames as $key=>$contactName ){
                $contact = new Contact();
                
                $contact->name = $contactName;
                $contact->email = $contactEmails[$key];
                $contact->title = $contactTitles[$key];
                $contact->airline = $company_name;
                $contact->country = $country;
                $contact->save();
            }
        }

        $airlines = Airline::select('operator','country')->groupBy('operator','country')->get();
        return view('airline.index', compact('airlines'));

    }

    public function destroy($company_name, $country)
    {
        $company = Airline::where([['operator', '=', $company_name], ['country', '=', $country]]);
        $company->delete();
        
        $contacts = Contact::where([['airline', '=', $company_name], ['country', '=', $country]]);
        if($contacts){
            $contacts->delete();
        }
        return redirect('Airline');
    }
}
