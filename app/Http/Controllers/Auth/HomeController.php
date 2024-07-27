<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Cdp;
use App\Models\Credit;
use App\Models\File;
use App\Models\Partner;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:authenticate.home')->only('index');
    }
    public function index(){

        $Cdps = Cdp::where('status',1)->get()->count();
        $Partners = Partner::where('status',1)->get()->count();
        $Credits = Credit::where('status',1)->get()->count();
        $Documents = File::where('status',1)->get()->count();

        return view('authenticate.index',compact('Cdps','Partners','Credits','Documents'));
    }
}
