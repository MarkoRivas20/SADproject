<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Credit;
use App\Models\Partner;
use Illuminate\Http\Request;

class CreditController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:authenticate.credit.index')->only('index');
        $this->middleware('can:authenticate.credit.create')->only('create');
        $this->middleware('can:authenticate.credit.store')->only('store');
        $this->middleware('can:authenticate.credit.edit')->only('edit');
        $this->middleware('can:authenticate.credit.update')->only('update');
        $this->middleware('can:authenticate.credit.disable')->only('disable');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('authenticate.credit.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('authenticate.credit.create');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Credit $credit)
    {
        return view('authenticate.credit.edit', compact('credit'));
    }
    

    public function disable(Credit $credit)
    {
        $credit->status = false;
        $credit->update();

        $credit->audit()->create([
            'user_id' => auth()->id(),
            'process' => "DELETE"
        ]);

        return redirect()->route('authenticate.credit.index')->with('info','El crédito se eliminó con éxito');
    }

}
