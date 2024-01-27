<?php

namespace App\Livewire\Auth;

use App\Models\Partner;
use Livewire\Component;
use Livewire\WithPagination;

class PartnersIndex extends Component
{
    use WithPagination;
    protected $paginationTheme='bootstrap';
    public $search;

    public function updatingSearch(){
        $this->resetPage();
    }

    public function render()
    {
        $partners = Partner::where('status', true)
        ->where('name','LIKE','%'.$this->search.'%')
        ->latest('id')->paginate();
        return view('livewire.auth.partners-index', compact('partners'));
    }
}
