<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        if(Auth::user()->role == 'student') {
            return view('homepage.student');
        } else{
            return view('homepage.admin');
        }
    }
}
