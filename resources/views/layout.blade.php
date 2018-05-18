<html>
<head>
	<title>@yield('title')</title>
	<meta name="viewport" content="width=device-width", initial-scale="1.0">
  <link rel="stylesheet" type="text/css" href="@yield('css')"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('imports/css/nav.css') }}"/>
  <!-- bootstrap -->
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
   <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
   <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
   <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
         rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

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
       <a class="nav-link" href="#"> DASHBOARD </a>
     </li>
     <li class="nav-item">
       <a class="nav-link" href="#"> POS </a>
     </li>
     <li class="nav-item dropdown" id="logsdrop">
          <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            LOGS
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="#">Sales</a>
            <a class="dropdown-item" href="#">Reload</a>
        </li>
     <li class="nav-item">
       <a class="nav-link {{ Request::segment(1)=='accounts' ? 'active' : '' }}" href="/accounts/admin">ACCOUNTS</a>
     </li>
	 <li class="nav-item">
       <a class="nav-link" href="inventory.html">INVENTORY</a>
     </li>
     <li class="nav-item">
       <a class="nav-link" href="#">SERVICES</a>
     </li>
        </ul>
        <ul class="navbar-nav ml-auto"> <!--right links-->
             <li class="nav-item dropdown" id="logsdrop">
          <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            HELLO, {{strtoupper(Auth::user()->firstname)}}
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="#">Backup</a>
            <a class="dropdown-item" href="#">Profile</a>
            <a class="dropdown-item" href="#">Shutdown</a>
            <a class="dropdown-item" href="#">Logout</a>

        </li>
        </ul>
    </div>
</nav>

	@yield('content')
	
	</script>
</body>
</html>