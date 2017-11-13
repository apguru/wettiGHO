<?php

namespace App\Http\Controllers;

class PagesController extends Controller{
  
  public function getIndex(){
      return view('pages/home');
  }
  public function getContact(){
    return view('pages.contact');
  }
};