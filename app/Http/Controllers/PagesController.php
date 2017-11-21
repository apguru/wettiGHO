<?php

namespace App\Http\Controllers;
 
use Mail;
use Session;
use Illuminate\Http\Request;
use App\Http\Requests;

class PagesController extends Controller{

    //Home Page
	public function getIndex(){
	    //return home view
		return view('pages/home');
	}

	//Contact Page
	public function getContact(){
		//return contact view
		return view('pages.contact');
	}
	
	public function postContact(Request $request){
		//validate the Data
		$this->validate($request, [
          'email' => 'required|email',
          'betreff' => 'required',
          'nachricht'=>'required',
        ]);
        
        $data = [
        	'email' => $request->email,
        	'betreff'=>$request->betreff,
        	'nachricht'=>$request->nachricht
        	];
        	
        Mail::send('emails.contact', $data, function($message) use ($data){
        	$message->from($data['email']);
        	$message->to('support@wettiGHO.de');
        	$message->subject($data['betreff']);
        });
        
        Session::flash('success', 'Nachricht erfolgreich übermittelt');
        
        return redirect(route("pages.welcome"));
	}

	//user Data Page
	public function getUserData(){
		//return Data page view
		return view('pages.userData');
	}
};