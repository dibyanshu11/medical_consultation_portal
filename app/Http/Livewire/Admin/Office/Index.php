<?php

namespace App\Http\Livewire\Admin\Office;
use Livewire\WithPagination;
use App\Models\Office;

use Livewire\Component;

class Index extends Component
{

    use WithPagination;
    public $searchTerm;

    public function render()
    {

        $searchTerm = '%'.$this->searchTerm.'%';

    
        return view('livewire.admin.office.index',[

            'offices'=> Office::where('user_id', auth()->user()->id)
            ->where('office_name','like', $searchTerm)
            ->orWhere('address','like', $searchTerm)
            ->orderBy('id', 'DESC')->paginate(10),
        ]);
      
    }
}
