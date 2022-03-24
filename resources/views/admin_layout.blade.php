<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<meta name="csrf-token" content="{{ csrf_token() }}">
		@yield('title')
		<meta name="description" content="overview &amp; stats" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="{{asset('public/assets/css/bootstrap.min.css')}}" />
		<link rel="stylesheet" href="{{asset('public/assets/font-awesome/4.2.0/css/font-awesome.min.css')}}" />
		@yield('css')
		<!-- text fonts -->
		<link rel="stylesheet" href="{{asset('public/assets/fonts/fonts.googleapis.com.css')}}" />
		<!-- ace styles -->
		<link rel="stylesheet" href="{{asset('public/assets/css/ace.min.css')}}" class="ace-main-stylesheet" id="main-ace-style" />
		<!-- ace settings handler -->
		<script src="{{asset('public/assets/js/ace-extra.min.js')}}"></script>
		<style>
			.btn:focus,
			.btn:active {
				outline: none !important;
				box-shadow: none;
			}
			.page-link:focus,
			.page-link:active {
				outline: none !important;
				box-shadow: none;
			}
			.text-truncate-container {
				overflow: hidden;
				text-overflow: ellipsis;
				white-space: nowrap;
			}
			.view-article-accept img {
				width: 100%;
			}
		</style>
	</head>

	<body class="no-skin">
		<div id="navbar" class="navbar navbar-default">
			<script type="text/javascript">
				try{ace.settings.check('navbar' , 'fixed')}catch(e){}
			</script>

			<div class="navbar-container" id="navbar-container">
				<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
					<span class="sr-only">Toggle sidebar</span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>
				</button>

				<div class="navbar-header pull-left">
					<a href="{{URL::to('/dashboard')}}" class="navbar-brand">
						<small>
							<i class="fa fa-wrench" aria-hidden="true"></i>
							Admin
						</small>
					</a>
					<a href="{{URL::to('/')}}" class="navbar-brand" target="_blank">
						<small>
							<i class="fa fa-home" aria-hidden="true"></i>
							Home
						</small>
					</a>
				</div>

				<div class="navbar-buttons navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav">

						<li class="light-blue">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
								<img class="nav-user-photo" src="{{URL::to('public/assets/avatars/admin.png')}}" alt="Jason's Photo" />
								<span class="user-info">
									<small>Xin chào,</small>
									<?php
										$name = Auth::user()->admin_name;
										if($name) {
											echo $name;
										}
									?>
								</span>

								<i class="ace-icon fa fa-caret-down"></i>
							</a>

							<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
								<li>
									<a href="{{URL::to('logout')}}">
										<i class="ace-icon fa fa-power-off"></i>
										Đăng xuất
									</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</div><!-- /.navbar-container -->
		</div>

		<div class="main-container" id="main-container">
			<script type="text/javascript">
				try{ace.settings.check('main-container' , 'fixed')}catch(e){}
			</script>

			<div id="sidebar" class="sidebar                  responsive">
				<script type="text/javascript">
					try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
				</script>

				<div class="sidebar-shortcuts" id="sidebar-shortcuts">
					<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
						<button class="btn btn-success">
							<i class="ace-icon fa fa-signal"></i>
						</button>

						<button class="btn btn-info">
							<i class="ace-icon fa fa-pencil"></i>
						</button>

						<button class="btn btn-warning">
							<i class="ace-icon fa fa-users"></i>
						</button>

						<button class="btn btn-danger">
							<i class="ace-icon fa fa-cogs"></i>
						</button>
					</div>

					<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
						<span class="btn btn-success"></span>

						<span class="btn btn-info"></span>

						<span class="btn btn-warning"></span>

						<span class="btn btn-danger"></span>
					</div>
				</div><!-- /.sidebar-shortcuts -->

				<ul class="nav nav-list">
					<li class="active">
						<a href="{{URL::to('/dashboard')}}">
							<i class="menu-icon fa fa-tachometer"></i>
							<span class="menu-text"> Dashboard </span>
						</a>

						<b class="arrow"></b>
					</li>
					@hasrole(['user'])
					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-list"></i>
							<span class="menu-text"> Danh mục</span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="">
								<a href="{{URL::to('/add-category-users')}}">
									<i class="menu-icon fa fa-caret-right"></i>
									Thêm danh mục
								</a>

								<b class="arrow"></b>
							</li>

							<li class="">
								<a href="{{URL::to('/list-category-users')}}">
									<i class="menu-icon fa fa-caret-right"></i>
									Danh sách danh mục
								</a>

								<b class="arrow"></b>
							</li>
						</ul>
					</li>
					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-list-alt"></i>
							<span class="menu-text"> Danh mục con </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="">
								<a href="{{URL::to('/add-type-users')}}">
									<i class="menu-icon fa fa-caret-right"></i>
									Thêm danh mục con
								</a>

								<b class="arrow"></b>
							</li>

							<li class="">
								<a href="{{URL::to('/list-type-users')}}">
									<i class="menu-icon fa fa-caret-right"></i>
									Danh sách danh mục con
								</a>

								<b class="arrow"></b>
							</li>
						</ul>
					</li>
					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-newspaper-o"></i>
							<span class="menu-text"> Bài viết </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="">
								<a href="{{URL::to('/add-new-users')}}">
									<i class="menu-icon fa fa-caret-right"></i>
									Thêm bài viết
								</a>

								<b class="arrow"></b>
							</li>

							<li class="">
								<a href="{{URL::to('/list-new-users')}}">
									<i class="menu-icon fa fa-caret-right"></i>
									Danh sách bài viết
								</a>

								<b class="arrow"></b>
							</li>
						</ul>
					</li>
					@endhasrole
					@impersonate
					<li class="">
						<a href="{{URL::to('/impersonate-destroy')}}">
							<i class="menu-icon fa fa-stop"></i>
							<span class="menu-text"> Dừng chuyển quyền </span>
						</a>

						<b class="arrow"></b>
					</li>
					@endimpersonate

					@hasrole(['admin'])
					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-list"></i>
							<span class="menu-text"> Menu </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							
							<li class="">
								<a href="{{URL::to('/list-position-menu')}}">
									<i class="menu-icon fa fa-caret-right"></i>
									Quản lý menu
								</a>

								<b class="arrow"></b>
							</li>
						</ul>
					</li>
					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-list"></i>
							<span class="menu-text"> Danh mục </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							
							<li class="">
								<a href="{{URL::to('/add-category')}}">
									<i class="menu-icon fa fa-caret-right"></i>
									Thêm danh mục
								</a>

								<b class="arrow"></b>
							</li>

							<li class="">
								<a href="{{URL::to('/list-category')}}">
									<i class="menu-icon fa fa-caret-right"></i>
									Danh sách danh mục
								</a>

								<b class="arrow"></b>
							</li>
						</ul>
					</li>
					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-list-alt"></i>
							<span class="menu-text"> Danh mục con </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="">
								<a href="{{URL::to('/add-type')}}">
									<i class="menu-icon fa fa-caret-right"></i>
									Thêm danh mục con
								</a>

								<b class="arrow"></b>
							</li>

							<li class="">
								<a href="{{URL::to('/list-type')}}">
									<i class="menu-icon fa fa-caret-right"></i>
									Danh sách danh mục con
								</a>

								<b class="arrow"></b>
							</li>
						</ul>
					</li>
					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-newspaper-o"></i>
							<span class="menu-text"> Bài viết </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="">
								<a href="{{URL::to('/add-new')}}">
									<i class="menu-icon fa fa-caret-right"></i>
									Thêm bài viết
								</a>

								<b class="arrow"></b>
							</li>

							<li class="">
								<a href="{{URL::to('/list-new')}}">
									<i class="menu-icon fa fa-caret-right"></i>
									Danh sách bài viết
								</a>

								<b class="arrow"></b>
							</li>
						</ul>
					</li>
					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-newspaper-o"></i>
							<span class="menu-text"> Duyệt bài viết </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="">
								<a href="{{URL::to('/list-new-accept')}}">
									<i class="menu-icon fa fa-caret-right"></i>
									Danh sách
								</a>

								<b class="arrow"></b>
							</li>
						</ul>
					</li>
					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-video-camera"></i>
							<span class="menu-text"> Video lời Bác dạy</span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							
							<li class="">
								<a href="{{URL::to('/add-video')}}">
									<i class="menu-icon fa fa-caret-right"></i>
									Thêm video
								</a>

								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="{{URL::to('/list-video')}}">
									<i class="menu-icon fa fa-caret-right"></i>
									Danh sách video
								</a>

								<b class="arrow"></b>
							</li>
						</ul>
					</li>
					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-user"></i>
							<span class="menu-text"> Quản lý tài khoản </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="">
								<a href="{{URL::to('/add-users')}}">
									<i class="menu-icon fa fa-caret-right"></i>
									Thêm tài khoản
								</a>

								<b class="arrow"></b>
							</li>

							<li class="">
								<a href="{{URL::to('/list-users')}}">
									<i class="menu-icon fa fa-caret-right"></i>
									Danh sách tài khoản
								</a>

								<b class="arrow"></b>
							</li>
						</ul>
					</li>
					@endhasrole
				</ul>
				<!-- /.nav-list -->

				<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
					<i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
				</div>

				<script type="text/javascript">
					try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
				</script>
			</div>

      		@yield('dashboard')

			<div class="footer">
				<div class="footer-inner">
					<div class="footer-content">
						<span class="bigger-120">
							Lực Lượng Vũ Trang Bà Rịa - Vũng Tàu
						</span>
					</div>
				</div>
			</div>

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->
		<script src="{{asset('public/assets/js/jquery.2.1.1.min.js')}}"></script>
		<script type="text/javascript">
		window.jQuery || document.write("<script src='{{asset('public/assets/js/jquery.min.js')}}'>"+"<"+"/script>");
		</script>
		<script type="text/javascript">
		if('ontouchstart' in document.documentElement) document.write("<script src='{{asset('public/assets/js/jquery.mobile.custom.min.js')}}'>"+"<"+"/script>");
		</script>
		
		<script src="{{asset('public/assets/js/bootstrap.min.js')}}"></script>
		@yield('js')
		<script src="{{asset('public/assets/js/ace-elements.min.js')}}"></script>
		<script src="{{asset('public/assets/js/ace.min.js')}}"></script>
		@yield('custom-js')
		@include('sweetalert::alert')
	</body>
</html>
