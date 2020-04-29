<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;
use App\Mrocompany;
use App\Airline;
use App\Product;
use App\Appfamily;
use App\Application;

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

    public function edit($id, $company_name, $type,$p_id, $af_id, $ap_id, $c_type)
    {
        if ($type == "MRO"){
            $contacts = Contact::where('companyid', '=', $id)->get();
        }else{
            $country = $id;
            $contacts = Contact::where([['airline', '=', $company_name], ['country', '=', $country]])->get();
        }
        $company['id'] = $id;
        $company['type'] = $type;
        $company['name'] = $company_name;

        $current_product = $p_id;
        $current_appfamily = $af_id;
        $current_application = $ap_id;
        $company_type = $c_type;
        
        return view('contactEdit', compact('company', 'contacts', 'current_product', 'current_appfamily', 'current_application','company_type'));
    }

    public function store(Request $request, $id, $company_name, $type){
        if ($type == "MRO"){
            $results = Mrocompany::where('id',$id)->get()->first();
            $country = $results['country'];
        }else{
            $country = $id;
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
        
        $products = Product::all();
        $current_product = $request['current_product'];
        $appfamily = Appfamily::where('productid','=',$current_product)->get();
        $current_appfamily = $request['current_appfamily'];
        $applications = Application::where('appfamilyid','=',$current_appfamily)->get();
        $current_application = $request['current_application']=="null" ? "" : $request['current_application'];
        $company_type = $request['company_type'];
        return view("admin.home", compact('products','current_product','appfamily','current_appfamily','applications','current_application','company_type'));
    }
}
