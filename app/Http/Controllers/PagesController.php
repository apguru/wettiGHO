<?php

namespace App\Http\Controllers;

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

	//user Data Page
	public function getUserData(){
		//return Data page view
		return view('pages.userData');
	}
};