<nav class="nxl-navigation">
        <div class="navbar-wrapper">
            <div class="m-header">
                <a href="{{ route('home') }}" class="b-brand">
                    @if(!empty($settings) && !empty($settings->logo))
                        <!-- Display uploaded logo -->
                        <img src="{{ asset('uploads/'.$settings->logo) }}" alt="Logo" class="logo logo-lg" style="max-height:40px;" />
                        <img src="{{ asset('uploads/'.$settings->logo) }}" alt="Small Logo" class="logo logo-sm" style="max-height:30px;" />
                    @else
                        <!-- Fallback default logos -->
                        <h1 class="logo logo-lg">{{ $settings->name ?? '' }}</h1>
                        <h1 class="logo logo-sm">{{ $settings->name ?? ''}}</h1>
                    @endif
                </a>
            </div>

            <div class="navbar-content">
                <ul class="nxl-navbar">
                    <li class="nxl-item nxl-caption">
                        <label>Navigation</label>
                    </li>   
                    
                    @can('user-list')
                        <li class="nxl-item">
                            <a class="nav-link nxl-link" href="{{ route('users.index') }}">
                                <span class="nxl-micon"><i class="feather-airplay"></i></span>
                                <span class="nxl-mtext">Manage Users</span>
                            </a>
                        </li>
                    @endcan                    
                             
                    @can('role-list')
                        <li class="nxl-item">
                            <a class="nav-link nxl-link" href="{{ route('roles.index') }}">
                                <span class="nxl-micon"><i class="feather-airplay"></i></span> 
                                <span class="nxl-mtext">Manage Roles</span>                                
                            </a>
                        </li>
                    @endcan

                    <li class="nxl-item">
                        <a class="nav-link nxl-link" href="{{ route('sales.index') }}">
                            <span class="nxl-micon"><i class="feather-truck"></i></span> 
                            <span class="nxl-mtext">Sales</span>                                
                        </a>
                    </li>

                    <li class="nxl-item">
                        <a class="nav-link nxl-link" href="{{ route('vehicle.index') }}">
                            <span class="nxl-micon"><i class="feather-truck"></i></span> 
                            <span class="nxl-mtext">Vehicles</span>                                
                        </a>
                    </li>
                    
                    <li class="nxl-item">
                        <a class="nav-link nxl-link" href="{{ route('settings.edit') }}">
                            <span class="nxl-micon"><i class="feather-settings"></i></span> 
                            <span class="nxl-mtext">Settings</span>                                
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
    <header class="nxl-header">
        <div class="header-wrapper">
            <!--! [Start] Header Left !-->
            <div class="header-left d-flex align-items-center gap-4">
                <!--! [Start] nxl-head-mobile-toggler !-->
                <a href="javascript:void(0);" class="nxl-head-mobile-toggler" id="mobile-collapse">
                    <div class="hamburger hamburger--arrowturn">
                        <div class="hamburger-box">
                            <div class="hamburger-inner"></div>
                        </div>
                    </div>
                </a>
                <!--! [Start] nxl-head-mobile-toggler !-->
                <!--! [Start] nxl-navigation-toggle !-->
                <div class="nxl-navigation-toggle">
                    <a href="javascript:void(0);" id="menu-mini-button">
                        <i class="feather-align-justify"></i>
                    </a>
                    <a href="javascript:void(0);" id="menu-expend-button" style="display: none">
                        <i class="feather-arrow-right"></i>
                    </a>
                </div>
                <!--! [End] nxl-navigation-toggle !-->
                <!--! [Start] nxl-lavel-mega-menu-toggle !-->
                <!--! [End] nxl-lavel-mega-menu-toggle !-->
                <!--! [Start] nxl-lavel-mega-menu !-->
                <div class="nxl-drp-link nxl-lavel-mega-menu">
                    <div class="nxl-lavel-mega-menu-toggle d-flex d-lg-none">
                        <a href="javascript:void(0)" id="nxl-lavel-mega-menu-hide">
                            <i class="feather-arrow-left me-2"></i>
                            <span>Back</span>
                        </a>
                    </div>
                </div>
                <!--! [End] nxl-lavel-mega-menu !-->
            </div>
            <!--! [End] Header Left !-->
            <!--! [Start] Header Right !-->
            <div class="header-right ms-auto">
                <div class="d-flex align-items-center">
                    <div class="dropdown nxl-h-item nxl-header-search">
                        <a href="javascript:void(0);" class="nxl-head-link me-0" data-bs-toggle="dropdown" data-bs-auto-close="outside">
                            <i class="feather-search"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end nxl-h-dropdown nxl-search-dropdown">
                            <div class="input-group search-form">
                                <span class="input-group-text">
                                    <i class="feather-search fs-6 text-muted"></i>
                                </span>
                                <input type="text" class="form-control search-input-field" placeholder="Search...." />
                                <span class="input-group-text">
                                    <button type="button" class="btn-close"></button>
                                </span>
                            </div>
                            <div class="dropdown-divider mt-0"></div>
                            <div class="search-items-wrapper">
                                <div class="searching-for px-4 py-2">
                                    <p class="fs-11 fw-medium text-muted">I'm searching for...</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="nxl-h-item d-none d-sm-flex">
                        <div class="full-screen-switcher">
                            <a href="javascript:void(0);" class="nxl-head-link me-0" onclick="$('body').fullScreenHelper('toggle');">
                                <i class="feather-maximize maximize"></i>
                                <i class="feather-minimize minimize"></i>
                            </a>
                        </div>
                    </div>
                    <div class="nxl-h-item dark-light-theme">
                        <a href="javascript:void(0);" class="nxl-head-link me-0 dark-button">
                            <i class="feather-moon"></i>
                        </a>
                        <a href="javascript:void(0);" class="nxl-head-link me-0 light-button" style="display: none">
                            <i class="feather-sun"></i>
                        </a>
                    </div>
                    <div class="dropdown nxl-h-item">
                        <a href="javascript:void(0);" data-bs-toggle="dropdown" role="button" data-bs-auto-close="outside">
                            <img src="{{ Auth::user()->user_photo ? asset('uploads/users/'. Auth::user()->user_photo ) : asset('uploads/user.png') }}" alt="user-image" class="img-fluid user-avtar me-0" />
                        </a>
                        <div class="dropdown-menu dropdown-menu-end nxl-h-dropdown nxl-user-dropdown">
                            <div class="dropdown-header">
                                <div class="d-flex align-items-center">
                                    <img src="{{ Auth::user()->user_photo ? asset('uploads/users/'. Auth::user()->user_photo ) : asset('uploads/user.png') }}" alt="user-image" class="img-fluid user-avtar" />
                                    <div>
                                        <a href="{{ route('users.edit', Auth::user()->id) }}">
                                            <h6 class="text-dark mb-0">{{ Auth::user()->name ?? ''}}</h6>
                                        </a>
                                        <span class="fs-12 fw-medium text-muted">{{ Auth::user()->email ?? ''}}</span>
                                    </div>
                                </div>
                            </div>
                            <!-- <a href="./auth-login-minimal.html" class="dropdown-item"> -->
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="feather-log-out"></i> Logout </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            <!-- </a> -->
                        </div>
                    </div>
                </div>
            </div>  
            <!--! [End] Header Right !-->
        </div>
    </header>