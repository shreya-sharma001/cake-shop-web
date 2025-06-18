<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Login - Cake Shop</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <style>
    body {
      background: linear-gradient(135deg, #74ebd5 0%, #9face6 100%);
      font-family: 'Segoe UI', sans-serif;
    }
    .login-card {
      background: #fff;
      border-radius: 1rem;
      padding: 2rem;
      box-shadow: 0 0 30px rgba(0, 0, 0, 0.1);
    }
    .login-title { font-weight: 700; font-size: 1.5rem; color: #333; }
    .form-label { font-weight: 600; }
    .login-btn {
      font-weight: 600;
      background-color: #3f51b5;
      border: none;
    }
    .login-btn:hover { background-color: #303f9f; }
    .brand-logo {
      font-size: 2rem;
      font-weight: 700;
      color: #3f51b5;
    }
  </style>
</head>
<body>
  <div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="col-md-5">
      <div class="text-center mb-4">
        <div class="brand-logo"><i class="fas fa-birthday-cake"></i> CakeShop</div>
      </div>

      <div class="login-card">
        <h4 class="login-title text-center mb-4">Admin Login</h4>

        @if(session('error'))
          <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form method="POST" action="{{ route('adminLogin') }}">
          @csrf
          <div class="mb-3">
            <label class="form-label">Username / Email</label>
            <input type="text" name="username" class="form-control" placeholder="Enter username" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" placeholder="Enter password" required>
          </div>
          <button type="submit" class="btn btn-primary w-100 login-btn">Login</button>
        </form>
      </div>
    </div>
  </div>
</body>
</html>

