<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register | Sky Universe</title>

    @vite(['resources/js/app.js'])
</head>

<body class="container">
    <h1>Register</h1>
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Success!</h4>
            <p> {{ session('status') }} </p>
            <a href="{{ route('login') }}" class="alert-link">Go to login page</a>
        </div>
    @endif
    <form method="POST" action="{{ route('register.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-floating mb-3">
            <input name="name" id="name" type="text" aria-describedby="invalid-name"
                value="{{ old('name') }}" placeholder="Name" class="form-control @error('name')is-invalid @enderror">
            <label for="name" class="form-label">Name</label>
            @error('name')
                <div class="invalid-feedback" id="invalid-name">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-floating mb-3">
            <input name="email" id="email" type="email" aria-describedby="invalid-email"
                value="{{ old('email') }}" placeholder="Email address"
                class="form-control @error('email')is-invalid @enderror">
            <label for="email" class="form-label">Email address</label>
            @error('email')
                <div class="invalid-feedback" id="invalid-email">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="input-group has-validation mb-3">
            <span class="input-group-text">Code</span>
            <div class="form-floating @error('dating_code')is-invalid @enderror @error('id')is-invalid @enderror">
                <input name="dating_code" id="dating_code" type="text" aria-describedby="invalid-dating_code"
                    value="{{ old('dating_code') ?? '' }}" placeholder="DTXXX"
                    class="form-control @error('dating_code')is-invalid @enderror @error('id')is-invalid @enderror">
                <label for="dating_code" class="form-label">E.g. DT001</label>
            </div>
            @if ($errors->has('dating_code'))
                <div class="invalid-feedback" id="invalid-dating_code">
                    {{ $errors->get('dating_code')[0] }}
                </div>
            @elseif($errors->has('id'))
                <div class="invalid-feedback" id="invalid-dating_code">
                    {{ $errors->get('id')[0] }}
                </div>
            @endif
        </div>

        <div class="form-floating mb-3">
            <input name="birthday" id="birthday" type="date" aria-describedby="invalid-birthday"
                value="{{ old('birthday') ?? '' }}" placeholder="Birthday"
                class="form-control @error('birthday')is-invalid @enderror">
            <label for="birthday" class="form-label">Birthday</label>
            @error('birthday')
                <div class="invalid-feedback" id="invalid-birthday">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-floating mb-3">
            <select class="form-select @error('gender')is-invalid @enderror" id="gender" name="gender"
                aria-label="Gender">
                <option>Select your gender</option>
                <option value="male" @if (old('gender') == 'male') selected @endif>Male</option>
                <option value="female" @if (old('gender') == 'female') selected @endif>Female</option>
            </select>
            <label for="gender">Gender</label>
            @error('gender')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="input-group mb-3">
            <span class="input-group-text">+65</span>
            <div class="form-floating @error('phone_number')is-invalid @enderror">
                <input type="tel" id="phone_number" name="phone_number" value="{{ old('phone_number') }}"
                    class="form-control @error('phone_number')is-invalid @enderror" placeholder="Phone number"
                    aria-label="Phone number">
                <label for="phone_number" class="form-label">Phone number</label>
            </div>
            @error('phone_number')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="input-group mb-3">
            <input type="file" accept="image/png, image/gif, image/jpeg" name="image"
                class="form-control @error('image')is-invalid @enderror" id="image" aria-label="Upload">
            <button class="btn btn-outline-secondary" type="button" id="camera">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-camera" viewBox="0 0 16 16">
                    <path
                        d="M15 12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1h1.172a3 3 0 0 0 2.12-.879l.83-.828A1 1 0 0 1 6.827 3h2.344a1 1 0 0 1 .707.293l.828.828A3 3 0 0 0 12.828 5H14a1 1 0 0 1 1 1v6zM2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4H2z" />
                    <path
                        d="M8 11a2.5 2.5 0 1 1 0-5 2.5 2.5 0 0 1 0 5zm0 1a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7zM3 6.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z" />
                </svg>
            </button>
            @error('image')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-floating mb-3">
            <input name="password" type="password" class="form-control @error('password')is-invalid @enderror"
                id="password" aria-describedby="invalid-password" placeholder="Enter your password"
                value="{{ old('password') }}">
            <label for="password" class="form-label">Password</label>
            @error('password')
                <div class="invalid-feedback" id="invalid-password">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-floating mb-3">
            <input name="password_confirmation" type="password"
                class="form-control @error('password_confirmation')is-invalid @enderror" id="password_confirmation"
                aria-describedby="invalid-password" placeholder="Re-enter your password"
                value="{{ old('password_confirmation') }}">
            <label for="password_confirmation" class="form-label">Password confirmation</label>
            @error('password_confirmation')
                <div class="invalid-feedback" id="invalid-password">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <p>
        Already have an account?
        <a href="{{ route('login') }}">Login</a>
    </p>
</body>

</html>
