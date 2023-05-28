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

    public function deleteContact(Request $request, $id) {
        $contact = Contact::find($id);
        if ($contact) {
            $contact->delete();
            return response()->json([
                'message' => 'Contact Successfully Deleted',
                'code' => 200
            ]);
        }
        else {
            return response()->json([
                'message' => "Contact with id: $id does not Exists"
            ]);
        }
    }

    public function getContact($id) {
        $contact = Contact::find($id);
        if ($contact) {
            return response()->json([
                'contact' => $contact,
                'message' => "Successfully Fetch Contact id: $id",
                'code' => 200
            ]);
        }
        else {
            return response()->json([
                'message' => "Contact id: $id does not exist",
            ]);
        }
    }

    public function updateContact($id, Request $request) {
        $contact = Contact::where('id', $id)->first();
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'designation' => 'required',
            'contact_no' => 'required',
        ]);

        $contact->update($request->all());

        return response()->json([
            'message' => "Contact ID: $id Update Successfully",
            'code' => 200
        ]);
    }
}
