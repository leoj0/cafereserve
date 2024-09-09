<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=`, initial-scale=1.0">
  <link rel="icon" type="image/x-icon" href="{{ asset('favicon.png') }}">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>CafeReserve</title>
  <link rel="stylesheet" href="<?php echo asset('css/style.css')?>" type="text/css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

  <!-- jQuery, Popper.js, and Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>

<script src="https://cdn.tailwindcss.com"></script>
<script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    laravel: "#ef3b2d",
                },
            },
        },
    };
</script>

<body>
  <header>
    <x-flash-message />
    @auth
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <!-- Left-aligned brand name -->
        <a class="navbar-brand" href="/">CafeReserve</a>

        <!-- Right-aligned elements -->
        <div class="d-flex ml-auto align-items-center">
          <a class="nav-link" href="{{ route('reservations.search') }}">Reserve Now</a>
          <a class="nav-link" href="{{ route('rewards.index') }}">Rewards</a>
          <div class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">
              User
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
              <a class="dropdown-item" href="{{ route('rewards.user') }}">My Rewards</a>
              <a class="dropdown-item" href="{{ route('reservations.user') }}">Reservations</a>
              <a class="dropdown-item" href="{{ route('feedback.user') }}">Feedback</a>
              <a class="dropdown-item" href="/show">Manage Account</a>
              <a class="dropdown-item" href="/change_password">Change Password</a>
              <form class="dropdown-item" method="POST" action="/logout" style="display:inline;">
                @csrf
                <button type="submit" class="btn btn-link p-0">Logout</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </nav>
    @else
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <!-- Left-aligned brand name -->
        <a class="navbar-brand" href="/">CafeReserve</a>
        <!-- Right-aligned Register and Login links -->
        <div class="ml-auto d-flex">
          <a class="nav-link" href="/register">Register</a>
          <a class="nav-link" href="/login">Login</a>
        </div>
      </div>
    </nav>
    @endauth
  </header>

  <main>
    {{$slot}}
  </main>

  <footer>
  </footer>

</body>

</html>