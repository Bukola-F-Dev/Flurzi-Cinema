<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Flurzi Cinema</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #0b0b0f;
            color: white;
        }
    </style>
</head>
<body>

    {{-- Navbar --}}
    <div style="padding:20px; background:#000;">
        <h2>FLURZI</h2>
    </div>

    {{-- Content --}}
    @yield('content')

</body>
</html>