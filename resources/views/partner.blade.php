<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Partner | Sky Universe</title>
</head>

<body>
    <img src="/storage/{{ $partner->image_path }}" alt="" width="100" height="100">
    <h1>{{ $partner->name }}</h1>
    <button onclick="handleClick()">Checkout</button>

    <script>
        function handleClick() {
            window.location.href = "/checkout"
        }
    </script>
</body>



</html>
