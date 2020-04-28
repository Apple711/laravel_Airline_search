<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ContentImport;
use App\Imports\ApplicationFamilyImport;

class UploadController extends Controller
{
    //
    public function index(){
        return view('upload.index');
    }

    public function import(Request $request){
        Excel::import(new ContentImport,$request->file('file'));
        // Excel::import(new ApplicationFamilyImport,$request->file('file'));
        
        // $client = new Client();
        // $crawler = $client->request('GET', 'http://tax1.co.monmouth.nj.us/cgi-bin/prc6.cgi?&ms_user=monm&passwd=data&srch_type=0&adv=0&out_type=0&district=1400');
        // $crawler = $client->click($crawler->selectLink('Sign in')->link());
        // $form = $crawler->selectButton('Sign in')->form();
        // $crawler = $client->submit($form, array('login' => 'fabpot', 'password' => 'xxxxxx'));
        // $crawler->filter('.flash-error')->each(function ($node) {
        //     print $node->text()."\n";
        // });
        
        return back();
    }
}
