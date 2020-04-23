<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;
use App\Mrocompany;
use App\Airline;
use App\Product;

class ContactController extends Controller
{
    //
    public function destroy(Request $request)
    {
        $id = $request['id'];
        $contact = Contact::find($id);
        $contact->delete();
        return "true";
    }

    public function edit($id, $type)
    {
        if ($type == "MRO"){
            $results = Mrocompany::where('id',$id)->get()->first();
            $contacts = Contact::where('companyid', '=', $id)->get();
            $company_name = $results['company'];
        }else{
            $results = Airline::where('id',$id)->get()->first();
            $company_name = $results['operator'];
            $country = $results['country'];
            $contacts = Contact::where([['airline', '=', $company_name], ['country', '=', $country]])->get();
        }
        $company['id'] = $id;
        $company['type'] = $type;
        $company['name'] = $company_name;
        return view('contactEdit', compact('company', 'contacts'));
    }

    public function store(Request $request, $id, $type){
        ;
        if ($type = "MRO"){
            $results = Mrocompany::where('id',$id)->get()->first();
            $company_name = $results['company'];
            $country = $results['country'];
        }else{
            $results = Airline::where('id',$id)->get()->first();
            $company_name = $results['operator'];
            $country = $results['country'];
        }
        
        if ( $request['contact_name'] ){
            $contactNames = $request['contact_name'];
            $contactEmails = $request['contact_email'];
            $contactTitles = $request['contact_title'];
            
            foreach ( $contactNames as $key=>$contactName ){
                $contact = new Contact();
                if ($type == "MRO"){
                    $contact->companyid = $id;
                    $contact->name = $contactName;
                    $contact->email = $contactEmails[$key];
                    $contact->title = $contactTitles[$key];
                }else{
                    $contact->name = $contactName;
                    $contact->email = $contactEmails[$key];
                    $contact->title = $contactTitles[$key];
                    $contact->airline = $company_name;
                    $contact->country = $country;
                }
                
                $contact->save();
            }
        }
        
        return redirect('/');
    }
}
