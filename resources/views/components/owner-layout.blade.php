<!DOCTYPE html>
<html lang="en">

@php
$cafeId = auth()->user()->cafe->cafe_id ?? null;
@endphp

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>CafeReserve</title>
  <link rel="stylesheet" href="<?php echo asset('css/style.css')?>" type="text/css">
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

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

          <!-- Notification or alert if cafe does not exist -->
          @if($cafeId)
            <div class="nav-item dropdown">
              <a class="nav-link" href="{{route('menus.manage', ['cafe' => $cafeId])}}">Menu</a>
            </div>
            <div class="nav-item dropdown">
              <a class="nav-link" href="{{route('cafes.manage', ['cafe' => $cafeId])}}">Cafe</a>
            </div>
            <div class="nav-item dropdown">
              <a class="nav-link" href="{{route('tables.manage', ['cafe' => $cafeId])}}">Table</a>
            </div>
          @else
            <div class="nav-item dropdown">
              <a class="nav-link" href="{{route('cafes.create')}}">Create Cafe</a>
            </div>
          @endif

          <!-- User Dropdown -->
          <div class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">
              User
            </a>
            <div class="dropdown-menu" aria-labelledby="userDropdown">
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

  <!-- jQuery, Popper.js, and Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

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

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    flatpickr('#opening_time', {
      enableTime: true,
      noCalendar: true,
      dateFormat: 'H:i'
    });
    flatpickr('#closing_time', {
      enableTime: true,
      noCalendar: true,
      dateFormat: 'H:i'
    });
  });
</script>

</body>

</html>