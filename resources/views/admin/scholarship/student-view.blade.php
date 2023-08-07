@extends('layouts.includes.admin.index')

@section('content')

    @livewire('student-data', ['students' => $students, 'sourceName' => $sourceName])

@endsection
