<!DOCTYPE html>
<html>
	<head>
		<link rel='stylesheet' href='{{asset('css/login.css')}}'>
		<link rel='icon' href='{{asset('css/images/logo.png')}}'>
		<script src ='{{asset('js/jquery-3.1.1.min.js')}}'></script>
		<script src ='{{asset('js/login.js')}}'> </script>
		<title> More Than Matchmaking </title>
	</head>
	
	<body>
			<nav id='header'>
				<img src='{{asset('css/images/LogoWord.png')}}' height ='35px'>
			</nav>

			<div id='left'>
				<h1 id='title'> MoreThanMatchmaking</h1>
				<h2 id='sub'> where gamers chill</h2>
				<p> Find more friends here, taste the best gaming experience ever and become the best gamer
				you can ever be.</p>
			</div>
			
			<div id='right'>
				<div id='login' class ='input' >
					<h2 class='rightTitle'> Welcome, gamer!</h2>
					
					<form id='signin' role="form" method="POST" name="submit" action="{{route('login')}}">
						{{csrf_field()}}
						<div class="form-group{{$errors->login->has('username') ? ' has-error ' : ''}}">
							<input type='text' placeholder='Username' name="username" id="username" autocomplete="off" value="{{old('username')}}" required>
							@if($errors->login->has('username'))
								<span id="error">
									<strong>{{$errors->login->first('username')}}</strong>
								</span>
							@endif
						</div>
						<div class="form-group{{$errors->has('password') ? ' has-error' : ''}} ">
							<input type='password' placeholder='Password' name="password" id="password" autocomplete="off">
							@if($errors->has('password'))
								<span id="error">
									<strong>{{$errors->first('password')}}</strong>
								</span>
							@endif
						</div>
						<button type='submit' id="loginButton" class='button' name="submit">Log In</button>
					</form> 
				</div>
				
				<div id='register' class ='input' >
					<h2 class='rightTitle'> Don't have an account? Join us now!</h2>
					
					<form id='signup' role="form" method="POST" action="{{route('register')}}">
						{{csrf_field()}}
						<div class="form-group{{$errors->has('name') ? ' has-error' : ''}}">
							<input class="form-control" id='name' type='text' placeholder='Name' name="name" autocomplete="off" value="{{old('name')}}" required>
							@if($errors->has('name'))
								<span id="error">
									<strong>{{ $errors->first('name') }}</strong>
								</span>
                            @endif
						</div>

                        <div class="form-group{{$errors->has('email') ? ' has-error' : ''}}">
                            <input class="form-control" id='email' type ='email' placeholder='Email' name="email" autocomplete="off" value="{{old('email')}}" required>
                            @if($errors->has('email'))
                                <span id="error">
                                    <strong>{{$errors->first('email')}}</strong>
                                </span>
                                @endif
                        </div>

                        <div class="form-group{{$errors->has('username)') ? ' has-error' : ''}}">
                            <input class="form-control" id='username' type='text' placeholder='Username' name="username" autocomplete="off" value="{{old('Rusername')}}" required>
                            @if($errors->has('username'))
                                <span id="error">
                                    <strong>{{$errors->first('username')}}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group{{$errors->has('password') ? ' has-error' : ''}}">
                            <input class="form-control" id='password' type='password' placeholder='Password' name="password" required>

                            @if($errors->has('password'))
                                <span id="error">
                                    <strong>{{$errors->first('password')}}</strong>
                                </span>
                            @endif
                        </div>

						<div class="form-group">
                            <input id='password-confirm' type='password' placeholder='Confirm Password' name="password_confirmation" required>
                        </div>

                        <div class="form-group">
                            <button type='submit' class='button' id="registerButt">Register</button>
                        </div>

					</form> 
				</div>
			</div>
	</body>
</html>
