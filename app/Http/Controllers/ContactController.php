<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;
use App\Models\Contact;


class ContactController extends Controller
{
    public function index()
    {
        $title = "messages";
        $title1 = "messages";
        $nMessages = Contact::where('seen', 0)->get();
        $messages = Contact::get();

        return view('dash/messages', compact('title', 'title1', 'nMessages', 'messages'));    #return view('name of view', compact('name of variables')); 
    }

    public function showContact()
    {
        $title = "messages";
        $title1 = "messages";

        return view('includes.contact', compact('title', 'title1'));
    }


    public function storeAndSend(Request $request)
    {
        # Validate the request data
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|string|max:100|email',
            'message' => 'required|string|max:250',
        ]);

        # Store the data in the database
        Contact::create($data);

        # Send the email
        Mail::to('sarah@gmail.com')->send(new ContactMail(
            $data['email'],
            $data['name'],
            $data['message']
        ));

        return "message Data stored and email sent successfully.";
    }


    public function show(string $id)
    {
        $title = "showMessage";
        $title1 = "showMessage";
        $message = Contact::findOrFail($id); # Find the message
        $unreadCount = Contact::where('seen', 0)->count();  # Get the count of unread messages before marking as seen

        Contact::where('id',$id)->update(['seen'=> 1]);

        $nMessages = Contact::where('seen', 0)->get();  # Get the unread messages again for displaying

        return view('emails/showMessage', compact('title', 'title1', 'message','unreadCount', 'nMessages')); 
    }

    public function errMsg(){
        return [
            'name.required' => 'The name field is required.',
            'username.required' => 'The username field is required.',
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Contact::destroy($id);
        return redirect('admin/messages')->with('success', 'Beverage deleted successfully.');
    }
}
