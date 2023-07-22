<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tictactoe | Sky Universe</title>
    @vite(['resources/js/app.js', 'resources/js/tictactoe.js', 'resources/css/tictactoe.css'])
</head>

<body class="container">
    <h1 class="testing">Waiting...</h1>
    <div class="board" id="main">
        <span id="turn">Tic Tac Toe</span>

        <div class="box" style="border-left: 0; border-top: 0" id="box1"></div>
        <div class="box" style="border-top: 0" id="box2"></div>
        <div class="box" style="border-top: 0; border-right: 0" id="box3"></div>
        <div class="box" style="border-left: 0" id="box4"></div>
        <div class="box" id="box5"></div>
        <div class="box" style="border-right: 0" id="box6"></div>
        <div class="box" style="border-left: 0; border-bottom: 0" id="box7"></div>
        <div class="box" style="border-bottom: 0" id="box8"></div>
        <div class="box" style="border-right: 0; border-bottom: 0" id="box9"></div>
    </div>

    <button class="btn btn-rounded" id="replay">Play Again</button>

</body>

</html>
