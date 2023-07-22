<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.1/jquery.min.js"></script>
    <title>Login | Sky Universe</title>

    @vite(['resources/js/app.js'])
</head>
@php
    $Harga = 0;
@endphp

<body class="container">
    <h1>Checkout Form {{ $value }}</h1>

    <form method="POST" action="{{ route('bayar') }}">
        @csrf
        <div class="form-floating mb-3">
            <input name="Penerima" id="Penerima" type="text" class="form-control" placeholder="Penerima" aria-label="Penerima">
            <label for="Penerima" class="form-label">Penerima</label>
        </div>
        <div class="form-floating mb-3">
            <textarea name="alamat" id="alamat" class="form-control" placeholder="Leave a comment here" style="height: 100px"></textarea>
            <label for="alamat">Alamat</label>
        </div>
        <div class="form-floating mb-3">
            <input name="NomorTelepon" id="NomorTelepon" type="text" class="form-control" placeholder="NomorTelepon" aria-label="NomorTelepon">
            <label for="NomorTelepon" class="form-label">Nomor Telepon</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="flexRadioDefault" id="radioKurir1" value="kurir1">
            <label class="form-check-label" for="radioKurir1">
            Kurir 1
            </label>
          </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="flexRadioDefault" id="radioKurir2" value="kurir2">
            <label class="form-check-label" for="radioKurir2">
              Kurir 2
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="flexRadioDefault" id="radioKurir3" value="kurir3">
            <label class="form-check-label" for="radioKurir3">
              Kurir 3
            </label>
        </div>
        
        <p>
            Harga yang harus dibayar Rp. 
        </p>
        <p id="pTest">
            {{ $Harga }}
        </p>
        <button type="submit" class="btn btn-primary">Bayar</button>
    </form>
</body>

</html>

<script>
    $('#radioKurir1').click(function(){
        <?php $Harga = 10000; ?>
        $('#pTest').text(<?php echo $Harga?>)
    })
    $('#radioKurir2').click(function(){
        <?php $Harga = 20000; ?>
        $('#pTest').text(<?php echo $Harga?>)
    })
    $('#radioKurir3').click(function(){
        <?php $Harga = 30000; ?>
        $('#pTest').text(<?php echo $Harga?>)
    })
</script>