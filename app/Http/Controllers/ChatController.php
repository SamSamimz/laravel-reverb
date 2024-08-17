<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatController extends Controller
{
    //index
    public function index() {
        return view('dashboard');
    }

    //chatIndex

    public function chat($username) {
        return view('chat');
        dd($username);
    }
}