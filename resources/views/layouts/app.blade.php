<!doctype html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta content="Hogo– Creative Admin Multipurpose Responsive Bootstrap4 Dashboard HTML Template" name="description">
		<meta content="Spruko Technologies Private Limited" name="author">
		<meta name="keywords" content="html admin template, bootstrap admin template premium, premium responsive admin template, admin dashboard template bootstrap, bootstrap simple admin template premium, web admin template, bootstrap admin template, premium admin template html5, best bootstrap admin template, premium admin panel template, admin template"/>

		<!-- Favicon -->
		<link rel="icon" href="{{asset('assets/images/brand/favicon.ico')}}" type="image/x-icon"/>
		<link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/images/brand/favicon.ico')}}" />

		<!-- Title -->
		<title>Agata</title>

		<!--Bootstrap.min css-->
		<link rel="stylesheet" href="{{asset('assets/plugins/bootstrap/css/bootstrap.min.css')}}">

		<!-- Dashboard css -->
		<link href="{{asset('assets/css/style.css')}}" rel="stylesheet" />

		<!-- Custom scroll bar css-->
    <link href="{{asset('assets/plugins/scroll-bar/jquery.mCustomScrollbar.css')}}" rel="stylesheet" />

		<!-- Sidemenu css -->
		<link href="{{asset('assets/plugins/toggle-sidebar/full-sidemenu-dark.css')}}" rel="stylesheet" />

		<!-- Rightsidebar css -->
		<link href="{{asset('assets/plugins/sidebar/sidebar.css')}}" rel="stylesheet">

		<!---Font icons css-->
		<link href="{{asset('assets/plugins/iconfonts/plugin.css')}}" rel="stylesheet" />
		<link href="{{asset('assets/plugins/iconfonts/icons.css')}}" rel="stylesheet" />
		<link  href="{{asset('assets/fonts/fonts/font-awesome.min.css')}}" rel="stylesheet">

        <!--bootstrap  select css -->
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

        <!-- Date Picker css-->
		<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet" />
		<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.standalone.min.css" rel="stylesheet" />

        @stack('css')

		{{-- JS para odenar las columnas de las tablas con flechas descendente y ascendente --}}
		<style>
			table tr th {
			cursor: pointer;
			}

			.sorting {
			background-color: #D4D4D4;
			}

			.asc:after {
			content: ' ↑';
			}

			.desc:after {
			content: " ↓";
			}
		</style>

	</head>

	<body class="app sidebar-mini rtl">

		<!--Global-Loader-->
		<div id="global-loader">
			<img src="{{ asset('assets/images/icons/loader.svg')}}" alt="loader">
		</div>

		<div class="page">
			<div class="page-main">
				<!--app-header-->
				<div class="app-header header d-flex">
					<div class="container-fluid">
						<div class="d-flex">
						    <a class="header-brand" href="{{ route('home') }}">
								<img src="https://stratecsa.com/assets/images/logov3.png" class="header-brand-img main-logo img-fluid" alt="logo">
							</a><!-- logo-->
							<a aria-label="Hide Sidebar" class="app-sidebar__toggle" data-toggle="sidebar" href="#"></a>


							<div class="d-flex order-lg-2 ml-auto header-rightmenu">
								<div class="dropdown">
									<a  class="nav-link icon full-screen-link" id="fullscreen-button">
										<i class="fe fe-maximize-2"></i>
									</a>
								</div><!-- full-screen -->
								{{-- <div class="dropdown header-notify">
									<a class="nav-link icon" data-toggle="dropdown" aria-expanded="false">
										<i class="fe fe-bell "></i>
										<span class="pulse bg-success"></span>
									</a>
									<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow ">
										<a href="#" class="dropdown-item text-center">4 New Notifications</a>
										<div class="dropdown-divider"></div>
										<a href="#" class="dropdown-item d-flex pb-3">
											<div class="notifyimg bg-green">
												<i class="fe fe-mail"></i>
											</div>
											<div>
												<strong>Message Sent.</strong>
												<div class="small text-muted">12 mins ago</div>
											</div>
										</a>
										<a href="#" class="dropdown-item d-flex pb-3">
											<div class="notifyimg bg-pink">
												<i class="fe fe-shopping-cart"></i>
											</div>
											<div>
												<strong>Order Placed</strong>
												<div class="small text-muted">2  hour ago</div>
											</div>
										</a>
										<a href="#" class="dropdown-item d-flex pb-3">
											<div class="notifyimg bg-blue">
												<i class="fe fe-calendar"></i>
											</div>
											<div>
												<strong> Event Started</strong>
												<div class="small text-muted">1  hour ago</div>
											</div>
										</a>
										<a href="#" class="dropdown-item d-flex pb-3">
											<div class="notifyimg bg-orange">
												<i class="fe fe-monitor"></i>
											</div>
											<div>
												<strong>Your Admin Lanuch</strong>
												<div class="small text-muted">2  days ago</div>
											</div>
										</a>
										<div class="dropdown-divider"></div>
										<a href="#" class="dropdown-item text-center">View all Notifications</a>
									</div>
								</div><!-- notifications --> --}}

								<div class="dropdown header-user">
									<a class="nav-link leading-none siderbar-link"  data-toggle="sidebar-right" data-target=".sidebar-right">
										<span class="mr-3 d-none d-lg-block ">
											<span class="text-gray-white"><span class="ml-2">{{ \Auth()->user()->name }}</span></span>
										</span>
										<span class="avatar avatar-md brround"><img src="{{ asset('assets/images/users/1.png')}}" alt="Profile-img" class="avatar avatar-md brround"></span>
									</a>
									<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
										<div class="header-user text-center mt-4 pb-4">
											<span class="avatar avatar-xxl brround"><img src="{{ asset('assets/images/users/1.png')}}" alt="Profile-img" class="avatar avatar-xxl brround"></span>
											<a href="#" class="dropdown-item text-center font-weight-semibold user h3 mb-0">
                                                {{ \Auth()->user()->name }}
                                            </a>
											{{-- <small> {{ \Auth()->user()->employee->position->name }}</small> --}}
										</div>

										<a class="dropdown-item" href="#">
											<i class="dropdown-icon mdi mdi-account-outline "></i> Spruko technologies
										</a>
										<a class="dropdown-item" href="#">
											<i class="dropdown-icon  mdi mdi-account-plus"></i> Add another Account
										</a>
										<div class="card-body border-top">
											<div class="row">
												<div class="col-6 text-center">
													<a class="" href=""><i class="dropdown-icon mdi  mdi-message-outline fs-30 m-0 leading-tight"></i></a>
													<div>Inbox</div>
												</div>
												<div class="col-6 text-center">
													<a class="" href=""><i class="dropdown-icon mdi mdi-logout-variant fs-30 m-0 leading-tight"></i></a>
													<div>Sign out</div>
												</div>
											</div>
										</div>
									</div>
								</div><!-- profile -->
								<div class="dropdown">
									<a  class="nav-link icon siderbar-link" data-toggle="sidebar-right" data-target=".sidebar-right">
										<i class="fe fe-more-horizontal"></i>
									</a>
								</div><!-- Right-siebar-->
							</div>
						</div>
					</div>
				</div>
				<!--app-header end-->

				<!-- Sidebar menu-->
				<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
				<aside class="app-sidebar toggle-sidebar">
					<div class="app-sidebar__user pb-0">
						<div class="user-body">
							<span class="avatar avatar-xxl brround text-center cover-image" data-image-src="{{ asset('assets/images/users/1.png')}}"></span>
						</div>
						<div class="user-info">
							<a href="#" class="ml-2"><span class="text-dark app-sidebar__user-name font-weight-semibold">
                                {{ \Auth()->user()->name }}
                            </span><br>
								<span class="text-muted app-sidebar__user-name text-sm">
                                    {{-- {{ \Auth()->user()->employee->position->name }} --}}
                                </span>
							</a>
						</div>
					</div>

					<div class="tab-menu-heading siderbar-tabs border-0  p-0">
						<div class="tabs-menu ">
							<!-- Tabs -->
							@if(Auth()->check() && Auth()->user()->role_id != 2)
							<ul class="nav panel-tabs">
								<li>
                                    <a href="{{ route('home') }}" class="loading">
                                        <i class="fa fa-home fs-17"></i>
                                    </a>
                                </li>
								{{-- <li>
                                    <a href="{{ route('users.show', \Auth()->user()->id ) }}">
                                        <i class="fa fa-envelope fs-17"></i>
                                    </a>
                                </li> --}}
								<li>
                                    <a href="{{ route('users.show', \Auth()->user()->id ) }}">
                                        <i class="fa fa-user fs-17"></i>
                                    </a>
                                </li>
								<li>
                                    <a href="{{ route('logout') }}" title="logout">
                                        <i class="fa fa-power-off fs-17"></i>
                                    </a>
                                </li>
							</ul>
							@else 
								<ul class="nav panel-tabs">
									<li>
										<a href="{{ route('customer.home') }}" class="loading">
											<i class="fa fa-home fs-17"></i>
										</a>
									</li>
									{{-- <li>
										<a href="{{ route('users.show', \Auth()->user()->id ) }}">
											<i class="fa fa-envelope fs-17"></i>
										</a>
									</li> --}}
									<li>
										<a href="{{ route('users.show', \Auth()->user()->id ) }}">
											<i class="fa fa-user fs-17"></i>
										</a>
									</li>
									<li>
										<a href="{{ route('logout') }}" title="logout">
											<i class="fa fa-power-off fs-17"></i>
										</a>
									</li>
								</ul>

							@endif
						</div>
					</div>
					<div class="panel-body tabs-menu-body side-tab-body p-0 border-0 ">
						<div class="tab-content">
							<div class="tab-pane active " id="index1">
								{{-- karen --}}
                                @if(in_array(Auth()->user()->role_id, [2, 3, 7, 8]))
                                    @component('componentes.sidebar_customer')
                                    @endcomponent
                                @else
                                    @component('componentes.sidebar')
                                    @endcomponent
                                @endif
							</div>
						</div>
					</div>
				</aside>
				<!--sidemenu end-->

                <!-- app-content-->
				<div class="app-content  my-3 my-md-5 toggle-content">
                    <div class="side-app">
                        {{-- contenido --}}
                        @include('sweetalert::alert')

                        @yield('content')

                        <!-- Right-sidebar-->
                        <div class="sidebar sidebar-right sidebar-animate">

                            <div class="panel-body tabs-menu-body side-tab-body p-0 border-0 ">
                                <div class="tab-content border-top">
                                    <div class="tab-pane active " id="tab">
                                        <div class="card-body p-0">
                                            <div class="header-user text-center mt-4 pb-4">
                                                <span class="avatar avatar-xxl brround"><img src="{{ asset('assets/images/users/1.png')}}" alt="Profile-img" class="avatar avatar-xxl brround"></span>
                                                <div class="dropdown-item text-center font-weight-semibold user h3 mb-0">
                                                    {{ \Auth()->user()->name }}
                                                </div>
                                                {{-- <small>{{ \Auth()->user()->employee->position->name }}</small> --}}
                                            </div>
                                            <div class="card-body border-top">
                                                <div class="row">
                                                    <div class="col-4 text-center">
                                                        <a class="" href="{{ route('home') }}">
                                                            <i class="dropdown-icon mdi  mdi-message-outline fs-30 m-0 leading-tight"></i>
                                                        </a>
                                                        <div>Inicio</div>
                                                    </div>
                                                    <div class="col-4 text-center">
                                                        <a class="loading" href="{{ route('users.show', \Auth()->user()->id) }}">
                                                            <i class="dropdown-icon mdi mdi-tune fs-30 m-0 leading-tight"></i>
                                                        </a>
                                                        <div>Perfil</div>
                                                    </div>
                                                    <div class="col-4 text-center">
                                                        <a class="loading" href="{{ route('logout') }}">
                                                            <i class="dropdown-icon mdi mdi-logout-variant fs-30 m-0 leading-tight"></i>
                                                        </a>
                                                        <div>Cerrar sesión</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- End Rightsidebar-->

                        <!--footer-->
                        <footer class="footer">
                            <div class="container">
                                <div class="row align-items-center flex-row-reverse">
                                    <div class="col-lg-12 col-sm-12   text-center">
                                        {{-- Copyright © {{ date("Y") }}  --}}
                                        {{-- <a href="#">Agata</a>.  --}}
                                        Desarrollado por <a href="https://stratecsa.com/">Stratecsa</a>.
                                    </div>
                                </div>
                            </div>
                        </footer>
                    </div>
					<!-- End Footer-->

				</div>
				<!-- End app-content-->
			</div>
		</div>
		<!-- End Page -->

		<!-- Back to top -->
		<a href="#top" id="back-to-top"><i class="fa fa-angle-up"></i></a>

		<!-- Jquery js-->
		<script src="{{ asset('assets/js/vendors/jquery-3.2.1.min.js')}}"></script>

		<!--Bootstrap.min js-->
		<script src="{{ asset('assets/plugins/bootstrap/popper.min.js')}}"></script>
		<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>

		<!-- Star Rating js-->
		<script src="{{ asset('assets/plugins/rating/jquery.rating-stars.js')}}"></script>

		<!--Side-menu js-->
		<script src="{{ asset('assets/plugins/toggle-sidebar/sidemenu.js')}}"></script>

		<!-- Sidebar Accordions js -->
		<script src="{{ asset('assets/plugins/accordion1/js/easyResponsiveTabs.js')}}"></script>

		<!-- Custom scroll bar js-->
		<script src="{{ asset('assets/plugins/scroll-bar/jquery.mCustomScrollbar.concat.min.js')}}"></script>

		<!-- Rightsidebar js -->
		<script src="{{ asset('assets/plugins/sidebar/sidebar.js')}}"></script>

		<!-- Custom js-->
		<script src="{{ asset('assets/js/custom.js')}}"></script>
        <script src="https://kit.fontawesome.com/f2b23d5285.js" crossorigin="anonymous"></script>

          <!--Seootstrap-select lect2 js -->
          <script src=" https://unpkg.com/@popperjs/core@2"></script>
          <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

          <!-- Datepicker js -->
          <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

          {{-- --app js --}}
          <script src="{{ asset('assets/js/app.js')}}"></script>
            <script>
                $(document).ready(function() {
                    @if ($errors->any() && Session::has('modal'))
                        $('#{{ Session::get('modal') }}').modal('show');
                    @endif
                });
                $('form.frmDestroy').submit(function(e) {
                    if (!confirm('¿Está seguro que desea eliminar este registro?'))
                    { e.preventDefault(); }
                    else { openLoader(); }
                });
            </script>
			{{-- JS para odenar las columnas de las tablas con flechas descendente y ascendente --}}
			<script>
					$('th').click(function() {
					var table = $(this).parents('table').eq(0)
					var rows = table.find('tr:gt(0)').toArray().sort(comparer($(this).index()))
					this.asc = !this.asc
					if (!this.asc) {
					rows = rows.reverse()
					}
					for (var i = 0; i < rows.length; i++) {
					table.append(rows[i])
					}
					setIcon($(this), this.asc);
				})

				function comparer(index) {
					return function(a, b) {
					var valA = getCellValue(a, index),
						valB = getCellValue(b, index)
					return $.isNumeric(valA) && $.isNumeric(valB) ? valA - valB : valA.localeCompare(valB)
					}
				}

				function getCellValue(row, index) {
					return $(row).children('td').eq(index).html()
				}

				function setIcon(element, asc) {
					$("th").each(function(index) {
					$(this).removeClass("sorting");
					$(this).removeClass("asc");
					$(this).removeClass("desc");
					});
					element.addClass("sorting");
					if (asc) element.addClass("asc");
					else element.addClass("desc");
				}
			</script>
        @stack('script')

	</body>
</html>











