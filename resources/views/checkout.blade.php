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
    <h1>Checkout</h1>

    <form method="POST" action="{{ route('checkoutForm') }}">
        @csrf
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
            <img src="{{ asset('public/lokasi/lokasi1.jpeg') }}" alt="option1">
            <label class="form-check-label" for="inlineRadio1">1</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
            <img src="{{ asset('public/lokasi/lokasi2.jpeg') }}" alt="option2">
            <label class="form-check-label" for="inlineRadio2">2</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3">
            <img src="{{ asset('public/lokasi/lokasi1.jpeg') }}" alt="option3">
            <label class="form-check-label" for="inlineRadio3">3</label>
          </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</body>

</html>
