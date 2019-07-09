<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        $friends = Auth::user()->friends();
        return view('chat.index', compact('friends'));
    }
}
