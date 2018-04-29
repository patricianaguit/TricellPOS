<!DOCTYPE html>
<html>
<head>
	<title>@yield('title')</title>
	<meta name="viewport" content="width=device-width", initial-scale="1.0">
  <link rel="stylesheet" type="text/css" href="{{ asset('imports/css/members.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('imports/css/nav.css') }}"/>
  <!-- bootstrap -->

 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
 <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
 <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
 <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
       rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>
	<nav class="navbar navbar-expand-sm  border  nav_custom">
    <a class="navbar-brand logo" href="#">+	&#183; &#183;</a>

   <!-- Links -->
  <!---NAV-->
   <ul class="navbar-nav" >
     <li class="nav-item spaces active">
       <a class="nav-link" href="#"> DASHBOARD</a>
     </li>
     <li class="nav-item spaces">
       <a class="nav-link" href="#"> POS </a>
     </li>
     <li class="nav-item dropdown spaces" id="logsdrop">
          <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            LOGS
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="#">Sales</a>
            <a class="dropdown-item" href="#">Reload</a>

          </div>
        </li>
     <li class="nav-item spaces">
       <a class="nav-link" href="#">ACCOUNTS</a>
     </li>
     <li class="nav-item spaces">
       <a class="nav-link" href="#" active>SERVICES</a>
     </li>


     <li class="nav-item dropdown hello">
          <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            HELLO, {{strtoupper(Auth::user()->firstname)}}
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="#">Backup</a>
            <a class="dropdown-item" href="#">Profile</a>
            <a class="dropdown-item" href="#">Shutdown</a>
            <a class="dropdown-item" href="/logout">Logout</a>
          </div>
        </li>
   </ul>

  </nav>
	
	@yield('content')
</body>
</html>