@extends('layout.main')

@section('content')
	{{ Form::open(array('route'=>"account-change-password-post")) }}
		<div class="field">
			{{ Form::label("old_password", "Old password") }}
			{{ Form::password("old_password") }}
			{{ $errors->first('old_password') }}
		</div>
		<div class="field">
			{{ Form::label("password", "New password") }}
			{{ Form::password("password") }}
			{{ $errors->first('password') }}
		</div>
		<div class="field">
			{{ Form::label("password_again", "New password again") }}
			{{ Form::password("password_again") }}
			{{ $errors->first('password_again') }}
		</div>

		{{ Form::token() }}
		{{ Form::submit('change password!') }}
	{{ Form::close()  }}
@stop