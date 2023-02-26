<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Record;


class RecordPagination extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $from_date = "";
    public $to_date = "";

    public $orderColumn = "parking_cost";
    public $sortOrder = "asc";

    public function updated(){
        $this->resetPage();
    }

    public function render()
    {
        $Record = Record::orderby($this->orderColumn,$this->sortOrder)->select('*');
           if(!empty($this->from_date) && !empty($this->to_date)){
                $Record->whereBetween('exit_time', [$this->from_date, $this->to_date]);
           }
           $Record = $Record->paginate(10);

           return view('livewire.record-pagination', [
               'Record' => $Record,
           ]);
    }
}
