<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('authenticate.partner.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        return view('authenticate.partner.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'register'=>'required|unique:partners',
            'name'=>'required',
            'document'=>'required|unique:partners'
        ]);

        $partner = Partner::create($request->all());

        $partner->audit()->create([
            'user_id' => auth()->id(),
            'process' => "CREATE"
        ]);

        return redirect()->route('authenticate.partner.index')->with('info','El socio se creó con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(Partner $partner)
    {
        return view('authenticate.partner.show', compact('partner'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Partner $partner)
    {

        return view('authenticate.partner.edit', compact('partner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Partner $partner)
    {
        $request->validate([
            'register'=>"required|unique:partners,register,$partner->id",
            'name'=>'required',
            'document'=>"required|unique:partners,document,$partner->id"
        ]);

        $partner->update($request->all());

        $partner->audit()->create([
            'user_id' => auth()->id(),
            'process' => "UPDATE"
        ]);

        return redirect()->route('authenticate.partner.index')->with('info','El socio se actualizó con éxito');
    }

    public function disable(Partner $partner){
        $partner->status = false;
        $partner->update();

        return redirect()->route('authenticate.partner.index')->with('info','El socio se eliminó con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Partner $partner)
    {
        return redirect()->route('authenticate.partner.index')->with('info','Esta función no está habilitada');
        
    }
}
