@extends('layout.main')

@section('content')
    Sign in.
    {{ Form::open(array('route'=>'account-sign-in-post')) }}
        {{ Form::token() }}

        <div class="field">
            {{ Form::label('email', 'Email') }}
            {{ Form::text('email', Input::old('email'), array('placeholder'=>'awesome@awesome.com')) }}
            {{ $errors->first('email') }}
        </div>
        <div class="field">
            {{ Form::label('password', 'Password') }}
            {{ Form::password('password') }}
            {{ $errors->first('password') }}
        </div>
        <div class="field">
            {{ Form::checkbox('remember', 1, null, ['id'=>'remember']) }}
            {{ Form::label('remember', 'Remember me') }}
        </div>
        {{ Form::submit("Sign in!") }}
    {{ Form::close() }}
@stop