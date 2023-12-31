<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.1/jquery.min.js"></script>
    <title>Checkout | Sky Universe</title>

    @vite(['resources/js/app.js'])
</head>
@php
    $Harga = (int) substr($request['harga'], 4);
@endphp

<body class="container">
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Success!</h4>
            <p> {{ session('success') }} </p>
            <a href="{{ route('home') }}" class="alert-link">Go to home page</a>
        </div>
    @endif

    <h1>Checkout Form {{ $request['alamat'] }}</h1>

    <form method="POST" action="{{ route('bayar') }}" class="row">
        @csrf
        <div class="form-floating mb-3">
            <input name="penerima" id="penerima" type="text"
                class="form-control @error('penerima')is-invalid @enderror" aria-describedby="invalid-penerima"
                placeholder="penerima" aria-label="penerima" value="{{ old('penerima') }}">
            <label for="penerima" class="form-label">Penerima</label>
            @error('penerima')
                <div class="invalid-feedback" id="invalid-penerima">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-floating mb-3">
            <textarea name="alamat" id="alamat" class="form-control @error('alamat')is-invalid @enderror"
                placeholder="Leave a comment here" style="height: 100px; resize:none;" aria-label="alamat"
                aria-describedby="invalid-alamat">{{ old('alamat') }}</textarea>
            <label for="alamat">Alamat</label>
            @error('alamat')
                <div class="invalid-feedback" id="invalid-alamat">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-floating mb-3">
            <input name="nomortelepon" id="nomortelepon" type="text"
                class="form-control @error('nomortelepon')is-invalid @enderror" placeholder="nomortelepon"
                aria-label="nomortelepon" value="{{ old('nomortelepon') }}">
            <label for="nomortelepon" class="form-label">Nomor Telepon</label>
            @error('nomortelepon')
                <div class="invalid-feedback" id="invalid-telepon">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="row">
            <h2>Kurir</h2>
            <div class="form-check">
                <input class="form-check-input @error('kurir')is-invalid @enderror" type="radio" name="kurir"
                    id="radioKurir1" value="kurir1">
                <label class="form-check-label" for="radioKurir1">
                    Kurir 1
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input @error('kurir')is-invalid @enderror" type="radio" name="kurir"
                    id="radioKurir2" value="kurir2">
                <label class="form-check-label" for="radioKurir2">
                    Kurir 2
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input @error('kurir')is-invalid @enderror" type="radio" name="kurir"
                    id="radioKurir3" value="kurir3">
                <label class="form-check-label" for="radioKurir3">
                    Kurir 3
                </label>
                @error('kurir')
                    <div class="invalid-feedback" id="invalid-kurir">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <p>
            Harga yang harus dibayar Rp. {{ $Harga }}
        </p>
        <input hidden name="harga" id="harga" value="{{ $Harga }}">

        <div class="row">
            <h2>Metode Pembayaran</h2>
            <div class="form-check">
                <input class="form-check-input @error('pembayaran')is-invalid @enderror" type="radio"
                    name="pembayaran" id="radioPembayaran1" value="ABC">
                <label class="form-check-label" for="radioPembayaran1">
                    ABC
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input @error('pembayaran')is-invalid @enderror" type="radio"
                    name="pembayaran" id="radioPembayaran2" value="BCA">
                <label class="form-check-label" for="radioPembayaran2">
                    BCA
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input @error('pembayaran')is-invalid @enderror" type="radio"
                    name="pembayaran" id="radioPembayaran3" value="CBA">
                <label class="form-check-label" for="radioPembayaran3">
                    CBA
                </label>
                @error('pembayaran')
                    <div class="invalid-feedback" id="invalid-kurir">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Bayar</button>
    </form>
</body>

</html>

<script>
    $('#radioKurir1').click(function() {
        <?php $Harga = $Harga + 10000; ?>
        $('#harga').val(<?php echo $Harga; ?>)
    })
    $('#radioKurir2').click(function() {
        <?php $Harga = $Harga + 20000; ?>
        $('#harga').val(<?php echo $Harga; ?>)
    })
    $('#radioKurir3').click(function() {
        <?php $Harga = $Harga + 30000; ?>
        $('#harga').val(<?php echo $Harga; ?>)
    })
</script>
