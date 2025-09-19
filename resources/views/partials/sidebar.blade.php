
	<!--wrapper-->
	<div class="wrapper">
		<!--sidebar wrapper -->
		<div class="sidebar-wrapper" data-simplebar="true">
			<div class="sidebar-header">
				<a href="{{ route('home') }}" class="b-brand">
					<!-- Full logo (expanded sidebar) -->
					<div class="logo-full">
						@if(!empty($settings) && !empty($settings->logo))
							<img src="{{ asset('uploads/'.$settings->logo) }}" alt="Logo" class="logo-icon" style="max-height:40px; width: 150px;">
						@else
							<h4 class="logo-text">{{ $settings->name ?? '' }}</h4>
						@endif
					</div>

					<!-- Small logo (collapsed sidebar) -->
					<div class="logo-collapsed">
						@if(!empty($settings) && !empty($settings->favicon))
							<img src="{{ asset('uploads/'.$settings->favicon) }}" alt="Logo" class="logo-icon" style="max-height:40px; width: 40px;">
						@else
							<h4 class="logo-text">L</h4>
						@endif
					</div>
				</a>
				<div class="toggle-icon ms-auto"><i class='bx bx-arrow-back'></i></div>
			</div>

			<ul class="metismenu" id="menu">
				@php
					$canEmployees = auth()->user()->can('view-employees') ||
									auth()->user()->can('add-employee') ||
									auth()->user()->can('edit-employees');
				@endphp
                @if($canEmployees)
                    <li>
                        <a href="javascript:;" class="has-arrow">
                            <div class="parent-icon"><i class='bx bx-home-alt'></i>
                            </div>
                            <div class="menu-title">Employees</div>
                        </a>
                        <ul>
                            @can('view-employees')
                                <li> 
                                    <a href="{{ route('users.index') }}"><i class='bx bx-radio-circle'></i>View Employee</a>
                                </li>
                            @endcan
                            @can('add-employee')
                                <li>
                                    <a href="{{ route('users.create') }}"><i class='bx bx-radio-circle'></i>Add Employee</a>
                                </li>
                            @endcan
							@can('edit-employees')
							<li>
								<a href="{{ route('users.editIndex') }}"><i class='bx bx-radio-circle'></i>Edit Employee</a>
							</li>
							@endcan
                        </ul>
                    </li>
				@endif
			</ul>
			<!--end navigation-->
		</div>
		<!--end sidebar wrapper -->
		<!--start header -->
		<header>
			<div class="topbar d-flex align-items-center">
				<nav class="navbar navbar-expand gap-3">
					<div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
					</div>

					  <div class="search-bar d-lg-block d-none" data-bs-toggle="modal" data-bs-target="#SearchModal">
					     <a href="avascript:;" class="btn d-flex align-items-center"><i class='bx bx-search'></i>Search</a>
					  </div>

					  <div class="top-menu ms-auto">
						<ul class="navbar-nav align-items-center gap-1">
							<li class="nav-item mobile-search-icon d-flex d-lg-none" data-bs-toggle="modal" data-bs-target="#SearchModal">
								<a class="nav-link" href="avascript:;"><i class='bx bx-search'></i>
								</a>
							</li>

							<li class="nav-item dark-mode d-none d-sm-flex app-container">
								<a class="nav-link dark-mode-icon" href="javascript:;"><i class='bx bx-moon'></i>
								</a>
							</li>

                            <div class="header-notifications-list"></div>
                            <div class="header-message-list"></div>
						</ul>
					</div>
					<div class="user-box dropdown px-3">
						<a class="d-flex align-items-center nav-link dropdown-toggle gap-3 dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							<img src="{{ Auth::user()->user_photo ? asset(Auth::user()->user_photo ) : asset('uploads/user.png') }}" class="user-img" alt="user avatar">
							<div class="user-info">
								<p class="user-name mb-0">{{ Auth::user()->name ?? ''}}</p>
								<p class="designattion mb-0">{{ Auth::user()->email ?? ''}}</p>
							</div>
						</a>
						<ul class="dropdown-menu dropdown-menu-end">
							<li>
                                <a class="dropdown-item d-flex align-items-center" href="{{ route('settings.edit') }}"><i class="bx bx-cog"></i><span>Settings</span></a>
							</li>
							<li>
                                <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="bx bx-log-out-circle"></i><span>Logout</span></a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
							</li>
						</ul>
					</div>
				</nav>
			</div>
		</header>
		<!--end header -->
		<!--start overlay-->
		 <div class="overlay toggle-icon"></div>
		<!--end overlay-->
		<!--Start Back To Top Button-->
		  <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
		<!--End Back To Top Button-->
		<footer class="page-footer">
			<p class="mb-0">Copyright © 2025. All right reserved.</p>
		</footer>
	</div>
	<!--end wrapper-->