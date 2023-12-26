<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Imports\StudentsImport;
use Maatwebsite\Excel\Facades\Excel;


class ViewForm extends Component
{

    use WithFileUploads;
    public $csvfile;
    // protected $debug = true;


    public function render()
    {


        if(auth()->user()->role === 0)
            {
                return view('livewire.view-form')
                ->extends('layouts.includes.admin.index')
                ->section('content');

            } elseif(auth()->user()->role === 1)
            {
                  return view('livewire.view-form')
                  ->extends('layouts.includes.admin.index')
                  ->section('content');

            } else{

              return view('livewire.view-form')
              ->extends('layouts.includes.admin.index')
              ->section('content');

            }
    }

    public function importData()
    {
        $this->validate([
            'csvfile' => 'required|mimes:csv,txt',
        ]);

        try {
            Excel::import(new StudentsImport, $this->csvfile);

            session()->flash('success', 'Data imported successfully');
        } catch (\Exception $e) {
            session()->flash('error', 'Error importing data: ' . $e->getMessage());
        }

        $this->emit('dataImported');
    }



}



