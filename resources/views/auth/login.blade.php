<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Login - {{ siteOption('sitename') }}</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="{{ siteOptionLogo('16') }}" type="image/gif" sizes="16x16">

	<link rel="stylesheet" href="{{ asset('') }}plugins/fontawesome-free/css/all.min.css">
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<link rel="stylesheet" href="{{ asset('') }}plugins/icheck-bootstrap/icheck-bootstrap.min.css">
	<link rel="stylesheet" href="{{ asset('css/adminlte.css') }}">
	<link rel="stylesheet" href="{{ asset('css/custom.css') }}">
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="login-box">
	<div class="login-logo">
		<img src="{{ siteOptionLogo('250') }}" alt="AdminLTE Logo" class="brand-image d-block mx-auto" width="110px;">
		<a href="{{ asset('') }}index2.html"><b>{{ siteOption('sitename') }}</b></a>
	</div>
	<!-- /.login-logo -->
	<div class="card">
		<div class="card-body login-card-body">
			<p class="login-box-msg">Sign in to start your session</p>

			<form id="form-login" action="{{ Request::url() }}" method="post" data-parsley-validate>
				@csrf
				<div class="form-group">
					<div class="input-group">
						<input type="email" class="form-control" placeholder="Email" name="email" required>
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-lock"></span>
							</div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="input-group">
						<input type="password" class="form-control" placeholder="Pasword" name="password" data-parsley-minlength="6" required>
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-lock"></span>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-8">
						<div class="icheck-primary">
							<input type="checkbox" id="remember" name="remember">
							<label for="remember">
								Remember Me
							</label>
						</div>
					</div>
					<!-- /.col -->
					<div class="col-4">
						<button type="submit" class="btn btn-primary btn-block">Sign In</button>
					</div>
					<!-- /.col -->
				</div>
			</form>
		</div>
		<!-- /.login-card-body -->
	</div>
</div>
<!-- /.login-box -->

<script src="{{ asset('') }}plugins/jquery/jquery.min.js"></script>
<script src="{{ asset('') }}plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('') }}plugins/parsley/dist/parsley.min.js"></script>
<script src="{{ asset('') }}plugins/parsley/dist/i18n/id.js"></script>
<script src="{{ asset('js/adminlte.js') }}"></script>
<script>
	$('#form-login').parsley({
		errorsContainer: function(el) {
			return el.$element.closest('.form-group');
		},
	});
</script>
</body>
</html>
