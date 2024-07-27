<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class DocumentController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:authenticate.document.index')->only('index');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('authenticate.document.index');
    }
}
