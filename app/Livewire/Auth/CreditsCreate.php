<?php

namespace App\Livewire\Auth;

use App\Models\Credit;
use App\Models\Partner;
use Illuminate\Http\Request;
use Livewire\Component;

class CreditsCreate extends Component
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
            'number'=>'required|unique:credits',
            'socio'=>'required'
        ]);

        $credit = new Credit();
        $credit->number = $this->number;
        $credit->partner_id = $this->partner->id;

        $credit->save();

        $credit->audit()->create([
            'user_id' => auth()->id(),
            'process' => "CREATE"
        ]);

        return redirect()->route('authenticate.credit.index')->with('info','El crédito se creó con éxito');

        
    }

    public function render()
    {
        return view('livewire.auth.credits-create');
    }
}
