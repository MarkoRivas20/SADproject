<?php

namespace App\Livewire\Auth;

use App\Models\Credit;
use App\Models\Partner;
use Livewire\Component;
use Illuminate\Http\Request;

use function Laravel\Prompts\select;

class CreditsEdit extends Component
{
    public Credit $credit;
    public $number;
    public $search;
    public $partner;
    public $show;
    public $showError = false;
    public $validator;

    public function mount(){
        $this->number = $this->credit->number;
        $this->selected($this->credit->partner);
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

        $credit = $this->credit;

        $request = new Request([
            'number' => $this->number,
            'socio' => $this->partner
        ]);

        $request->validate([
            'number'=>"required|unique:credits,number,$credit->id",
            'socio'=>'required'
        ]);

        $credit->number = $this->number;
        $credit->partner_id = $this->partner->id;

        $credit->update();

        $credit->audit()->create([
            'user_id' => auth()->id(),
            'process' => "UPDATE"
        ]);

        return redirect()->route('authenticate.credit.index')->with('info','El crédito se actualizó con éxito');

        
    }

    public function render()
    {
        return view('livewire.auth.credits-edit');
    }
}
