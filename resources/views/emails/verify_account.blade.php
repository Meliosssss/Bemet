<h3>Hi {{ $account->name }}</h3>

<p>Thank you for registering with us. Please click the link below to verify your account.</p>

<a href="{{ route('account.verify', $account->email) }}">Verify Account</a>