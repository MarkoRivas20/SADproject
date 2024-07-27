<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Cdp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

    public function upload(Cdp $cdp, Request $request){
        
        $request->validate([
            'stock_file'=>"required",
            'stock_file.*'=>"required|file|mimes:jpeg,png,jpg,pdf,doc,docx,xls,xlsx",
        ],[
            'required' => 'El campo es obligatorio.',
            'mimes' => 'Deben ser solo archivos con formato: jpeg, png, jpg, pdf, doc, docx, xls, xlsx.'
        ]);

        foreach ($request->file('stock_file') as $file) {
            
            $url = Storage::put('/documents', $file);

            $file = $cdp->file()->create([
                'name' => $file->getClientOriginalName(),
                'url' => $url
            ]);

            $file->audit()->create([
                'user_id' => auth()->id(),
                'process' => "CREATE"
            ]);
            
        }
        return redirect()->route('authenticate.cdp.edit', $cdp)->with('info','los documentos se agregaron con éxito');
    }
}
