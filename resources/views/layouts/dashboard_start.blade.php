<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard | {{ Auth::user()->name }}</title>
    <link rel="stylesheet" href="{{ asset('dashboard') }}/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="{{ asset('dashboard') }}/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="{{ asset('dashboard') }}/css/style.css">
    <link rel="shortcut icon" href="images/favicon.png" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('style')
</head>
<body>
    <div class="container-scroller">
        <div class="horizontal-menu">
            <nav class="navbar top-navbar col-lg-12 col-12 p-0">
                <div class="container-fluid">
                    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-between">
                        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                            <a class="navbar-brand brand-logo" href="{{ route('dashboard.start') }}"><img src="{{ asset('images/logo-text.png') }}" alt="logo"/></a>
                            <a class="navbar-brand brand-logo-mini" href="{{ route('dashboard.start') }}"><img src="{{ asset('images/logo-icon.png') }}" alt="logo"/></a>
                        </div>
                        <ul class="navbar-nav navbar-nav-right">
                            <li class="nav-item dropdown d-lg-flex d-none">
                                <a class="dropdown-toggle show-dropdown-arrow btn btn-inverse-primary btn-sm" id="nreportDropdown" href="#" data-toggle="dropdown">
                                Working Board
                                </a>
                                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="nreportDropdown">
                                    <p class="mb-0 font-weight-medium float-left dropdown-header">Project</p>
                                    <a href="{{ route('dashboard.start') }}" class="dropdown-item">
                                        <i class="mdi mdi-clipboard-account text-primary"></i>
                                        Choose Working Board
                                    </a>
                                    <a href="{{ route('dashboard.join') }}" class="dropdown-item">
                                        <i class="mdi mdi-account-key text-primary"></i>
                                        Join Working Board (Employee)
                                    </a>
                                    <a href="{{ route('project.create') }}" class="dropdown-item">
                                        <i class="mdi mdi-apps text-primary"></i>
                                        Create Working Board (Manager)
                                    </a>
                                </div>
                                </li>
                            <li class="nav-item nav-profile dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                                <span class="nav-profile-name">{{ Auth::user()->name }}</span>
                                <span class="online-status"></span>
                                <img src="{{ Auth::user()->avatar }}" alt="profile"/>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                                <a href="{{ route('dashboard.account') }}" class="dropdown-item">
                                    <i class="mdi mdi-settings text-primary"></i>
                                    My Account
                                </a>
                                <form action="{{ route('logout') }}" method="post">
                                    @csrf
                                    <button onclick="return confirm('are you sure?')" type="submit" class="dropdown-item">
                                        <i class="mdi mdi-logout text-primary"></i>
                                        Logout
                                    </button>
                                </form>
                            </div>
                            </li>
                        </ul>
                        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="horizontal-menu-toggle">
                        <span class="mdi mdi-menu"></span>
                        </button>
                    </div>
                </div>
            </nav>
        <nav class="bottom-navbar">
            <div class="container text-center">
                <p class="h2 my-3">@yield('title')</p>
            </div>
        </nav>
        </div>
		<div class="container-fluid page-body-wrapper">
			<div class="main-panel">
				<div class="content-wrapper">
					@yield('content')
				</div>
                <footer class="footer">
                    <div class="footer-wrap">
                        <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © bootstrapdash.com 2020</span>
                        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Free <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap dashboard templates</a> from Bootstrapdash.com</span>
                        </div>
                    </div>
                </footer>
			</div>
		</div>
    </div>
    <script src="{{ asset('dashboard') }}/js/vendor.bundle.base.js"></script>
    <script src="{{ asset('dashboard') }}/js/template.js"></script>
    {{-- <script src="{{ asset('dashboard') }}/js/raphael-2.1.4.min.js"></script>
	<script src="{{ asset('dashboard') }}/js/justgage.js"></script> --}}
    @yield('script')
</body>
</html>
