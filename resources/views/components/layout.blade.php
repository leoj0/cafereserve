<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
</head>

<body>
  <header>
    <x-flash-message />
    @auth
    <nav class="navbar navbar-expand-lg navbar-dark bg-gray-800">
      <div class="container-fluid">
        <a class="navbar-brand text-white" href="/">CafeReserve</a>
        <div class="d-flex ml-auto align-items-center">
          <a class="nav-link text-white" href="{{ route('reservations.search') }}">Reserve Now</a>
          <a class="nav-link text-white" href="{{ route('rewards.index') }}">Rewards</a>
          <div class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-white" href="#" id="userDropdown" role="button" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">
              User
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
              <a class="dropdown-item dropdown-hover" href="{{ route('rewards.user') }}">My Reward</a>
              <a class="dropdown-item dropdown-hover" href="{{ route('reservations.user') }}">My Reservation</a>
              <a class="dropdown-item dropdown-hover" href="{{ route('feedback.user') }}">My Feedback</a>
              <a class="dropdown-item dropdown-hover" href="/show">Manage Account</a>
              <a class="dropdown-item dropdown-hover" href="/change_password">Change Password</a>
              <div class="dropdown-divider"></div>
              <form method="POST" action="/logout">
                @csrf
                <button type="submit" class="dropdown-item w-100 text-start text-danger dropdown-hover">Logout</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </nav>
    @else
    <nav class="navbar navbar-expand-lg navbar-dark bg-gray-800">
      <div class="container-fluid">
        <a class="navbar-brand text-white" href="/">CafeReserve</a>
        <div class="ml-auto d-flex">
          <a class="nav-link text-white" href="/register">Register</a>
          <a class="nav-link text-white" href="/login">Login</a>
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
                    Discover and reserve your perfect cafe experience with CafeReserve. Your next favorite coffee spot is just a click away!
                </p>
            </div>
            <div>
                <h5 class="font-bold text-lg mb-3">Quick Links</h5>
                <ul class="list-none space-y-2">
                    <li><a href="/" class="text-white hover:text-gray-400">Home</a></li>
                    <li><a href="{{ route('reservations.search') }}" class="text-white hover:text-gray-400">Reservations</a></li>
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
                    Email: <a href="mailto:support@cafereserve.com" class="text-gray-400 hover:underline">support@cafereserve.com</a>
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

</body>
</html>
