<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gaply — Forgot Password</title>
</head>
<body>
    <h2>Reset your password</h2>
    <p>Enter your email address and we'll send you a link to reset your password.</p>

    @if (session('status'))
        <div style="color: blue; font-weight: bold; margin: 10px 0;">
            {{ session('status') }}
        </div>
    @endif

    @if ($errors->any())
        <div style="color: red; font-weight: bold; margin: 10px 0;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('password.email') }}" method="POST">
        @csrf
        <div>
            <label for="email">Email Address:</label>
            <br>
            <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="you@example.com" required autofocus>
        </div>
        
        <br>

        <button type="submit">Send Reset Link</button>
    </form>

    <p>
        <a href="{{ route('login') }}">Back to Sign In</a>
    </p>
</body>
</html>