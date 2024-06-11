<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Diri</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #e0f7fa;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
        }
        h1 {
            text-align: center;
            color: #00796b;
            margin-bottom: 20px;
        }
        .user-container {
            margin-bottom: 40px;
        }
        .grid-container {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 10px;
        }
        .grid-item {
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #fafafa;
        }
        .grid-item:nth-child(odd) {
            background-color: #f0f0f0;
        }
        .button-container {
            text-align: center;
            margin-top: 20px;
        }
        .btn {
            background-color: #00796b;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
            margin: 5px;
        }
        .btn:hover {
            background-color: #004d40;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Data Diri</h1>
    @if (Auth::check())
    <div class="user-container">
        <div class="grid-container">
            <div class="grid-item"><strong>Nama</strong></div>
            <div class="grid-item">{{ Auth::user()->name }}</div>
            <div class="grid-item"><strong>Email</strong></div>
            <div class="grid-item">{{ Auth::user()->email }}</div>
            <div class="grid-item"><strong>No HP</strong></div>
            <div class="grid-item">{{ Auth::user()->no_hp }}</div>
            <div class="grid-item"><strong>Level</strong></div>
            <div class="grid-item">{{ Auth::user()->level }}</div>
            <div class="grid-item"><strong>Province</strong></div>
            <div class="grid-item">{{ Auth::user()->province }}</div>
            <div class="grid-item"><strong>City</strong></div>
            <div class="grid-item">{{ Auth::user()->city }}</div>
            <div class="grid-item"><strong>Address</strong></div>
            <div class="grid-item">{{ Auth::user()->address }}</div>
        </div>
        <div class="button-container">
        <a href="{{ route('datadiri.edit', Auth::user()->id) }}" class="btn">Edit</a>
            <a href="{{ route('users.index') }}" class="btn">Back</a>
        </div>
    </div>
    @else
        <p style="text-align: center; color: #e53935;">Anda belum login. Silakan <a href="{{ route('login') }}" style="color: #00796b; text-decoration: none;">login</a> terlebih dahulu.</p>
    @endif
</div>

</body>
</html>
