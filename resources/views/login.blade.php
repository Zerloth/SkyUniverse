<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login | Sky Universe</title>

    @vite(['resources/js/app.js'])
</head>

<body class="container">
    <h1>Login</h1>

    <form method="POST" action="{{ route('login.store') }}">
        @csrf
        <div class="form-floating mb-3">
            <input name="login" id="login" type="text" aria-describedby="invalid-id invalid-email"
                value="{{ old('login') ?? '' }}" placeholder="Enter your ID or Email Address"
                class="form-control @error('id')is-invalid @enderror @error('email')is-invalid @enderror">
            <label for="login" class="form-label">ID or Email address</label>
            @if ($errors->has('email'))
                <div class="invalid-feedback" id="invalid-email">
                    {{ $errors->get('email')[0] }}
                </div>
            @elseif($errors->has('id'))
                <div class="invalid-feedback" id="invalid-id">
                    {{ $errors->get('id')[0] }}
                </div>
            @endif
        </div>
        <div class="form-floating mb-3">
            <input name="password" type="password" class="form-control @error('password')is-invalid @enderror"
                id="password" aria-describedby="invalid-password" placeholder="Enter your password">
            <label for="password" class="form-label">Password</label>
            @error('password')
                <div class="invalid-feedback" id="invalid-password">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <p>
        Don't have an account?
        <a href="{{ route('register') }}">Register</a>
    </p>
</body>

</html>
