@extends('layouts/_app')

@section('content')
	@auth
	<p>You're already logged in, silly. <a href="{{ route('inventoryList') }}">Go back to the inventory list</a></p>
	@else
	<form method="POST" action="{{ route('doLogin') }}">
		@csrf
		<label for="email">Email: </label>
		<input type="email" name="email" />
		<br />

		<label for="password">Password: </label>
		<input type="password" name="password" />
		<br />

		<input type="submit" value="Sign In" />
	</form>

	<a href="{{ route('forgotPassword') }}">Forgot Password?</a>
	@endauth
@endsection