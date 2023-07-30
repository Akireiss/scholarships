@include('layouts.header')

<div class="container-scroller">
    @include('layouts.includes.campus-NLUC.navbar')

    <div class="container-fluid page-body-wrapper">
        @include('layouts.includes.campus-NLUC.sidebar')
        <div class="main-panel">
            @yield('content')
        </div>
    </div>
</div>
@include('layouts.footer')
