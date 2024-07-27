<?php

namespace App\Livewire\Auth;

use App\Models\Document;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class MyDocumentsIndex extends Component
{
    use WithPagination;
    protected $paginationTheme='bootstrap';
    public $search;

    public function updatingSearch(){
        $this->resetPage();
    }

    public function render()
    {
        $documents = Document::where('status', true)
        ->where('name','LIKE','%'.$this->search.'%')
        ->where('user_id' , auth()->id())
        ->latest()->paginate();
            
        return view('livewire.auth.my-documents-index', compact('documents'));

        
    }
}
