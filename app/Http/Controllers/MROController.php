<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Application;
use App\Mrocompany;
use App\Contact;
use App\Appfamily;

class MROController extends Controller
{
    //
    public function index(){
        $companys = Mrocompany::all();
        return view("mro.index", compact('companys'));
    }

    public function create()
    {
        $products = Product::all();
        return view('mro.mroAdd', compact('products'));
    }

    public function getApplication(Request $request)
    {
        $id = $request['id'];
        $applications = Application::where('productid','=',$id)->get();
        return ['applications' => $applications];
    }

    public function edit($id){
        $company = Mrocompany::where('id',$id)->get()->first();
        $contacts = Contact::where('companyid', '=', $id)->get();

        $appidLists = explode(',',$company->applist);
        $appLists = Application::join('products', 'applications.productid', '=', 'products.id')->select('applications.*','products.family')->where('applications.id',$appidLists[0]);
        
        for ( $i=1; $i<count($appidLists); $i++){
            if ($appidLists[$i]){
                $appLists = $appLists->orwhere('applications.id',$appidLists[$i]);
            }
        }
        $appLists = $appLists->get();
        $products = Product::all();
        return view('mro.mroEdit', compact('company', 'products', 'contacts', 'appLists'));
    }
    public function store(Request $request)
    {
        $temp = "";
        $familytemp = "";
        $pre_familylist = "";

        $company = new Mrocompany();
        $company->company = $request['company'];
        $company->country = $request['country'];
        $appLists = $request['app_list'];
        foreach ( $appLists as $key=>$applist ){
            $temp.= $applist.",";
            $result = Application::where('id','=',$applist)->get()->first();
            if ($key==0){
                $familytemp = $result->appfamilyid.",";
                $pre_familylist = $result->appfamilyid;
            }else{
                if ($pre_familylist != $result->appfamilyid){
                    $familytemp.= $result->appfamilyid.",";
                }
                $pre_familylist = $result->appfamilyid;
            }
        }
        $company->applist = $temp;
        $company->appfamilylist = $familytemp;
        $company->save();
        $company_id = $company->id;
        if ( $request['contact_name'] ){
            $contactNames = $request['contact_name'];
            $contactEmails = $request['contact_email'];
            $contactTitles = $request['contact_title'];
            
            foreach ( $contactNames as $key=>$contactName ){
                $contact = new Contact();
                $contact->companyid = $company_id;
                $contact->name = $contactName;
                $contact->email = $contactEmails[$key];
                $contact->title = $contactTitles[$key];
                $contact->save();
            }
        }

        // $companys = Mrocompany::all();
        return redirect('MRO');
    }

    public function update(Request $request, $id){
        $temp = "";
        $familytemp = "";
        $pre_familylist = "";

        $company = Mrocompany::findOrFail($id);
        $company->company = $request['company'];
        $company->country = $request['country'];
        $appLists = $request['app_list'];
        foreach ( $appLists as $key=>$applist ){
            $temp.= $applist.",";
            $result = Application::where('id','=',$applist)->get()->first();
            if ($key==0){
                $familytemp = $result->appfamilyid.",";
                $pre_familylist = $result->appfamilyid;
            }else{
                if ($pre_familylist != $result->appfamilyid){
                    $familytemp.= $result->appfamilyid.",";
                }
                $pre_familylist = $result->appfamilyid;
            }
        }
        $company->applist = $temp;
        $company->appfamilylist = $familytemp;
        $company->save();

        if ( $request['contact_name'] ){
            $contactNames = $request['contact_name'];
            $contactEmails = $request['contact_email'];
            $contactTitles = $request['contact_title'];
            
            foreach ( $contactNames as $key=>$contactName ){
                $contact = new Contact();
                $contact->companyid = $id;
                $contact->name = $contactName;
                $contact->email = $contactEmails[$key];
                $contact->title = $contactTitles[$key];
                $contact->save();
            }
        }

       
        return redirect('MRO');
    }

    public function destroy($id)
    {
        $company = Mrocompany::find($id);
        $company->delete();
        
        $contact = Contact::where('companyid',$id);
        $contact->delete();

        return redirect('MRO');
    }
}
