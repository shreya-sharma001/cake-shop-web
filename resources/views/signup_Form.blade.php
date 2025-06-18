{{-- @extends('layout/masterLayout')
@section('content') --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Form</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            /* background-image: url('your-background-image.jpg'); */
            background-size: cover;
            background-position: center;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .form-container {
            background: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
            max-width: 500px;
            width: 100%;
        }

        .form-title {
            text-align: center;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: bold;
        }

        .btn-primary {
            width: 100%;
            border-radius: 5px;
        }

        .login-prompt {
            text-align: center;
            margin-top: 15px;
        }
    </style>
</head>

<body>

    <div class="form-container">
        <h3 class="form-title">Create Account</h3>
        <form action="{{route('addUser')}}" method="post">
            @csrf
            <div class="form-group">
                <label for="type">User Type</label>
                <select class="form-control" id="type" name="type">
                    <option value="customer">Customer</option>
                    <option value="employee">Employee</option>
                    <option value="admin">Admin</option>
                </select>
            </div>

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <div class="form-group">
                <label for="confirm-password">Confirm Password</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
            </div>

            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="phone" class="form-control" id="phone" name="phone" required>
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <input type="address" class="form-control" id="address" name="address" required>
            </div>

            <button type="submit" class="btn btn-primary">Register</button>

            <div class="login-prompt">
                Already have an account? <a href="/login_Form">Login</a>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS & dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>

   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>

{{-- @endsection
   @section('title')
       Register
   @endsection --}}
