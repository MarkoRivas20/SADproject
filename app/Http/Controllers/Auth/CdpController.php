<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Cdp;
use Illuminate\Http\Request;

class CdpController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:authenticate.cdp.index')->only('index');
        $this->middleware('can:authenticate.cdp.create')->only('create');
        $this->middleware('can:authenticate.cdp.store')->only('store');
        $this->middleware('can:authenticate.cdp.edit')->only('edit');
        $this->middleware('can:authenticate.cdp.update')->only('update');
        $this->middleware('can:authenticate.cdp.disable')->only('disable');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('authenticate.cdp.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('authenticate.cdp.create');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cdp $cdp)
    {
        return view('authenticate.cdp.edit', compact('cdp'));
    }
    

    public function disable(Cdp $cdp)
    {
        $cdp->status = false;
        $cdp->update();

        $cdp->audit()->create([
            'user_id' => auth()->id(),
            'process' => "DELETE"
        ]);

        return redirect()->route('authenticate.cdp.index')->with('info','El CDP se eliminó con éxito');
    }
}
