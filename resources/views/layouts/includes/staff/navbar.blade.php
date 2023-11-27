{{-- navbar here --}}
<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row bg.gradrient{success}">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo" href="index.html"><img src="{{ asset('assets/images/logo.png') }}"
                alt="logo" /></a>
        <a class="navbar-brand brand-logo-mini" href="index.html"><img src="{{ asset('assets/images/logo-min.png') }}"
                alt="logo-mini" /></a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-stretch">
        <button class="navbar-toggler navbar-toggler align-self-center font-weight-bold text-dark" type="button"
            data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
        </button>
        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-profile dropdown">
                <li>
                    <div class="nav-profile-text px-2">
                        <p class="mb-1 text-dark font-weight-bold">{{ auth()->user()->name }}</p>
                        <p  class="mb-1 text-dark font-weight-light text-center">{{ auth()->user()->getRoleText() }}</p>
                    </div>
                </li>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
            data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
        </button>
    </div>
</nav>
