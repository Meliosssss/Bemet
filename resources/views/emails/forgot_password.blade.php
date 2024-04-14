<h3>Hi {{ $customer->name }}</h3>

<a href="{{ route('account.reset_password', $token) }}">Reset Password</a>