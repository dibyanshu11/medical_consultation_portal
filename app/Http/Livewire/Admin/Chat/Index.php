<?php

namespace App\Http\Livewire\Admin\Chat;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Chat;
use App\Models\ChatData;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\BinaryOp\Concat;

class Index extends Component
{

    use WithPagination;
    public $searchTerm;
    public function render()
    {

        // dd("helooooo");
        $searchTerm = '%' . $this->searchTerm . '%';

        return view('livewire.admin.chat.index', [
            // 'chats' =>   Searchkeydatas::with('doctor','user')->latest()->paginate(10)
            'chats' =>   Chat::whereHas('doctor', function ($query) use ($searchTerm) {
                $query->where('full_name', 'like', $searchTerm);
            })
                ->orWhereHas('user', function ($query) use ($searchTerm) {
                    $query->where('full_name', 'like', $searchTerm);
                })
                ->orderBy('id', 'DESC')->paginate(10)
        ]);
    }
}
