<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    // Goto Home page
    public function Home(){
        return view('pages.home');
    }

    public function Admin(){
        return view('pages.admin');
    }

    public function Login(){
        return view('pages.login');
    }

    public function DataForm(){
        return view('pages.data_entry_form');
    }

    public function Notification(){
        return view('pages.notification');
    }

    public function Notification2(){
        return view('pages.notification2');
    }
}
