<?php

namespace App\Livewire\Auth;

use App\Models\Credit;
use Livewire\Component;
use Livewire\WithPagination;

class CreditsIndex extends Component
{
    use WithPagination;
    protected $paginationTheme='bootstrap';
    public $search;

    public function updatingSearch(){
        $this->resetPage();
    }

    public function render()
    {
        $credits = Credit::where('status', true)
        ->where('number','LIKE','%'.$this->search.'%')
        ->latest('id')->paginate();
        return view('livewire.auth.credits-index', compact('credits'));
    }
}
