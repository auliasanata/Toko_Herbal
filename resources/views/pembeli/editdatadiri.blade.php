<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Diri</title>
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
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin: 10px 0 5px;
            color: #00796b;
        }
        input[type="text"],
        input[type="email"] {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 16px;
        }
        .button-container {
            text-align: center;
        }
        .btn {
            background-color: #00796b;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
            margin: 5px;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #004d40;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Edit Data Diri</h1>
    <form action="{{ route('datadiri.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="name">Nama</label>
        <input type="text" id="name" name="name" value="{{ $user->name }}" required>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="{{ $user->email }}" required>

        <label for="no_hp">No HP</label>
        <input type="text" id="no_hp" name="no_hp" value="{{ $user->no_hp }}" required>

        <label for="level">Level</label>
        <input type="text" id="level" name="level" value="{{ $user->level }}" required>

        <label for="province">Province</label>
        <input type="text" id="province" name="province" value="{{ $user->province }}" required>

        <label for="city">City</label>
        <input type="text" id="city" name="city" value="{{ $user->city }}" required>

        <label for="address">Address</label>
        <input type="text" id="address" name="address" value="{{ $user->address }}" required>

        <div class="button-container">
            <button type="submit" class="btn">Update</button>
            <a href="{{ route('produk') }}" class="btn">Back</a>
        </div>
    </form>
</div>

</body>
</html>
