<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Credit;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

    public function upload(Credit $credit, Request $request){
        
        $request->validate([
            'stock_file'=>"required",
            'stock_file.*'=>"required|file|mimes:jpeg,png,jpg,pdf,doc,docx,xls,xlsx",
        ],[
            'required' => 'El campo es obligatorio.',
            'mimes' => 'Deben ser solo archivos con formato: jpeg, png, jpg, pdf, doc, docx, xls, xlsx.'
        ]);

        foreach ($request->file('stock_file') as $file) {
            
            $url = Storage::put('/documents', $file);

            $file = $credit->file()->create([
                'name' => $file->getClientOriginalName(),
                'url' => $url
            ]);

            $file->audit()->create([
                'user_id' => auth()->id(),
                'process' => "CREATE"
            ]);
            
        }
        return redirect()->route('authenticate.credit.edit', $credit)->with('info','los documentos se agregaron con éxito');
    }

}
