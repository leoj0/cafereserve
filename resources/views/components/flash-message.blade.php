@if(session()->has('message'))

<div class="alert alert-success" id="flash-message">
  <p>
    {{ session('message') }}
  </p>
</div>
<script>
  setTimeout(function() {
      document.getElementById('flash-message').style.display = 'none';
  }, 3000);
</script>

@endif