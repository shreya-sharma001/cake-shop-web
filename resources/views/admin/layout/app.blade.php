<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Cake Shop Admin Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <!-- In your layout or Blade view -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

  <link rel="stylesheet" href="{{asset('css/header.css')}}">
</head>
<body>
<!-- !-- Navbar -->
<nav class="navbar navbar-expand-lg sticky-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="dashboard.php">CakeShop</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarMenu">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">

        <li class="nav-item">
          <a class="nav-link active" href="/admin/dashboard"><i class="bi bi-speedometer2"></i>Dashboard</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="/admin/orders"><i class="bi bi-cart-check"></i>Orders</a>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
            <i class="bi bi-grid-3x3-gap"></i>Masters
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="/admin/masters/category/category"><i class="bi bi-tag"></i> Category</a></li>
            <li><a class="dropdown-item" href="/admin/masters/product/product"><i class="bi bi-box-seam"></i> Products</a></li>
            <li><a class="dropdown-item" href="/admin/masters/tags/tags"><i class="bi bi-box-seam"></i> Tags</a></li>
            {{-- <li><a class="dropdown-item" href="/admin/masters/colors/colors"><i class="bi bi-palette2"></i> Colors</a></li> --}}
          </ul>
        </li>

        <!-- Profile -->
        <li class="nav-item dropdown ms-3">
          <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-person-circle fs-5"></i>
                {{-- <span class="ms-2">{{ Auth::user()->first_name ?? 'User' }}</span> Dynamically show logged-in user name --}}
            <span class="ms-2">Shreya</span>
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
            <li><a class="dropdown-item" href="{{ route('profile.show') }}"><i class="bi bi-person me-2"></i>Profile</a></li>
            <li><a class="dropdown-item" href="/settings"><i class="bi bi-gear me-2"></i>Settings</a></li>
            <li><a class="dropdown-item" href="/setup"><i class="bi bi-gear me-2"></i>Setup</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item text-danger" href="{{route('admin.logout')}}"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>

@yield('main-content')
<!-- Footer -->
<footer class="bgcolor border-top mt-5">
    <div class="container py-3 text-center">
      <p class="mb-0 text-dark" style="font-family: 'Poppins', sans-serif;">
        &copy; 2025 CakeShop Admin Panel. All rights reserved.
      </p>
    </div>
  </footer>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  </body>
  </html>
