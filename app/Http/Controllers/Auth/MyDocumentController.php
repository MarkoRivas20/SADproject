<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MyDocumentController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:authenticate.mydocument.index')->only('index');
        $this->middleware('can:authenticate.mydocument.create')->only('create');
        $this->middleware('can:authenticate.mydocument.store')->only('store');
        $this->middleware('can:authenticate.mydocument.disable')->only('disable');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('authenticate.mydocument.index');
    }

    public function create()
    {
        $users = User::all();
        return view('authenticate.mydocument.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'document'=>"required",
            'document.*'=>"required|file|mimes:jpeg,png,jpg,pdf,doc,docx,xls,xlsx",
        ],[
            'required' => 'El campo es obligatorio.',
            'mimes' => 'Deben ser solo archivos con formato: jpeg, png, jpg, pdf, doc, docx, xls, xlsx.'
        ]);

        if ($request->hasFile('document')) {
            //$document = Document::create($request->all());

            $document = new Document();
            $document->name =$request->name;
            $document->user_id = auth()->id();
            $document->save();

            $url = Storage::put('/documents', $request->file('document'));

            $file = $document->file()->create([
                'name' => $request->file('document')->getClientOriginalName(),
                'url' => $url
            ]);

            $document->audit()->create([
                'user_id' => auth()->id(),
                'process' => "CREATE"
            ]);

            $document->users()->sync($request->users);

        }

        
        return redirect()->route('authenticate.mydocument.index')->with('info','el documento se agregó con éxito');
    }

    public function edit(Document $mydocument)
    {
        $users = User::all();
        return view('authenticate.mydocument.edit', compact('mydocument','users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Document $mydocument)
    {

        $mydocument->users()->sync($request->users);
        
        return redirect()->route('authenticate.mydocument.index')->with('info','El documento se actualizó con éxito');
    }


    public function disable(Document $document)
    {
        $document->status = false;
        $document->update();

        $document->audit()->create([
            'user_id' => auth()->id(),
            'process' => "DELETE"
        ]);

        return redirect()->route('authenticate.mydocument.index')->with('info','El Documento se eliminó con éxito');
    }
}
