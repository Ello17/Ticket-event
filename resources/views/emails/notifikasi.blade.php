<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kirim Tiket</title>
</head>
<body>
    <form action="{{ route('kirimTiket', $event->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="customer_email">Email Customer</label>
            <input type="email" class="form-control" name="customer_email" required>
        </div>
        <button type="submit" class="btn btn-primary">Kirim Tiket</button>
    </form>
    
</body>
</html>