<?php

namespace App\Http\Controllers;

class PagesController extends Controller{
  
  public function getIndex(){
    //return home view
    return view('pages/home');
  }
  public function getContact(){
    //return contact view
    return view('pages.contact');
  }
};