<?php

namespace App\Http\Controllers;
use App\Article;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index()
    {   
    	return redirect('/articles');
    }

    
}
