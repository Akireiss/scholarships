@include('layouts.header')

<div class="container-scroller">
    @include('layouts.includes.admin.navbar')

    <div class="container-fluid page-body-wrapper">
        @include('layouts.includes.admin.sidebar')
        <div class="main-panel">
            @yield('content')
        </div>
    </div>
</div>
@include('layouts.footer')
