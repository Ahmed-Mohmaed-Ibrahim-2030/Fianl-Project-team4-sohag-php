<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use Mail;

class ContactUsFormController extends Controller
{
        // Create Contact Form
    public function createForm(Request $request) {
        // return view('contact');
    }
    // Store Contact Form data
    public function ContactUsForm(Request $request) {
        // Form validation
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'subject'=>'required',
            'message' => 'required'
            ]);
            // dd($request->all());
        //  Store data in database
        Contact::create($request->all());
        // // Send mail to admin
        // \Mail::raw(
        //     ('name'. ":". $request->get('name').",".
        //     // 'email'. ":". $request->get('email').",".
        //     'phone'. ":". $request->get('phone').",".
        //     'subject'. ":" .$request->get('subject').",".
        //     'user_query'. ":". $request->get('message').",")
        // , function($message) use ($request){
        //     $message->from($request->email);
        //     $message->to('me0950277@gmail.com', 'Admin')->subject($request->get('subject'));
        // });
        // return back()->with('success', 'We have received your message and would like to thank you for writing to us.');
        return response()->json([
            'stautus'=>true,
            'message'=>'We have received your message and would like to thank you for writing to us.',
        ],201);
    }
    public function contactForm(){
        $contacts=Contact::all();
        return view('AdminDashboard.contacts',compact('contacts'));
    }
}
