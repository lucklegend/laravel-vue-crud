<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function contacts() {
        $contacts = Contact::all();
        return response()->json(
            [
                'contacts' => $contacts,
                'message' => 'Successfully Fetch Contact Lists',
                'code' => 200
            ]

            );
    }

        public function saveContact(Request $request ) {

            $request->validate([
                'name' => 'required',
                'email' => 'required',
                'designation' => 'required',
                'contact_no' => 'required',
            ]);

            Contact::create($request->all());

            return response()->json([
                'message' => 'Contact Created Successfully',
                'code' => 200
            ]);
    }
}
