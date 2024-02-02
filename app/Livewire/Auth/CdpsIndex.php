<?php

namespace App\Livewire\Auth;

use App\Models\Cdp;
use Livewire\Component;
use Livewire\WithPagination;

class CdpsIndex extends Component
{
    use WithPagination;
    protected $paginationTheme='bootstrap';
    public $search;

    public function updatingSearch(){
        $this->resetPage();
    }
    public function render()
    {
        $cdps = Cdp::where('status', true)
        ->where('number','LIKE','%'.$this->search.'%')
        ->latest('id')->paginate();
        return view('livewire.auth.cdps-index', compact('cdps'));
    }
}
