<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:authenticate.home')->only('index');
    }
    public function index(){
        return view('authenticate.index');
    }
}
