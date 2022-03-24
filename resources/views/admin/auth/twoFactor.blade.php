<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Xác minh hai yếu tố - Admin</title>

		<meta name="description" content="Xác minh hai yếu tố" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="{{asset('public/assets/css/bootstrap.min.css')}}" />
		<link rel="stylesheet" href="{{asset('public/assets/font-awesome/4.2.0/css/font-awesome.min.css')}}" />

		<!-- text fonts -->
		<link rel="stylesheet" href="{{asset('public/assets/fonts/fonts.googleapis.com.css')}}" />

		<!-- ace styles -->
		<link rel="stylesheet" href="{{asset('public/assets/css/ace.min.css')}}" />
	</head>

	<body class="login-layout">
		<div class="main-container">
			<div class="main-content">
				<div class="row">
					<div class="col-sm-10 col-sm-offset-1">
						<div class="login-container">

							<div class="space-6"></div>

							<div class="position-relative">
								<div id="login-box" class="login-box visible widget-box no-border">
									<div class="widget-body">
										<div class="widget-main">
											<div class="space-6"></div>
											<form action="{{ route('verify.store') }}" method="post">
                        						{{ csrf_field() }}
												<fieldset>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="text" name="two_factor_code" class="form-control" placeholder="Nhập mã hai yếu tố" />
															<i class="ace-icon fa fa-key"></i>
														</span>
													</label>

													<div class="space"></div>

													<div class="clearfix">
                            							<a href="{{ route('verify.resend') }}" class="btn btn-sm btn-success">Gửi lại mã hai yếu tố</a>
														<button type="submit" class="width-35 pull-right btn btn-sm btn-primary">
															<i class="ace-icon fa fa-key"></i>
															<span class="bigger-110">Xác minh</span>
														</button>
													</div>

													<div class="space-4"></div>
												</fieldset>
											</form>

										</div><!-- /.widget-main -->
									</div><!-- /.widget-body -->
								</div><!-- /.login-box -->
							</div><!-- /.position-relative -->
						</div>
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.main-content -->
		</div><!-- /.main-container -->
		@include('sweetalert::alert')
	</body>
</html>
