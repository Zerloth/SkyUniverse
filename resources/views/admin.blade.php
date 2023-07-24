<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin | Sky Universe</title>
</head>

<body>
    <h1>Manage User</h1>
    @foreach ($users as $user)
        <div class="d-flex">
            {{ $user->id }}

            {{ $user->name }}

            <button onclick="handleClick({{ $user->id }})" type="button" class="btn btn-danger">Ban</button>
        </div>
    @endforeach
    <script>
        async function handleClick(id) {
            let response = await axios.post(`http://127.0.0.1:8000/ban/${id}`);
        }
    </script>
</body>

</html>
