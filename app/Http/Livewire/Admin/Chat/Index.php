<?php

namespace App\Http\Livewire\Admin\Chat;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Chat;
use Illuminate\Support\Facades\DB;

class Index extends Component
{

    use WithPagination;
    public $searchTerm;
    public function render()
    {

       
        $searchTerm = '%' . $this->searchTerm . '%';


        $chats  = DB::table('chats')
            ->join('doctors', 'chats.doctor_id', '=', 'doctors.id')
            ->join('users', 'chats.user_id', '=', 'users.id')
         
            ->select('doctors.full_name as doctor_name', 'users.full_name as user_name','chats.created_at','chats.id')
            ->where(function($query ) use ($searchTerm)
            {
                $query->where('chats.status', '=', '1')
                ->where('doctors.full_name', 'LIKE', '%' . $searchTerm . '%' );
            })
            ->orWhere(function($query ) use ($searchTerm)
            {
                $query->where('chats.status', '=', '1')
                ->where('users.full_name', 'LIKE', '%' . $searchTerm . '%' );
            })
       
          

            ->orderBy('chats.id', 'DESC')->paginate(10);
        // dd($chats);
        return view('livewire.admin.chat.index', \compact('chats'));
    }
}
