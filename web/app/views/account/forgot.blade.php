@extends("layout.main")

@section("content")
    forgot password
    {{ Form::open(array('route'=>'account-forgot-password-post')) }}
        {{ Form::token() }}

        <div class="field">
            {{ Form::label('email') }}
            {{ Form::text("email") }}
            {{ $errors->first('email') }}
        </div>
        {{ Form::submit("send!!") }}
    {{ Form::close() }}
@stop