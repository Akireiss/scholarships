<?php

namespace App\Http\Livewire;

use App\Models\Fund;
use App\Models\Student;
use Livewire\Component;
use App\Models\FundSource;
use App\Models\ScholarshipName;

class ViewForm extends Component
{
    public function render()
    {
        return view('livewire.view-form');
    }
}

