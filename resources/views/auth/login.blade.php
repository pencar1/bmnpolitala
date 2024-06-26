<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<title>Login</title>
		<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
		<link rel="icon" href="{{ asset('images/logo/logo-bmn.png') }}" type="image/x-icon" />
	
		<!-- Fonts and icons -->
		<script src="{{ asset('azzara/assets/js/plugin/webfont/webfont.min.js') }}"></script>
		<script>
			WebFont.load({
				google: { "families": ["Open+Sans:300,400,600,700"] },
				custom: { "families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands"], urls: [{{ asset('assets/css/fonts.css') }}] },
				active: function () {
					sessionStorage.fonts = true;
				}
			});
		</script>
	
		<!-- CSS Files -->
		<link rel="stylesheet" href="{{ asset('azzara/assets/css/bootstrap.min.css') }}">
		<link rel="stylesheet" href="{{ asset('azzara/assets/css/azzara.min.css') }}">
	
		<!-- Custom CSS for Background Image -->
		<style>
			body.login {
				background-image: url('{{ asset('images/logo/bg.jpg') }}');
				background-size: cover;
				background-repeat: no-repeat;
				background-position: center center;
				background-attachment: fixed;
			}
		</style>
	</head>
<body class="login">
	<div class="wrapper wrapper-login">
		<div class="container container-login animated fadeIn">
			<h3 class="text-center">Login</h3>
			<div class="login-form">
                <form method="post" action="{{ route('login_proses') }}">
                    @csrf <!-- CSRF token -->
				<div class="form-group form-floating-label">
					<input id="email" name="email" type="email" class="form-control input-border-bottom" required>
					<label for="email" class="placeholder">Email</label>
                    @error('email')
                <small>{{ $message }}</small>
                @enderror
				</div>

				<div class="form-group form-floating-label">
					<input id="password" name="password" type="password" class="form-control input-border-bottom" required>
					<label for="password" class="placeholder">Password</label>
					<div class="show-password">
						<i class="flaticon-interface"></i>
					</div>
                    @error('password')
                    <small>{{ $message }}</small>
                    @enderror
				</div>
            
				<div class="row form-sub m-0">
					<div class="custom-control custom-checkbox">
						<input type="checkbox" class="custom-control-input" id="rememberme">
						<label class="custom-control-label" for="rememberme">Remember Me</label>
					</div>

					
				</div>
                <div class="form-action mb-3">
                    <button type="submit" class="btn btn-primary btn-rounded btn-login">Masuk</button>
                </div>
				{{-- <div class="login-account">
					<span class="msg">Don't have an account yet ?</span>
					<a href="#" id="show-signup" class="link">Sign Up</a>
				</div> --}}
			</div>
		</div>


	</div>
	<script src="{{ asset ('azzara/assets/js/core/jquery.3.2.1.min.js')}}"></script>
	<script src="{{ asset ('azzara/assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js')}}"></script>
	<script src="{{ asset ('azzara/assets/js/core/popper.min.js')}}"></script>
	<script src="{{ asset ('azzara/assets/js/core/bootstrap.min.js')}}"></script>
	<script src="{{ asset ('azzara/assets/js/ready.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if($message = Session::get('succes'))
    <script>Swal.fire('{{ $message }}');</script>
    @endif

    @if($message = Session::get('failed'))
    <script>Swal.fire('{{ $message }}');</script>
    @endif
</body>
</html>