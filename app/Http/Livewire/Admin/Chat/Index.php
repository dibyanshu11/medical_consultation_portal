<?php

namespace App\Http\Livewire\Admin\Chat;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Chat;
use App\Models\Searchkeydatas;
use Illuminate\Support\Facades\Auth;

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
            'chats' =>   Searchkeydatas::whereHas('doctor', function ($query) use ($searchTerm) {
                $query->where('full_name', 'like', $searchTerm);
            })
                ->orWhereHas('user', function ($query) use ($searchTerm) {
                    $query->where('first_name', 'like', $searchTerm)
                        ->orWhere('last_name', 'like', $searchTerm);
                })
                ->orderBy('id', 'DESC')->paginate(10)


            // 'chats' =>  Chat::where('chat', 'like', $searchTerm)
            //     ->orWhereHas('doctor', function ($query) use ($searchTerm) {
            //         $query->where('first_name', 'like', $searchTerm)
            //             ->orWhere('last_name', 'like', $searchTerm);
            //     })
            //     ->orWhereHas('user', function ($query) use ($searchTerm) {
            //         $query->where('first_name', 'like', $searchTerm)
            //         ->orWhere('last_name', 'like', $searchTerm);
            //     })
            //     ->orderBy('id', 'DESC')->paginate(10)



        ]);
    }
}
