<?php

namespace App\Livewire\Auth;

use App\Models\Document;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class DocumentsIndex extends Component
{

    use WithPagination;
    protected $paginationTheme='bootstrap';
    public $search;

    public function updatingSearch(){
        $this->resetPage();
    }

    public function render()
    {
        $user = User::where('id',auth()->id())->role('Admin')->get();

        if(empty($user)){
            $documents = Document::where('status', true)
            ->where('name','LIKE','%'.$this->search.'%')
            ->latest()->paginate();
        }else{
            $documents = User::find(auth()->id())->documents()
            ->where('status', true)
            ->where('name','LIKE','%'.$this->search.'%')
            ->where('documents.user_id', '!=' , auth()->id())
            ->latest()->paginate();
        }
        
        return view('livewire.auth.documents-index', compact('documents'));

        
    }
}
