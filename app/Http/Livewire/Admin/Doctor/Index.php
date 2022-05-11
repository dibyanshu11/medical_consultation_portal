<?php

namespace App\Http\Livewire\Admin\Doctor;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Office;
use App\Models\Doctor;

class Index extends Component
{

    use WithPagination;
    public $searchTerm;

    public function render()
    {

        $searchTerm = '%'.$this->searchTerm.'%';
        return view('livewire.admin.doctor.index', [

        $office_details = Office::where('user_id', auth()->user()->id)->get()->pluck('id', 'office_name'),
         
            'doctors' => Doctor::whereIn('office_id', $office_details)
                ->where('office_name', 'like', $searchTerm)
                ->orWhere('first_name', 'like', $searchTerm)
                ->orWhere('last_name', 'like', $searchTerm)
                ->orWhere('practice', 'like', $searchTerm)
                ->orderBy('id', 'DESC')->paginate(10),
        ]);
    }
}
