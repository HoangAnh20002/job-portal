<!-- resources/views/index.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh toán</title>
</head>
<body>
    <h1>Thanh toán hóa đơn</h1>

    <a href="{{ route('createPayment', ['amount' => 100000]) }}" class="btn btn-primary">Thanh toán</a>
</form>

</body>
</html>
