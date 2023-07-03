<!DOCTYPE html>
<html lang="en">
<head>
	<title>OTMS | Darul Huffaz Anwar</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	{{-- <link rel="icon" type="image/png" href="{{asset('images/bg.png')}}"/> --}}
<!--===============================================================================================-->
	<link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
<!--===============================================================================================-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('vendor/animate/animate.css')}}">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{asset('vendor/css-hamburgers/hamburgers.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('vendor/select2/select2.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('css/util.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/main.css')}}">
<!--===============================================================================================-->
</head>
<body>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="{{asset('images/bg.png')}}" alt="IMG">
				</div>

				<form class="login100-form validate-form" method="POST" action="/users">
                    @csrf
					<span class="login100-form-title">
						Sign Up
					</span>
					
					<div class="wrap-input100 validate-input" data-validate="Name is required: ex@abc.xyz">
						<input class="input100" type="text" name="Username" placeholder="Username" onkeyup=" var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" value="{{ old('Username') }}">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
						</span>
						@error('Username')
						<p class="text-red-500 text-xs mt-1">{{ $message }}</p>
						@enderror
					</div>					

                    <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="email" name="email" placeholder="Email" value="{{old('email')}}">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
						@error('email')
							<p class="text-red-500 text-xs mt-1">{{$message}}</p>
						@enderror
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="password" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
						{{-- @error('password')
							<p class="text-red-500 text-xs mt-1">{{$message}}</p>
						@enderror --}}
					</div>
					
                    <div class="wrap-input100 validate-input" data-validate = "Password does not match">
						<input class="input100" type="password" name="password_confirmation" placeholder="Re-enter Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-key" aria-hidden="true"></i>
						</span>
						{{-- @error('password_confirmation')
							<p class="text-red-500 text-xs mt-1">{{$message}}</p>
						@enderror --}}
					</div>

					<input type="hidden" id="hidden-field-1" name="ICno" value="empty">
					<input type="hidden" id="hidden-field-2" name="Address1" value="empty">
					<input type="hidden" id="hidden-field-3" name="Address2" value="empty">
					<input type="hidden" id="hidden-field-4" name="Poscode" value=0>
					<input type="hidden" id="hidden-field-5" name="City" value="empty">
					<input type="hidden" id="hidden-field-6" name="State" value="empty">
					<input type="hidden" id="hidden-field-7" name="PhoneNo" value="empty">
					<input type="hidden" id="hidden-field-8" name="Nationality" value="empty">
					<input type="hidden" id="hidden-field-9" name="Job" value="empty">
					<input type="hidden" id="hidden-field-10" name="Income" value=0>
					<input type="hidden" id="hidden-field-11" name="OfficeAddress1" value="empty">
					<input type="hidden" id="hidden-field-12" name="OfficeAddress2" value="empty">
					<input type="hidden" id="hidden-field-13" name="OfficePoscode" value=0>
					<input type="hidden" id="hidden-field-14" name="OfficeCity" value="empty">
					<input type="hidden" id="hidden-field-15" name="OfficeState" value="empty">

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="submit">Sign Up</button>
					</div>

					<div class="text-center p-t-12">
						<span class="txt1">Already have account?</span>
						<a class="txt2" href="/login">Login</a>
					</div>

					<div class="text-center p-t-136">
						<a class="txt2" href="#">Back to Homepage<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i></a>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	

	
<!--===============================================================================================-->	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<!--===============================================================================================-->
	<script src="{{asset('vendor/bootstrap/js/popper.js')}}"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="{{asset('vendor/select2/select2.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('vendor/tilt/tilt.jquery.min.js')}}"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="{{asset('js/main.js')}}"></script>
	@include('sweetalert::alert')
</body>
</html>