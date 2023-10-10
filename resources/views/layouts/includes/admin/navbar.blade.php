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

                <!-- Notification -->

            <li class="nav-item dropdown me-lg-5">
                <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#"
                    data-bs-toggle="dropdown">
                    <i class="mdi mdi-bell-outline"></i>
                    <span class="count-symbol bg-danger"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-start navbar-dropdown preview-list"
                    aria-labelledby="notificationDropdown">
                    <h6 class="p-3 mb-0">Notifications</h6>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item preview-item">
                        <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                            <h6 class="preview-subject font-weight-bold mb-1">Event today</h6>
                            <p class="text-gray ellipsis mb-0"> Just a reminder that you have an event today </p>
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <h6 class="p-3 mb-0 text-center">See all notifications</h6>
                </div>
            </li>

            <!-- it ends here -->
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
