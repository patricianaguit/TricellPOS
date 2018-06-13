<html>
<head>
	<title>@yield('title')</title>
	<meta name="viewport" content="width=device-width", initial-scale="1.0">
  <link rel="stylesheet" type="text/css" href="@yield('css')"/>
  <link rel="stylesheet" type="text/css" href="{{ asset('imports/css/nav.css') }}"/>
  <link rel="shortcut icon" href="{{{ asset('favicon.ico') }}}">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>  
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/js/tempusdominus-bootstrap-4.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css" />
   <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="{{ asset('imports/js/sweetalert.min.js') }}"></script>
  <script src="https://code.jquery.com/ui/1.9.1/jquery-ui.js" integrity="sha256-tXuytmakTtXe6NCDgoePBXiKe1gB+VA3xRvyBs/sq94=" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/ui/1.9.1/jquery-ui.js" integrity="sha256-tXuytmakTtXe6NCDgoePBXiKe1gB+VA3xRvyBs/sq94=" crossorigin="anonymous"></script>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a href="/" class="navbar-brand">Brand</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar6">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-collapse collapse justify-content-stretch" id="navbar6">
        <ul class="navbar-nav">
            <li class="nav-item">
       <a class="nav-link {{ Request::segment(1)=='dashboard' ? 'active' : '' }}" href="/dashboard"> DASHBOARD </a>
     </li>
     <li class="nav-item">
       <a class="nav-link {{ Request::segment(1)=='sales' ? 'active' : '' }}" href="/sales"> POS </a>
     </li>
     <li class="nav-item dropdown" id="logsdrop">
          <a class="nav-link dropdown-toggle {{ Request::segment(1)=='logs' ? 'active' : '' }}" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            LOGS
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="/logs/sales">Sales</a>
            <a class="dropdown-item" href="/logs/reload">Reload</a>
      </li>
      
     <li class="nav-item">
       <a class="nav-link {{ Request::segment(1)=='inventory' ? 'active' : '' }}" href="/inventory">INVENTORY</a>
     </li>
     <li class="nav-item">
       <a class="nav-link {{ Request::segment(1)=='accounts' ? 'active' : '' }}" href="/accounts/members">ACCOUNTS</a>
     </li>
        </ul>
        <ul class="navbar-nav ml-auto"> <!--right links-->
             <li class="nav-item dropdown" id="logsdrop">
          <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            HELLO, {{strtoupper(Auth::user()->firstname)}}
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="/preferences/profile">Preferences</a>
            <a class="dropdown-item" href="#">Shutdown</a>
            <a class="dropdown-item" href="/logout">Logout</a>

        </li>
        </ul>
    </div>
</nav>

	@yield('content')
	
	<script type="text/javascript">
   $('ul.navbar-nav li.dropdown').hover(function() {
    $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(400);
  }, 
  function() {
    $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(400);
  });
  </script>
</body>
</html>