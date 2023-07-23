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
    <div class="my-5 row">
      <h2>Filter boss</h2>
      <a href="{{ route('checkoutFilter', ['lokasi' => "Jakarta"]) }}" class="text-decoration-none text-dark col-3">Jakarta</a>
      <a href="{{ route('checkoutFilter', ['lokasi' => "Singapore"]) }}" class="text-decoration-none text-dark col-3">Singapore</a>
      <a href="{{ route('checkoutFilter', ['lokasi' => "Tangerang"]) }}" class="text-decoration-none text-dark col-3">Tangerang</a>
    </div>
    <form method="POST" action="{{ route('checkoutForm') }}" class="">
        @csrf
        <div class="row">
          @for ($i = 0; $i<$lokasi->count(); $i++)
            <div class="col-4">
              <div class="form-check form-check">
                <input class="form-check-input" type="radio" name="options" id="inlineRadio{{ $i }}" value="option{{ $i }}">
                <img src="{{ asset("public/lokasi/lokasi".$i."jpeg") }}" alt="option{{ $i }}">
                <input readonly type="text" id="lokasi" class="form-control-plaintext" name="lokasi" value="{{ $lokasi[$i]->lokasi }}">
                <input readonly type="text" id="harga" class="form-control-plaintext" name="harga" value="Rp. {{ $lokasi[$i]->harga }}">
                <input readonly type="text" id="alamat" class="form-control-plaintext" name="alamat" value="{{ $lokasi[$i]->alamat }}">
              </div>
            </div>
          @endfor
        </div>
        
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</body>

</html>
