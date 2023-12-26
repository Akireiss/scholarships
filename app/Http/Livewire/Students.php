<?php

namespace App\Http\Livewire;

use Variables;
use App\Models\Student;
use Livewire\Component;

class Students extends Component
{
    public $students;


public function render()
{
   if(auth()->user()->role === 0)
   {
    return view('livewire.students')->extends('layouts.includes.staff.index')->section('content');
   } elseif(auth()->user()->role === 1)
   {
    return view('livewire.students')->extends('layouts.includes.admin.index')->section('content');
   } else{
    return view('livewire.students')->extends('layouts.includes.campus-NLUC.index')->section('content');
   }
}

}
