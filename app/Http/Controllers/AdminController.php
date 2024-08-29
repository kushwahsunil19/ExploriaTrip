<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Session;

class AdminController extends Controller
{
 public function login(){
    return view("login");
 }

 public function login_verification(Request $request){
    $user = User::where('email','=',$request->email)->first();
    if($user){
      if($user->password == $request->password){
        return redirect('dashboard')->with('success','Login Successfully   !!!!!!!!!');
      }else{
        return redirect('admin')->with('fail','Login Failed please check password   !!!!!!!!!');
      }
    }else{
        return redirect('admin')->with('error','Login Failed please check Email   !!!!!!!!!');
    }
   
    // print_r($user);die();
 }
 public function dashboard(){
    // print_r(Session::has('LoginId'));die();
    return view('admin-dashboard');
 }



}
