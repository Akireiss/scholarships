@extends('layouts.includes.admin.index')

@section('content')

@if(request()->routeIs('scholar.government'))
<livewire:addScholar />
@elseif(request()->routeIs('scholar.private'))
<livewire:addScholar />
@elseif (request()->routeIs('scholar.govermentActive'))
<livewire:addScholar />
@elseif(request()->routeIs('scholar.privateActive'))
<livewire:addScholar />
@endif

@endsection
