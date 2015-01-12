@extends("layout.main")

@section("content")
    {{ Form::open(array('route'=>"account-create-post")) }}
        <h1>Login</h1>
        <div class="field">
            {{ Form::label("email", "Email") }}
            {{ Form::text("email", Input::old("email"), array('placeholder'=>'awesome@awesome.com')) }}
            {{ $errors->first('email') }}
        </div>
        <div class="field">
            {{ Form::label("username", "Username") }}
            {{ Form::text("username", Input::old("username")) }}
            {{ $errors->first('username') }}
        </div>
        <div class="field">
            {{ Form::label("password", "Password") }}
            {{ Form::password("password", Input::old("password")) }}
            {{ $errors->first('password') }}
        </div>
        <div class="field">
            {{ Form::label("password_again", "Password again") }}
            {{ Form::password("password_again", Input::old("password_again")) }}
            {{ $errors->first('password_again') }}
        </div>

        <div>
            {{Form::submit('Create Sccount!!')}}
        </div>
        {{Form::token()}}
    {{ Form::close() }}
@stop