<?php

namespace App\Http\Livewire\Admin\Consultation;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Office;

use App\Models\Consultation;

class Index extends Component
{

    use WithPagination;
    public $searchTerm;

    public function render()
    {
        $searchTerm = '%' . $this->searchTerm . '%';
        return view('livewire.admin.consultation.index', [

            $offices = Office::where('user_id', auth()->user()->id)->get()->sortBy('office_name', SORT_NATURAL | SORT_FLAG_CASE)->pluck('id', 'id'),
            'consultations' =>  Consultation::whereIn('office_id',  $offices)->with('office')->with('doctor')
                ->where('response_name', 'like', $searchTerm)
                ->orWhereHas('doctor', function ($query) use ($searchTerm) {
                    $query->where('first_name', 'like', $searchTerm)
                        ->orWhere('last_name', 'like', $searchTerm);
                })
                ->orWhereHas('office', function ($query) use ($searchTerm) {
                    $query->where('office_name', 'like', $searchTerm);
                })
                ->orderBy('id', 'DESC')->paginate(10)

        ]);
    }
}
