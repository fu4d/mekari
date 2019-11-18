<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class UserController extends Controller
{
    //index
    public function index(){
    	$data['user'] = User::all();
        return view('pages.user',$data);
    }
}
