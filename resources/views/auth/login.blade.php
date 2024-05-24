<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f4f4;
        }
        .container {
            margin-top: 100px;
        }
    </style>
</head>
<body>
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">Đăng nhập</div>
                <div class="card-body">
                    <form action="/login" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" maxlength="255" value="{{ old('email') }}"
                            required>
                        </div>
                        <div class="form-group">
                            <label for="password">Mật khẩu</label>
                            <input type="password" class="form-control" id="password" name="password" minlength="8" maxlength="16" value="{{ old('email') }}"
                            required>
                        </div>
                        <button type="submit" class="btn btn-primary" style="margin-left: 40%">Đăng nhập</button>
                    </form>
                    <div class="mt-3">
                        Bạn không có tài khoản? <a href="/register">Đăng kí</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
