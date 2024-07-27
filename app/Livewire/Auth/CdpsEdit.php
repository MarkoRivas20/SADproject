<?php

namespace App\Livewire\Auth;

use App\Models\Cdp;
use App\Models\File;
use App\Models\Partner;
use Livewire\Component;
use Illuminate\Http\Request;

class CdpsEdit extends Component
{
    public Cdp $cdp;
    public $number;
    public $search;
    public $partner;
    public $show;
    public $showMessage = false;
    public $validator;
    public $files = [];

    public function mount(){
        $this->number = $this->cdp->number;
        $this->selected($this->cdp->partner);
    }

    public function getResultsProperty(){
        return Partner::where('status', true)->
        where('name', 'LIKE','%'.$this->search.'%')->
        take(5)->
        get();
    }

    public function updatedSearch(){
        if($this->search){
            $this->show = true;
        }else{
            $this->show = false;
        }
        
        $this->partner = null;
    }
    
    public function selected(Partner $partner){
        $this->search = $partner->name;
        $this->partner = $partner;
        $this->show = false;
    }

    public function update(){

        $cdp = $this->cdp;

        $request = new Request([
            'number' => $this->number,
            'socio' => $this->partner
        ]);

        $request->validate([
            'number'=>"required|unique:cdps,number,$cdp->id",
            'socio'=>'required'
        ]);

        $cdp->number = $this->number;
        $cdp->partner_id = $this->partner->id;

        $cdp->update();

        $cdp->audit()->create([
            'user_id' => auth()->id(),
            'process' => "UPDATE"
        ]);

        return redirect()->route('authenticate.cdp.index')->with('info','El CDP se actualizó con éxito');

        
    }

    public function disable(File $file){

        $file->status=false;
        $file->update();

        $file->audit()->create([
            'user_id' => auth()->id(),
            'process' => "DELETE"
        ]);

        $this->showMessage = true;

    }

    public function render()
    {
        return view('livewire.auth.cdps-edit');
    }
}
