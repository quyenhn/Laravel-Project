<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use Illuminate\Support\Facades\Input;
class PagesController extends Controller
{
    public function index()
    {   
    	return redirect('/articles');
    }
}
