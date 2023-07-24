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
    <form action="{{ route('logout') }}" method="post">
        @csrf
        <button type="submit">Logout</button>
    </form>

    <h1>Checkout</h1>
    <div class="row my-5">
        <h2>Filter boss</h2>
        <a href="{{ route('checkoutFilter', ['lokasi' => 'Jakarta']) }}"
            class="text-decoration-none text-dark col-3">Jakarta</a>
        <a href="{{ route('checkoutFilter', ['lokasi' => 'Singapore']) }}"
            class="text-decoration-none text-dark col-3">Singapore</a>
        <a href="{{ route('checkoutFilter', ['lokasi' => 'Tangerang']) }}"
            class="text-decoration-none text-dark col-3">Tangerang</a>
    </div>
    <form method="POST" action="{{ route('checkout.validate') }}" class="">
        @csrf
        <div class="row">
            @for ($i = 0; $i < $lokasi->count(); $i++)
                <div class="col-4">
                    <div class="form-check">
                        <input onchange="handleChange({{ $i }})" class="form-check-input" type="radio"
                            name="options" id="inlineRadio{{ $i }}" value="option{{ $i }}">
                        <label for="inlineRadio{{ $i }}" class="form-check-label">
                            <img src="{{ asset('public/lokasi/lokasi' . $i . 'jpeg') }}"
                                alt="option{{ $i }}">
                            <p> {{ $lokasi[$i]->lokasi }} </p>
                            <p> Rp. {{ $lokasi[$i]->harga }} </p>
                            <p>{{ $lokasi[$i]->alamat }}</p>
                        </label>
                    </div>
                </div>
            @endfor
        </div>
        <input type="hidden" name="lokasi" id="lokasi">
        <input type="hidden" name="harga" id="harga">
        <input type="hidden" name="alamat" id="alamat">
        @error('options')
            <div class="alert alert-danger" role="alert">
                {{ $message }}
            </div>
        @enderror

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <script>
        const lokasiField = document.getElementById('lokasi');
        const hargaField = document.getElementById('harga');
        const alamatField = document.getElementById('alamat');
        const lokasi = <?php echo json_encode($lokasi); ?>;

        function handleChange(i) {
            lokasiField.value = lokasi[i].lokasi
            hargaField.value = lokasi[i].harga
            alamatField.value = lokasi[i].alamat
        }
    </script>
</body>

</html>
