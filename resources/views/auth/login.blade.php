<!DOCTYPE html>
<html lang="en">

<head>

	<title>Login - Sistem Pengajuan</title>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

	<link rel="stylesheet" href="{{ asset('flat/assets/css/style.css') }}">
	<link rel="icon" href="{{ asset('flat/assets/images/favicon.ico') }}" type="image/x-icon">
</head>

<body>

<div class="auth-wrapper">
	<div class="auth-content text-center">
		<img src="{{ asset('flat/assets/images/logo.png') }}" alt="" class="img-fluid mb-4">
		
		<div class="card borderless">
			<div class="row align-items-center">
				<div class="col-md-12">
					<div class="card-body">
					
						<h4 class="mb-3 f-w-400">Login</h4>
						<hr>

						{{-- NOTIF ERROR --}}
						@if ($errors->any())
							<div class="alert alert-danger text-left">
								<ul class="m-0 p-0">
									@foreach ($errors->all() as $error)
										<li>{{ $error }}</li>
									@endforeach
								</ul>
							</div>
						@endif

						{{-- FORM LOGIN --}}
						<form action="{{ route('login.process') }}" method="POST">
							@csrf

							<div class="form-group mb-3">
								<input type="text" class="form-control" name="email" placeholder="Email address" required>
							</div>

							<div class="form-group mb-4">
								<input type="password" class="form-control" name="password" placeholder="Password" required>
							</div>

							<div class="custom-control custom-checkbox text-left mb-4 mt-2">
								<input type="checkbox" class="custom-control-input" id="customCheck1">
								<label class="custom-control-label" for="customCheck1">Remember me</label>
							</div>

							<button type="submit" class="btn btn-block btn-primary mb-4">Masuk</button>
						</form>

						<hr>

						{{-- MASUK SEBAGAI TAMU --}}
						<a href="{{ url('tamu/dashboard') }}" class="btn btn-outline-secondary btn-block">
							Masuk sebagai Tamu
						</a>

						<p class="mt-3 text-muted">Lupa password? <a href="#">Hubungi Admin</a></p>

					</div>
				</div>
			</div>
		</div> 
	</div>
</div>

<script src="{{ asset('flat/assets/js/vendor-all.min.js') }}"></script>
<script src="{{ asset('flat/assets/js/plugins/bootstrap.min.js') }}"></script>

</body>
</html>