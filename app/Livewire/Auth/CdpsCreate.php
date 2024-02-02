<?php

namespace App\Livewire\Auth;

use App\Models\Cdp;
use App\Models\Partner;
use Livewire\Component;
use Illuminate\Http\Request;

class CdpsCreate extends Component
{
    public $number;
    public $search;
    public $partner;
    public $show;
    public $showError = false;
    public $validator;

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

    public function save(){

        $request = new Request([
            'number' => $this->number,
            'socio' => $this->partner
        ]);

        $request->validate([
            'number'=>'required|unique:cdps',
            'socio'=>'required'
        ]);

        $cdp = new Cdp();
        $cdp->number = $this->number;
        $cdp->partner_id = $this->partner->id;

        $cdp->save();

        $cdp->audit()->create([
            'user_id' => auth()->id(),
            'process' => "CREATE"
        ]);

        return redirect()->route('authenticate.cdp.index')->with('info','El CDP se creó con éxito');

        
    }

    public function render()
    {
        return view('livewire.auth.cdps-create');
    }
}
