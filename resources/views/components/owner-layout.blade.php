<!DOCTYPE html>
<html lang="en">

@php
$cafeId = auth()->user()->cafe->cafe_id ?? null;
@endphp

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="icon" type="image/x-icon" href="{{ asset('favicon.png') }}">
  <title>CafeReserve</title>
  <link rel="stylesheet" href="<?php echo asset('css/style.css')?>" type="text/css">
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
</head>

<body>
  <header>
    <x-flash-message />
    @auth
    <nav class="navbar navbar-expand-lg navbar-dark bg-gray-800 ">
      <div class="container-fluid">
        <!-- Left-aligned brand name -->
        <a class="navbar-brand" href="{{ route('owners.index') }}">CafeReserve</a>

        <!-- Right-aligned elements -->
        <div class="d-flex ml-auto align-items-center">
          <!-- Notification or alert if cafe does not exist -->
          @if($cafeId)
            <a class="nav-link text-white" href="{{route('reservations.manage', ['cafe' => $cafeId])}}">Reservation</a>
            <a class="nav-link text-white" href="{{route('cafes.manage', ['cafe' => $cafeId])}}">Cafe</a>
            <a class="nav-link text-white" href="{{route('menus.manage', ['cafe' => $cafeId])}}">Menu</a>
            <a class="nav-link text-white" href="{{route('tables.manage', ['cafe' => $cafeId])}}">Table</a>
            <a class="nav-link text-white" href="{{route('rewards.manage', ['cafe' => $cafeId])}}">Reward</a>
            <a class="nav-link text-white" href="{{route('owner.feedback', ['cafe' => $cafeId])}}">Feedback</a>
            <a class="nav-link text-white" href="{{route('events.manage', ['cafe' => $cafeId])}}">Event</a>
            <a class="nav-link text-white" href="{{ route('cafes.showDocuments', ['cafe' => $cafeId]) }}">Update Documents</a>
          @else
          <div class="nav-item">
            <a class="nav-link text-white" href="{{route('cafes.create')}}">Create Cafe</a>
          </div>
          @endif

          <!-- User Dropdown -->
          <div class="nav-item dropdown ms-3">
            <a class="nav-link dropdown-toggle text-white" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              User
            </a>
            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
              <li>
                <a class="dropdown-item dropdown-hover" href="{{ route('owner.show') }}">Manage Account</a>
              </li>
              <li>
                <a class="dropdown-item dropdown-hover" href="{{ route('owner.passwordForm') }}">Change Password</a>
              </li>
              <li>
                <div class="dropdown-divider"></div>
                <form method="POST" action="/logout">
                  @csrf
                  <button 
                    type="submit" 
                    class="dropdown-item w-100 text-start text-danger dropdown-hover">
                    Logout
                  </button>
                </form>
              </li>
            </ul>
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

  <footer class="bg-gray-800 text-white py-8">
    <div class="container mx-auto">
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div>
          <h5 class="font-bold text-lg mb-3">About CafeReserve</h5>
          <p class="text-sm leading-relaxed">
            Discover and reserve your perfect cafe experience with CafeReserve. Your next favorite coffee spot is just a
            click away!
          </p>
        </div>
        <div>
          <h5 class="font-bold text-lg mb-3">Quick Links</h5>
          <ul class="list-none space-y-2">
            <li><a href="/" class="text-white hover:text-gray-400">Home</a></li>
            <li><a href="{{ route('reservations.search') }}" class="text-white hover:text-gray-400">Reservations</a>
            </li>
            <li><a href="{{ route('rewards.index') }}" class="text-white hover:text-gray-400">Rewards</a></li>
            <li><a href="{{ route('events.index') }}" class="text-white hover:text-gray-400">Events</a></li>
            <li><a href="/contact" class="text-white hover:text-gray-400">Contact Us</a></li>
          </ul>
        </div>
        <div>
          <h5 class="font-bold text-lg mb-3">Follow Us</h5>
          <div class="flex space-x-4 mt-2">
            <a href="#" class="text-white hover:text-gray-400 text-2xl">
              <i class="fab fa-facebook-f"></i>
            </a>
            <a href="#" class="text-white hover:text-gray-400 text-2xl">
              <i class="fab fa-twitter"></i>
            </a>
            <a href="#" class="text-white hover:text-gray-400 text-2xl">
              <i class="fab fa-instagram"></i>
            </a>
          </div>
          <p class="text-sm mt-4">
            Email: <a href="mailto:support@cafereserve.com"
              class="text-gray-400 hover:underline">support@cafereserve.com</a>
          </p>
        </div>
      </div>
      <hr class="my-4 border-white opacity-50">
      <div class="text-left">
        <p class="text-sm">&copy; 2024 CafeReserve. All rights reserved.</p>
        <a href="/privacy-policy" class="text-gray-400 hover:underline text-sm">Privacy Policy</a> |
        <a href="/terms" class="text-gray-400 hover:underline text-sm">Terms of Service</a>
      </div>
    </div>
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