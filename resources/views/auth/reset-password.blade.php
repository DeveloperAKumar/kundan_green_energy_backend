<!doctype html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="icon" href="{{asset($site_setting->favicon)}}" type="image/png" />
	<!--plugins-->
	<link href="{{asset('assets/frontend/plugins/simplebar/css/simplebar.css')}}" rel="stylesheet" />
	<link href="{{asset('assets/frontend/plugins/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet" />
	<link href="{{asset('assets/frontend/plugins/metismenu/css/metisMenu.min.css')}}" rel="stylesheet" />
	<!-- loader-->
	<link href="{{asset('assets/frontend/css/pace.min.css')}}" rel="stylesheet" />
	<script src="{{asset('assets/frontend/js/pace.min.js')}}"></script>
	<!-- Bootstrap CSS -->
	<link href="{{asset('assets/frontend/css/bootstrap.min.css')}}" rel="stylesheet">
	<link href="{{asset('assets/frontend/css/bootstrap-extended.css')}}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet">
	<link href="{{asset('assets/frontend/css/app.css')}}" rel="stylesheet">
	<link href="{{asset('assets/frontend/css/icons.css')}}" rel="stylesheet">
	<title>Reset Password | {{$site_setting->company_name}}</title>
</head>
<body>
	<!--wrapper-->
	<div class="wrapper">
		<div class="authentication-header"></div>
		<div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
			<div class="container">
				<div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
					<div class="col mx-auto">
						<div class="mb-4 text-center">
							<img src="{{asset('assets/frontend/images/logo-img.png')}}" width="180" alt="" />
						</div>
						<div class="card rounded-4">
							<div class="card-body">
								<div class="p-4 rounded">
									<div class="text-center">
										<h3 class="">Reset Password</h3> 
										</p>
									</div>
									{{-- <div class="d-grid">
										<a class="btn my-4 shadow-sm btn-white" href="javascript:;"> <span class="d-flex justify-content-center align-items-center">
                                        <img class="me-2" src="{{asset('assets/frontend/images/icons/search.svg')}}" width="16" alt="Image Description">
                                        <span>Sign in with Google</span>
											</span>
										</a> <a href="javascript:;" class="btn btn-facebook"><i class="bx bxl-facebook"></i>Sign in with Facebook</a>
									</div>
									<div class="login-separater text-center mb-4"> <span>OR SIGN IN WITH EMAIL</span>
										<hr/>
									</div> --}}
									<div class="form-body">
										<form class="row g-3" method="POST" action="{{ route('admin.login') }}">
                                            @csrf
											<div class="col-12">
                                                <x-input-label for="email" :value="__('Email')" />
                                                <x-text-input id="email" class="block mt-1 w-full form-control" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
                                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
											</div>

											<div class="col-12">
                                                <x-input-label for="password" :value="__('Password')" />
                                                <x-text-input id="password" class="block mt-1 w-full form-control" type="password" name="password" required autocomplete="new-password" />
                                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                                </div>
                                                
                                                <div class="col-12">
                                                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                                                    <x-text-input id="password_confirmation" class="block mt-1 w-full form-control" type="password" name="password_confirmation" required autocomplete="new-password" />
                                                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                                </div>
											</div>
											<div class="col-md-6">
												 
											</div>
											<div class="col-md-6 text-end">
                                                	<a href="{{route('password.request')}}">Forgot Password ?</a>
											</div>
											<div class="col-12">
												<div class="d-grid">
													<button type="submit" class="btn btn-primary"><i class="bx bxs-lock-open"></i>   {{ __('Reset Password') }}</button>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--end row-->
			</div>
		</div>
	</div>
	<!--end wrapper-->
	<!-- Bootstrap JS -->
	<script src="{{asset('assets/frontend/js/bootstrap.bundle.min.js')}}"></script>
	<!--plugins-->
	<script src="{{asset('assets/frontend/js/jquery.min.js')}}"></script>
	<script src="{{asset('assets/frontend/plugins/simplebar/js/simplebar.min.js')}}"></script>
	<script src="{{asset('assets/frontend/plugins/metismenu/js/metisMenu.min.js')}}"></script>
	<script src="{{asset('assets/frontend/plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>
	<!--Password show & hide js -->
	<script>
		$(document).ready(function () {
			$("#show_hide_password a").on('click', function (event) {
				event.preventDefault();
				if ($('#show_hide_password input').attr("type") == "text") {
					$('#show_hide_password input').attr('type', 'password');
					$('#show_hide_password i').addClass("bx-hide");
					$('#show_hide_password i').removeClass("bx-show");
				} else if ($('#show_hide_password input').attr("type") == "password") {
					$('#show_hide_password input').attr('type', 'text');
					$('#show_hide_password i').removeClass("bx-hide");
					$('#show_hide_password i').addClass("bx-show");
				}
			});
		});
	</script>
	<!--app JS-->
	<script src="{{asset('assets/frontend/js/app.js')}}"></script>
</body>
</html>