	<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="x-ua-compatible" content="ie=edge">

		<title>@yield('title') - {{ siteOption('sitename') }}</title>
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<meta name="base-url" content="{{ url('') }}">
		<meta name="page-url" content="{{ url(Request::segment(1) ?? '') }}">
		<meta name="current-url" content="{{ Request::url() }}">
		<link rel="icon" href="{{ siteOptionLogo('16') }}" type="image/gif" sizes="16x16">

		<link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
		{{-- plugin --}}
		<link rel="stylesheet" href="{{ asset('') }}plugins/daterangepicker/daterangepicker.css">
		<link rel="stylesheet" href="{{ asset('') }}plugins/icheck-bootstrap/icheck-bootstrap.min.css">
		<link rel="stylesheet" href="{{ asset('') }}plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
		<link rel="stylesheet" href="{{ asset('') }}plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
		<link rel="stylesheet" href="{{ asset('') }}plugins/select2/css/select2.min.css">
		<link rel="stylesheet" href="{{ asset('') }}plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
		<link rel="stylesheet" href="{{ asset('') }}plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
		<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
		<link rel="stylesheet" href="{{ asset('') }}plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
		<link rel="stylesheet" href="{{ asset('') }}plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
		<link rel="stylesheet" href="{{ asset('') }}plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
		<link rel="stylesheet" href="{{ asset('') }}plugins/toastr/toastr.min.css">
		<link rel="stylesheet" href="{{ asset('') }}plugins/ladda/ladda.min.css">
		<link rel="stylesheet" href="{{ asset('') }}plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
		{{-- end plugin --}}
		<link rel="stylesheet" href="{{ asset('css/adminlte.css') }}">
		<link rel="stylesheet" href="{{ asset('css/custom.css') }}">
		<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
		@stack('style')
	</head>
	@php
	$customizeTheme = siteOption('customize_themes');
	@endphp
	<body class="hold-transition {{ json_decode($customizeTheme ?? "{}", true)['body'] ?? 'sidebar-mini layout-fixed layout-navbar-fixed' }}">
	<div class="wrapper">
		<!-- Navbar -->
		<nav class="{{ json_decode($customizeTheme ?? "{}", true)['main-header'] ?? 'main-header navbar navbar-expand navbar-white navbar-light' }}">
			<!-- Left navbar links -->
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
				</li>
			</ul>

			<!-- Right navbar links -->
			<ul class="navbar-nav ml-auto">
				<li class="nav-item">
					<a class="nav-link" data-widget="control-sidebar" data-slide="true" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" role="button" >
						<i class="fas fa-sign-out-alt"></i> Logout
					</a>
					<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
							@csrf
					</form>
				</li>
			</ul>
		</nav>
		<!-- /.navbar -->

		<!-- Main Sidebar Container -->
		<aside class="{{ json_decode($customizeTheme ?? "{}", true)['main-sidebar'] ?? 'main-sidebar sidebar-dark-primary elevation-4' }}">
			<!-- Brand Logo -->
			<a href="index3.html" class="{{ json_decode($customizeTheme ?? "{}", true)['brand-link'] ?? 'brand-link' }}">
				<img src="{{ siteOptionLogo('250') }}" alt="AdminLTE Logo" class="brand-image" style="opacity: .8">
				<span class="brand-text font-weight-light">{{ siteOption('sitename') }}</span>
			</a>

			<!-- Sidebar -->
			<div class="sidebar">
				<!-- Sidebar user panel (optional) -->
				<div class="user-panel mt-3 pb-3 mb-3 d-flex">
					<div class="image">
						<img src="{{ fotoProfile() }}" class="img-circle elevation-1" alt="User Image">
					</div>
					<div class="info">
						<a href="#" class="d-block">{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}</a>
					</div>
				</div>

				<!-- Sidebar Menu -->
				<nav id="sidebar-menu" class="mt-2">
					<ul class="{{ json_decode($customizeTheme ?? "{}", true)['nav-sidebar'] ?? 'nav nav-pills nav-sidebar flex-column' }}" data-widget="treeview" role="menu" data-accordion="false">
						<li class="nav-item">
							<a href="{{ url('/dashboard') }}" class="nav-link">
								<i class="nav-icon fas fa-th"></i>
								<p>
									Dashboard
								</p>
							</a>
						</li>
						@php
							$listMenu = Auth::user()->menu();
						@endphp
						@foreach ($listMenu as $menu)
							@if (is_null($menu->submenu))
								<li class="nav-item">
									<a href="{{ url($menu->link) }}" class="nav-link">
										<i class="nav-icon {{ $menu->icon }}"></i>
										<p>
											{{ $menu->menu_name }}
										</p>
									</a>
								</li>
							@else
								<li class="nav-item has-treeview">
									<a href="#" class="nav-link">
										<i class="nav-icon {{ $menu->icon }}"></i>
										<p>
											{{ $menu->menu_name }}
											<i class="right fas fa-angle-left"></i>
										</p>
									</a>
									<ul class="nav nav-treeview">
										@foreach ($menu->submenu as $submenu)
											<li class="nav-item">
												<a href="{{ url($submenu->link) }}" class="nav-link">
													<i class="far fa-circle nav-icon"></i>
													<p>
														{{ $submenu->menu_name }}
													</p>
												</a>
											</li>
										@endforeach
									</ul>
								</li>
							@endif
						@endforeach
					</ul>
				</nav>
				<!-- /.sidebar-menu -->
			</div>
			<!-- /.sidebar -->
		</aside>

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			@yield('content')
		</div>
		<!-- /.content-wrapper -->

		<!-- Main Footer -->
		<footer class="{{ json_decode($customizeTheme ?? "{}", true)['main-footer'] ?? 'main-footer' }}">
			<!-- To the right -->
			<div class="float-right d-none d-sm-inline">
				Anything you want
			</div>
			<!-- Default to the left -->
			<strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
		</footer>
	</div>
	<!-- ./wrapper -->

	<!-- REQUIRED SCRIPTS -->

	<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
	<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
	{{-- plugin --}}
	<script src="{{ asset('') }}plugins/select2/js/select2.full.min.js"></script>
	<script src="{{ asset('') }}plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
	<script src="{{ asset('') }}plugins/moment/moment.min.js"></script>
	<script src="{{ asset('') }}plugins/moment/locale/id.js"></script>
	<script src="{{ asset('') }}plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
	<script src="{{ asset('') }}plugins/daterangepicker/daterangepicker.js"></script>
	<script src="{{ asset('') }}plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
	<script src="{{ asset('') }}plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
	<script src="{{ asset('') }}plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
	<script src="{{ asset('') }}plugins/datatables/jquery.dataTables.min.js"></script>
	<script src="{{ asset('') }}plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
	<script src="{{ asset('') }}plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
	<script src="{{ asset('') }}plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
	<script src="{{ asset('') }}plugins/parsley/dist/parsley.min.js"></script>
	<script src="{{ asset('') }}plugins/parsley/dist/i18n/id.js"></script>
	<script src="{{ asset('') }}plugins/sweetalert2/sweetalert2.min.js"></script>
	<script src="{{ asset('') }}plugins/toastr/toastr.min.js"></script>
	<script src="{{ asset('') }}plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
	<script src="{{ asset('') }}plugins/ladda/spin.min.js"></script>
	<script src="{{ asset('') }}plugins/ladda/ladda.min.js"></script>
	<script src="{{ asset('') }}plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
	{{-- end plugin --}}
	<script src="{{ asset('js/adminlte.js') }}"></script>
	<script src="{{ asset('js/custom.js') }}"></script>
	@stack('script')
	</body>
	</html>
