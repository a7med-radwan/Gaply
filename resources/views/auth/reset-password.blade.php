<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gaply — Reset Password</title>
</head>
<body>
    <h2>Set your new password</h2>

    @if ($errors->any())
        <div style="color: red; font-weight: bold; margin: 10px 0;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('password.update') }}" method="POST">
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">
        <input type="hidden" name="{{ config('fortify.email') }}" value="{{ $request->input('email') }}">

        <div>
            <label for="password">New Password:</label>
            <br>
            <input id="password" type="password" name="password" required autofocus>
        </div>

        <br>

        <div>
            <label for="password_confirmation">Confirm New Password:</label>
            <br>
            <input id="password_confirmation" type="password" name="password_confirmation" required>
        </div>

        <br>

        <button type="submit">Reset Password</button>
    </form>

    <p>
        <a href="{{ route('login') }}">Back to Sign In</a>
    </p>
</body>
</html>