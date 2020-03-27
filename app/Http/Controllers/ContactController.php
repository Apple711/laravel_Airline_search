<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;

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
}
