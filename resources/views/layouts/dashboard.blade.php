<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard | {{ session()->get('project_name') }}</title>
    <link rel="stylesheet" href="{{ asset('dashboard') }}/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="{{ asset('dashboard') }}/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="{{ asset('dashboard') }}/css/style.css">
    <link rel="shortcut icon" href="images/favicon.png" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    @yield('style')
</head>
<body>
    <div class="container-scroller">
        <div class="horizontal-menu">
            <nav class="navbar top-navbar col-lg-12 col-12 p-0">
                <div class="container-fluid">
                    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-between">
                        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                            <a class="navbar-brand brand-logo" href="index.html"><img src="{{ asset('images/logo-text.png') }}" alt="logo"/></a>
                            <a class="navbar-brand brand-logo-mini" href="index.html"><img src="{{ asset('images/logo-icon.png') }}" alt="logo"/></a>
                        </div>
                        <p>{{ session()->get('project_name') }}</p>
                        <ul class="navbar-nav navbar-nav-right">
                            <li class="nav-item dropdown d-lg-flex d-none">
                            <a class="dropdown-toggle show-dropdown-arrow btn btn-inverse-primary btn-sm" id="nreportDropdown" href="#" data-toggle="dropdown">
                            Reports
                            </a>
                            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="nreportDropdown">
                                <p class="mb-0 font-weight-medium float-left dropdown-header">Reports</p>
                                <a class="dropdown-item">
                                    <i class="mdi mdi-file-pdf text-primary"></i>
                                    Pdf
                                </a>
                                <a class="dropdown-item">
                                    <i class="mdi mdi-file-excel text-primary"></i>
                                    Exel
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
                                <a href="{{ route('dashboard.start') }}" class="dropdown-item">
                                    <i class="mdi mdi-airballoon text-primary"></i>
                                    My Working Board
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
            <div class="container">
                <ul class="nav page-navigation">
                    <li class="nav-item {{ \Request::is('main')?'active':'' }}">
                        <a class="nav-link" href="{{ route('dashboard') }}">
                            <i class="mdi mdi-file-document-box menu-icon"></i>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item {{ \Request::is('task')?'active':'' }}">
                        <a href="{{ route('task.index') }}" class="nav-link">
                            <i class="mdi mdi-cube-outline menu-icon"></i>
                            <span class="menu-title">Tasks</span>
                        </a>
                    </li>
                    <li class="nav-item {{ \Request::is('monitoring/*')?'active':'' }}">
                        <a href="{{ route('dashboard.monitoring') }}" class="nav-link">
                            <i class="mdi mdi-chart-areaspline menu-icon"></i>
                            <span class="menu-title">Monitoring</span>
                            <i class="menu-arrow"></i>
                        </a>
                    </li>
                    <li class="nav-item {{ \Request::is('result/*')?'active':'' }}">
                        <a href="docs/documentation.html" class="nav-link">
                            <i class="mdi mdi-file-document-box-outline menu-icon"></i>
                            <span class="menu-title">Result</span></a>
                    </li>
                    <li class="nav-item {{ \Request::is('setting')?'active':'' }}">
                        <a href="{{ route('project.edit',['project'=>session('project_name')]) }}" class="nav-link">
                            <i class="mdi mdi-settings menu-icon"></i>
                            <span class="menu-title">Setting</span></a>
                    </li>
                </ul>
            </div>
        </nav>
        </div>
    <!-- partial -->
		<div class="container-fluid page-body-wrapper">
			<div class="main-panel">
				<div class="content-wrapper">
					@yield('content')
				</div>
				<!-- content-wrapper ends -->
				<!-- partial:partials/_footer.html -->
		<footer class="footer">
            <div class="footer-wrap">
                <div class="d-sm-flex justify-content-center justify-content-sm-between">
                <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © bootstrapdash.com 2020</span>
                <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Free <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap dashboard templates</a> from Bootstrapdash.com</span>
                </div>
            </div>
        </footer>
				<!-- partial -->
			</div>
			<!-- main-panel ends -->
		</div>
		<!-- page-body-wrapper ends -->
    </div>
		<!-- container-scroller -->
    <!-- base:js -->
    <script src="{{ asset('dashboard') }}/js/vendor.bundle.base.js"></script>
    <script src="{{ asset('dashboard') }}/js/template.js"></script>
    {{-- <script src="vendors/chart.js/Chart.min.js"></script>
    <script src="vendors/progressbar.js/progressbar.min.js"></script> --}}
	{{-- <script src="{{ asset('dashboard') }}/js/chartjs-plugin-datalabels.js"></script> --}}
	{{-- <script src="vendors/justgage/raphael-2.1.4.min.js"></script>
	<script src="vendors/justgage/justgage.js"></script> --}}
    {{-- <script src="{{ asset('dashboard') }}/js/jquery.min.js"></script> --}}
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    @yield('script')
</body>
</html>
