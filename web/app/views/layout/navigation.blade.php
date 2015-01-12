<nav>
<ul>
    <li><a href="{{ URL::route('home') }}">Home</a></li>
    @if(Auth::check())
        <li><a href="{{ URL::route('account-sign-out') }}">log out</a></li>
        <li><a href="{{ URL::route('account-change-password') }}">change password</a></li>
    @else
        <li><a href="{{ URL::route('account-sign-in') }}">Sign in</a></li>
        <li><a href="{{ URL::route('account-create') }}">Create an account</a></li>
        <li><a href="{{ URL::route('account-forgot-password') }}">forgot password!</a></li>
    @endif
    <li><a href="/">Home</a></li>
</ul>
</nav>