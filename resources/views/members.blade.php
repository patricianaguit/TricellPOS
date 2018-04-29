<html>
<head>
  <title>MEMBERS</title>
  <meta name="viewport" content="width=device-width", initial-scale="1.0">
  <link rel="stylesheet" type="text/css" href="imports/css/members.css"/>
    <link rel="stylesheet" type="text/css" href="imports/css/nav.css"/>
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
     <li class="nav-item spaces">
       <a class="nav-link" href="#"> DASHBOARD </a>
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
       <a class="nav-link" href="#">MEMBERS</a>
     </li>
     <li class="nav-item spaces">
       <a class="nav-link" href="#">SERVICES</a>
     </li>


     <li class="nav-item dropdown hello">
          <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            HELLO, {{strtoupper(Auth::user()->firstname)}}
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="#">Backup</a>
            <a class="dropdown-item" href="#">Profile</a>
            <a class="dropdown-item" href="#">Shutdown</a>
            <a class="dropdown-item" href="#">Logout</a>
          </div>
        </li>
   </ul>

  </nav>

  <!----END OF NAV--->

<!----body of members start-->
</br>
<div class="container">
  <!----members nav-->
  <nav>
    <h3 class="title">Members</h3>
    <div class="nav nav-tabs justify-content-end memberstab" id="nav-tab" role="tablist">
      <a class="nav-item nav-link active " id="nav-members-tab" data-toggle="tab" href="#nav-members" role="tab" aria-controls="nav-members" aria-selected="false">Members</a>
      <a class="nav-item nav-link " id="nav-admin-tab" data-toggle="tab" href="#nav-admin" role="tab" aria-controls="nav-admin" aria-selected="true">Admin</a>
      <a class="nav-item nav-link" id="nav-staff-tab" data-toggle="tab" href="#nav-staff" role="tab" aria-controls="nav-staff" aria-selected="false">Staff</a>

    </div>
  </nav>
  <!--end of members nav-->
<!---content of tabs start-->
<div class="tab-content" id="nav-tabContent">
  <!-------members-->
  <div class="tab-pane fade  show active" id="nav-members" role="tabpanel" aria-labelledby="nav-members">
  </br>

  <div class="row">
    <div class="col-md-8">
    <button type="button" class="btn btn-outline-info add-mem-btn" data-toggle="modal" data-target=".bd-example-modal-lg">
      Add Member
    </button>
  </div>
  <div class="col-md-4">
    <form class="form ml-auto" >
			<div class="input-group">
    			<input class="form-control" type="text" placeholder="Search" aria-label="Search" style="padding-left: 20px; border-radius: 40px;" id="mysearch">
    			<div class="input-group-addon" style="margin-left: -50px; z-index: 3; border-radius: 40px; background-color: transparent; border:none;">
    				<button class="btn btn-outline-info btn-sm" type="submit" style="border-radius: 100px;" id="search-btn"><i class="material-icons">search</i></button>
    			</div>
			</div>
		</form>
  </div>
  </div>

    <table class="table table-hover">
      <thead class ="th_css">
        <tr>
          <th scope="col">Card No.</th>
          <th scope="col">Name</th>
          <th scope="col">Contact No.</th>
          <th scope="col">Email</th>
          <th scope="col">Card Load</th>
          <th scope="col" colspan="2">Actions</th>
        </tr>
      </thead>
      <tbody class="td_class">
        <tr>
          <th scope="row">1</th>
          <td>Mark</td>
          <td>Otto</td>
          <td>@mdo</td>
          <td>Otto</td>
          <td><button type="button" class="btn btn-danger del-btn" data-toggle="modal" data-target=".delete"><i class="material-icons md-18">delete</i></button>
            <button type="button" class="btn btn-primary edit-btn" data-toggle="modal" data-target=".edit"><i class="material-icons md-18">mode_edit</i></button>
          </td>
        </tr>
        <tr>
          <th scope="row">2</th>
          <td>Jacob</td>
          <td>Thornton</td>
          <td>@fat</td>
          <td>Mark</td>

          <td><button type="button" class="btn btn-danger del-btn" data-toggle="modal" data-target=".delete"><i class="material-icons md-18">delete</i></button>
            <button type="button" class="btn btn-primary edit-btn" data-toggle="modal" data-target=".edit"><i class="material-icons md-18">mode_edit</i></button></td>
        </tr>
        <tr>
          <th scope="row">3</th>
          <td>Larry</td>
          <td>the Bird</td>
          <td>@twitter</td>
          <td>Otto</td>
          <td><button type="button" class="btn btn-danger del-btn" data-toggle="modal" data-target=".delete"><i class="material-icons md-18">delete</i></button>
            <button type="button" class="btn btn-primary edit-btn" data-toggle="modal" data-target=".edit"><i class="material-icons md-18">mode_edit</i></button></td>
        </tr>
        <tr>
          <th scope="row">4</th>
          <td>Larry</td>
          <td>the Bird</td>
          <td>@twitter</td>
          <td>Otto</td>
          <td><button type="button" class="btn btn-danger del-btn" data-toggle="modal" data-target=".delete"><i class="material-icons md-18">delete</i></button>
            <button type="button" class="btn btn-primary edit-btn" data-toggle="modal" data-target=".edit"><i class="material-icons md-18">mode_edit</i></button></td>
        </tr>
        <tr>
          <th scope="row">5</th>
          <td>Larry</td>
          <td>the Bird</td>
          <td>@twitter</td>
          <td>Otto</td>
          <td><button type="button" class="btn btn-danger del-btn" data-toggle="modal" data-target=".delete"><i class="material-icons md-18">delete</i></button>
            <button type="button" class="btn btn-primary edit-btn" data-toggle="modal" data-target=".edit"><i class="material-icons md-18">mode_edit</i></button></td>
        </tr>
        <tr>
          <th scope="row">6</th>
          <td>Larry</td>
          <td>the Bird</td>
          <td>@twitter</td>
          <td>Otto</td>
          <td><button type="button" class="btn btn-danger del-btn" data-toggle="modal" data-target=".delete"><i class="material-icons md-18">delete</i></button>
            <button type="button" class="btn btn-primary edit-btn" data-toggle="modal" data-target=".edit"><i class="material-icons md-18">mode_edit</i></button></td>
        </tr>
        <tr>
          <th scope="row">7</th>
          <td>Larry</td>
          <td>the Bird</td>
          <td>@twitter</td>
          <td>Otto</td>
          <td><button type="button" class="btn btn-danger del-btn" data-toggle="modal" data-target=".delete"><i class="material-icons md-18">delete</i></button>
            <button type="button" class="btn btn-primary edit-btn" data-toggle="modal" data-target=".edit"><i class="material-icons md-18">mode_edit</i></button></td>
        </tr>
        <tr>
          <th scope="row">8</th>
          <td>Larry</td>
          <td>the Bird</td>
          <td>@twitter</td>
          <td>Otto</td>
          <td><button type="button" class="btn btn-danger del-btn" data-toggle="modal" data-target=".delete"><i class="material-icons md-18">delete</i></button>
            <button type="button" class="btn btn-primary edit-btn" data-toggle="modal" data-target=".edit"><i class="material-icons md-18">mode_edit</i></button></td>
        </tr>
        <tr>
          <th scope="row">9</th>
          <td>Larry</td>
          <td>the Bird</td>
          <td>@twitter</td>
          <td>Otto</td>
          <td><button type="button" class="btn btn-danger del-btn" data-toggle="modal" data-target=".delete"><i class="material-icons md-18">delete</i></button>
            <button type="button" class="btn btn-primary edit-btn" data-toggle="modal" data-target=".edit"><i class="material-icons md-18">mode_edit</i></button></td>
        </tr>
        <tr>
          <th scope="row">10</th>
          <td>Larry</td>
          <td>the Bird</td>
          <td>@twitter</td>
          <td>Otto</td>
          <td><button type="button" class="btn btn-danger del-btn" data-toggle="modal" data-target=".delete"><i class="material-icons md-18">delete</i></button>
            <button type="button" class="btn btn-primary edit-btn" data-toggle="modal" data-target=".edit"><i class="material-icons md-18">mode_edit</i></button></td>
        </tr>
      </tbody>
    </table>
    <!----start of modal for add members---->
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add New Member</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <form>
        <div class="form-group">
          <div class="containter-fluid">
          <div class="row">

          <div class="col-md-5 mx-auto">
          <label for="card-no" class="col-form-label modal-card">Card #:</label>
          <input type="text" class="form-control modal-card" id="card-no"></div>
          <div class="col-md-5 mx-auto">
          <label for="initial-load" class="col-form-label modal-load">Initial Load:</label>
          <input type="text" class="form-control" id="initial-load"></div>

        </div>

        <div class="row">
          <div class="col-md-5 mx-auto">
          <label for="first-name" class="col-form-label modal-fname">First Name:</label>
          <input type="text" class="form-control modal-fname" id="first-name"></div>
          <div class="col-md-5 mx-auto">
          <label for="last-name" class="col-form-label modal-lname">Last Name:</label>
          <input type="text" class="form-control" id="last-name"></div>
        </div>

        <div class="row">
          <div class="col-md-11 mx-auto">
          <label for="address" class="col-form-label modal-address">Address:</label>
          <input type="text" class="form-control modal-add" id="address"></div>
        </div>

        <div class="row">

          <div class="col-md-5 mx-auto">
          <label for="contact" class="col-form-label modal-contact">Contact #:</label>
          <input type="text" class="form-control" id="contact"></div>
          <div class="col-md-5 mx-auto">
          <label for="email" class="col-form-label modal-mobile">Email:</label>
          <input type="text" class="form-control" id="email"></div>

        </div>

        </div>
        </div>

      </form>
        <div class="modal-footer">
          <button type="button" class="btn btn-info btn-savemem-modal" data-dismiss="modal">Save New Member</button>
          <button type="button" class="btn btn-secondary btn-close-modal" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
    </div>

    <!----end of modal---->
    <!----start of modal for EDIT---->
    <div class="modal fade edit" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Member</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form>
      <div class="form-group">
        <div class="containter-fluid">
        <div class="row">

        <div class="col-md-5 mx-auto">
        <label for="card-no" class="col-form-label modal-card">Card #:</label>
        <input type="text" class="form-control modal-card" id="card-no"></div>
        <div class="col-md-5 mx-auto">
        <label for="initial-load" class="col-form-label modal-load">Initial Load:</label>
        <input type="text" class="form-control" id="initial-load"></div>

      </div>

      <div class="row">
        <div class="col-md-5 mx-auto">
        <label for="first-name" class="col-form-label modal-fname">First Name:</label>
        <input type="text" class="form-control modal-fname" id="first-name"></div>
        <div class="col-md-5 mx-auto">
        <label for="last-name" class="col-form-label modal-lname">Last Name:</label>
        <input type="text" class="form-control" id="last-name"></div>
      </div>

      <div class="row">
        <div class="col-md-11 mx-auto">
        <label for="address" class="col-form-label modal-address">Address:</label>
        <input type="text" class="form-control modal-add" id="address"></div>
      </div>

      <div class="row">

        <div class="col-md-5 mx-auto">
        <label for="contact" class="col-form-label modal-contact">Contact #:</label>
        <input type="text" class="form-control" id="contact"></div>
        <div class="col-md-5 mx-auto">
        <label for="email" class="col-form-label modal-mobile">Email:</label>
        <input type="text" class="form-control" id="email"></div>

      </div>

      </div>
      </div>

    </form>
      <div class="modal-footer">
        <button type="button" class="btn btn-info btn-savemem-modal" data-dismiss="modal">Save changes</button>
        <button type="button" class="btn btn-secondary btn-close-modal" data-dismiss="modal">Close</button>

      </div>
    </div>
    </div>
    </div>
    <!----end of modal---->
    <!----start of modal for DELETE---->
    <div class="modal fade delete" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Message</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
        <center>  <p> Are you sure you want to delete this <b>member?</b></p> </center>
        </div>

    <div class="modal-footer">
      <button type="button" class="btn btn-info btn-savemem-modal" data-dismiss="modal">Yes</button>
      <button type="button" class="btn btn-secondary btn-close-modal" data-dismiss="modal">No</button>

    </div>
    </div>
    </div>
    </div>


    <!----end of modal---->

  </div>
  <!-------admin------>
  <div class="tab-pane fade" id="nav-admin" role="tabpanel" aria-labelledby="nav-admin-tab">
  </br>
  <div class="row">
    <div class="col-md-8">
      <button type="button" class="btn btn-outline-info add-admin-btn" data-toggle="modal" data-target=".add_admin">Add Admin</button>
  </div>
  <div class="col-md-4">
    <form class="form ml-auto" >
      <div class="input-group">
          <input class="form-control" type="text" placeholder="Search" aria-label="Search" style="padding-left: 20px; border-radius: 40px;" id="mysearch">
          <div class="input-group-addon" style="margin-left: -50px; z-index: 3; border-radius: 40px; background-color: transparent; border:none;">
            <button class="btn btn-outline-info btn-sm" type="submit" style="border-radius: 100px;" id="search-btn"><i class="material-icons">search</i></button>
          </div>
      </div>
    </form>
  </div>
  </div>

    <table class="table table-hover">
      <thead class ="th_css">
        <tr>
          <th scope="col">Username</th>
          <th scope="col">Name</th>
          <th scope="col">Email</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody class="td_class">
        <tr>

          <td>Mark</td>
          <td>Otto</td>
          <td>@mdo</td>
          <td>
            <button type="button" class="btn btn-secondary view-btn" data-toggle="modal" data-target=".view_admin"><i class="material-icons md-18">info_outline</i></button>
          </td>
        </tr>
        <tr>

          <td>Jacob</td>
          <td>Thornton</td>
          <td>@fat</td>
          <td>
            <button type="button" class="btn btn-secondary view-btn" data-toggle="modal" data-target=".view_admin"><i class="material-icons md-18">info_outline</i></button></td>
        </tr>
        <tr>

          <td>Larry</td>
          <td>the Bird</td>
          <td>@twitter</td>
          <td>
            <button type="button" class="btn btn-secondary view-btn" data-toggle="modal" data-target=".view_admin"><i class="material-icons md-18">info_outline</i></button></td>
        </tr>
        <tr>

          <td>Larry</td>
          <td>the Bird</td>
          <td>@twitter</td>
          <td>
            <button type="button" class="btn btn-secondary view-btn" data-toggle="modal" data-target=".view_admin"><i class="material-icons md-18">info_outline</i></button></td>
        </tr>
        <tr>

          <td>Larry</td>
          <td>the Bird</td>
          <td>@twitter</td>
          <td>
            <button type="button" class="btn btn-secondary view-btn" data-toggle="modal" data-target=".view_admin"><i class="material-icons md-18">info_outline</i></button></td>
        </tr>
        <tr>

          <td>Larry</td>
          <td>the Bird</td>
          <td>@twitter</td>
          <td>
            <button type="button" class="btn btn-secondary view-btn" data-toggle="modal" data-target=".view_admin"><i class="material-icons md-18">info_outline</i></button></td>
        </tr>
        <tr>

          <td>Larry</td>
          <td>the Bird</td>
          <td>@twitter</td>
          <td>
            <button type="button" class="btn btn-secondary view-btn" data-toggle="modal" data-target=".view_admin"><i class="material-icons md-18">info_outline</i></button></td>
        </tr>
        <tr>

          <td>Larry</td>
          <td>the Bird</td>
          <td>@twitter</td>
          <td>
            <button type="button" class="btn btn-secondary view-btn" data-toggle="modal" data-target=".view_admin"><i class="material-icons md-18">info_outline</i></button></td>
        </tr>
        <tr>

          <td>Larry</td>
          <td>the Bird</td>
          <td>@twitter</td>
          <td>
            <button type="button" class="btn btn-secondary view-btn" data-toggle="modal" data-target=".view_admin"><i class="material-icons md-18">info_outline</i></button></td>
        </tr>
        <tr>

          <td>Larry</td>
          <td>the Bird</td>
          <td>@twitter</td>
          <td>
            <button type="button" class="btn btn-secondary view-btn" data-toggle="modal" data-target=".view_admin"><i class="material-icons md-18">info_outline</i></button></td>
        </tr>
      </tbody>
    </table>
    <!----start of modal for add admin---->
    <div class="modal fade add_admin" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Admin</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form>
        <div class="form-group">
          <div class="containter-fluid">
          <div class="row">

          <div class="col-md-5 mx-auto">
          <label for="username" class="col-form-label modal-user">Username:</label>
          <input type="text" class="form-control modal-card" id="username"></div>
          <div class="col-md-5 mx-auto">
          <label for="password" class="col-form-label modal-password">Password:</label>
          <input type="password" class="form-control" id="password"></div>

        </div>

        <div class="row">
          <div class="col-md-5 mx-auto">
          <label for="first-name" class="col-form-label modal-fname">First Name:</label>
          <input type="text" class="form-control modal-fname" id="first-name"></div>
          <div class="col-md-5 mx-auto">
          <label for="last-name" class="col-form-label modal-lname">Last Name:</label>
          <input type="text" class="form-control" id="last-name"></div>
        </div>

        <div class="row">
          <div class="col-md-11 mx-auto">
          <label for="address" class="col-form-label modal-address">Address:</label>
          <input type="text" class="form-control modal-add" id="address"></div>
        </div>

        <div class="row">
          <div class="col-md-5 mx-auto">
          <label for="contact" class="col-form-label modal-contact">Contact #:</label>
          <input type="text" class="form-control" id="contact"></div>
          <div class="col-md-5 mx-auto">
          <label for="email" class="col-form-label modal-mobile">Email:</label>
          <input type="text" class="form-control" id="email"></div>

        </div>

        </div>
        </div>

      </form>
        <div class="modal-footer">
          <button type="button" class="btn btn-info btn-savemem-modal" data-dismiss="modal">Save New Admin</button>
          <button type="button" class="btn btn-secondary btn-close-modal" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
    </div>

    <!----end of modal---->
    <!----start of modal for View---->
    <div class="modal fade view_admin" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">View Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form>
      <div class="form-group">
        <div class="containter-fluid">


        <div class="col-md-11 mx-auto">
        <label for="username" class="col-form-label modal-user">Username:</label>
        <input type="text" class="form-control modal-card" id="username" disabled></div>

        <div class="col-md-11 mx-auto">
        <label for="password" class="col-form-label modal-password">Password:</label>
        <input type="password" class="form-control" id="password" disabled></div>

        <div class="col-md-11 mx-auto">
        <label for="first-name" class="col-form-label modal-fname">First Name:</label>
        <input type="text" class="form-control modal-fname" id="first-name" disabled></div>

        <div class="col-md-11 mx-auto">
        <label for="last-name" class="col-form-label modal-lname">Last Name:</label>
        <input type="text" class="form-control" id="last-name" disabled></div>

        <div class="col-md-11 mx-auto">
        <label for="address" class="col-form-label modal-address">Address:</label>
        <input type="text" class="form-control modal-add" id="address" disabled></div>

        <div class="col-md-11 mx-auto">
        <label for="contact" class="col-form-label modal-contact">Contact #:</label>
        <input type="text" class="form-control" id="contact" disabled></div>

        <div class="col-md-11 mx-auto">
        <label for="email" class="col-form-label modal-mobile">Email:</label>
        <input type="text" class="form-control" id="email" disabled></div>



      </div>
      </div>

    </form>
      <div class="modal-footer">

          <button type="button" class="btn btn-info btn-savemem-modal" data-dismiss="modal">Edit</button>
          <button type="button" class="btn btn-secondary btn-close-modal" data-dismiss="modal">Close</button>

      </div>
    </div>
    </div>
    </div>
    <!----end of modal---->



  </div>
  <!-------staff------>
  <div class="tab-pane fade" id="nav-staff" role="tabpanel" aria-labelledby="nav-staff-tab">
  </br>
  <div class="row">
    <div class="col-md-8">
        <button type="button" class="btn btn-outline-info add-staff-btn" data-toggle="modal" data-target=".add_staff">Add Staff</button>
  </div>
  <div class="col-md-4">
    <form class="form ml-auto" >
      <div class="input-group">
          <input class="form-control" type="text" placeholder="Search" aria-label="Search" style="padding-left: 20px; border-radius: 40px;" id="mysearch">
          <div class="input-group-addon" style="margin-left: -50px; z-index: 3; border-radius: 40px; background-color: transparent; border:none;">
            <button class="btn btn-outline-info btn-sm" type="submit" style="border-radius: 100px;" id="search-btn"><i class="material-icons">search</i></button>
          </div>
      </div>
    </form>
  </div>
  </div>
    <table class="table table-hover">
      <thead class ="th_css">
        <tr>
          <th scope="col">Username</th>
          <th scope="col">Name</th>
          <th scope="col">Email</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody class="td_class">
        <tr>

          <td>Mark</td>
          <td>Otto</td>
          <td>@mdo</td>
          <td><button type="button" class="btn btn-danger del-btn" data-toggle="modal" data-target=".delete_staff"><i class="material-icons md-18">delete</i></button>
            <button type="button" class="btn btn-primary edit-btn" data-toggle="modal" data-target=".edit_staff"><i class="material-icons md-18">mode_edit</i></button>
          </td>
        </tr>
        <tr>
          <td>Jacob</td>
          <td>Thornton</td>
          <td>@fat</td>
          <td><button type="button" class="btn btn-danger del-btn" data-toggle="modal" data-target=".delete_staff"><i class="material-icons md-18">delete</i></button>
            <button type="button" class="btn btn-primary edit-btn" data-toggle="modal" data-target=".edit_staff"><i class="material-icons md-18">mode_edit</i></button></td>
        </tr>
        <tr>
          <td>Larry</td>
          <td>the Bird</td>
          <td>@twitter</td>
          <td><button type="button" class="btn btn-danger del-btn" data-toggle="modal" data-target=".delete_staff"><i class="material-icons md-18">delete</i></button>
            <button type="button" class="btn btn-primary edit-btn" data-toggle="modal" data-target=".edit_staff"><i class="material-icons md-18">mode_edit</i></button></td>
        </tr>
        <tr>
          <td>Larry</td>
          <td>the Bird</td>
          <td>@twitter</td>
          <td><button type="button" class="btn btn-danger del-btn" data-toggle="modal" data-target=".delete_staff"><i class="material-icons md-18">delete</i></button>
            <button type="button" class="btn btn-primary edit-btn" data-toggle="modal" data-target=".edit_staff"><i class="material-icons md-18">mode_edit</i></button></td>
        </tr>
        <tr>
          <td>Larry</td>
          <td>the Bird</td>
          <td>@twitter</td>
          <td><button type="button" class="btn btn-danger del-btn" data-toggle="modal" data-target=".delete_staff"><i class="material-icons md-18">delete</i></button>
            <button type="button" class="btn btn-primary edit-btn" data-toggle="modal" data-target=".edit_staff"><i class="material-icons md-18">mode_edit</i></button></td>
        </tr>
        <tr>
          <td>Larry</td>
          <td>the Bird</td>
          <td>@twitter</td>
          <td><button type="button" class="btn btn-danger del-btn" data-toggle="modal" data-target=".delete_staff"><i class="material-icons md-18">delete</i></button>
            <button type="button" class="btn btn-primary edit-btn" data-toggle="modal" data-target=".edit_staff"><i class="material-icons md-18">mode_edit</i></button></td>
        </tr>
        <tr>
          <td>Larry</td>
          <td>the Bird</td>
          <td>@twitter</td>
          <td><button type="button" class="btn btn-danger del-btn" data-toggle="modal" data-target=".delete_staff"><i class="material-icons md-18">delete</i></button>
            <button type="button" class="btn btn-primary edit-btn" data-toggle="modal" data-target=".edit_staff"><i class="material-icons md-18">mode_edit</i></button></td>
        </tr>
        <tr>
          <td>Larry</td>
          <td>the Bird</td>
          <td>@twitter</td>
          <td><button type="button" class="btn btn-danger del-btn" data-toggle="modal" data-target=".delete_staff"><i class="material-icons md-18">delete</i></button>
            <button type="button" class="btn btn-primary edit-btn" data-toggle="modal" data-target=".edit_staff"><i class="material-icons md-18">mode_edit</i></button></td>
        </tr>
        <tr>
          <td>Larry</td>
          <td>the Bird</td>
          <td>@twitter</td>
          <td><button type="button" class="btn btn-danger del-btn" data-toggle="modal" data-target=".delete_staff"><i class="material-icons md-18">delete</i></button>
            <button type="button" class="btn btn-primary edit-btn" data-toggle="modal" data-target=".edit_staff"><i class="material-icons md-18">mode_edit</i></button></td>
        </tr>
        <tr>
          <td>Larry</td>
          <td>the Bird</td>
          <td>@twitter</td>
          <td><button type="button" class="btn btn-danger del-btn" data-toggle="modal" data-target=".delete_staff"><i class="material-icons md-18">delete</i></button>
            <button type="button" class="btn btn-primary edit-btn" data-toggle="modal" data-target=".edit_staff"><i class="material-icons md-18">mode_edit</i></button></td>
        </tr>
      </tbody>
    </table>
    <!----start of modal for add staff---->
    <div class="modal fade add_staff" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Staff</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form>
        <div class="form-group">
          <div class="containter-fluid">
          <div class="row">

          <div class="col-md-5 mx-auto">
          <label for="username" class="col-form-label modal-user">Username:</label>
          <input type="text" class="form-control modal-card" id="username"></div>
          <div class="col-md-5 mx-auto">
          <label for="password" class="col-form-label modal-password">Password:</label>
          <input type="password" class="form-control" id="password"></div>

        </div>

        <div class="row">
          <div class="col-md-5 mx-auto">
          <label for="first-name" class="col-form-label modal-fname">First Name:</label>
          <input type="text" class="form-control modal-fname" id="first-name"></div>
          <div class="col-md-5 mx-auto">
          <label for="last-name" class="col-form-label modal-lname">Last Name:</label>
          <input type="text" class="form-control" id="last-name"></div>
        </div>

        <div class="row">
          <div class="col-md-11 mx-auto">
          <label for="address" class="col-form-label modal-address">Address:</label>
          <input type="text" class="form-control modal-add" id="address"></div>
        </div>

        <div class="row">
          <div class="col-md-5 mx-auto">
          <label for="contact" class="col-form-label modal-contact">Contact #:</label>
          <input type="text" class="form-control" id="contact"></div>
          <div class="col-md-5 mx-auto">
          <label for="email" class="col-form-label modal-mobile">Email:</label>
          <input type="text" class="form-control" id="email"></div>

        </div>

        </div>
        </div>

      </form>
        <div class="modal-footer">
          <button type="button" class="btn btn-info btn-savemem-modal" data-dismiss="modal">Save New Staff</button>
          <button type="button" class="btn btn-secondary btn-close-modal" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
    </div>

    <!----end of modal---->
    <!----start of modal for EDIT---->
    <div class="modal fade edit_staff" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Staff</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form>
      <div class="form-group">
        <div class="containter-fluid">
        <div class="row">

        <div class="col-md-5 mx-auto">
        <label for="username" class="col-form-label modal-user">Username:</label>
        <input type="text" class="form-control modal-card" id="username"></div>
        <div class="col-md-5 mx-auto">
        <label for="password" class="col-form-label modal-password">Password:</label>
        <input type="password" class="form-control" id="password"></div>

      </div>

      <div class="row">
        <div class="col-md-5 mx-auto">
        <label for="first-name" class="col-form-label modal-fname">First Name:</label>
        <input type="text" class="form-control modal-fname" id="first-name"></div>
        <div class="col-md-5 mx-auto">
        <label for="last-name" class="col-form-label modal-lname">Last Name:</label>
        <input type="text" class="form-control" id="last-name"></div>
      </div>

      <div class="row">
        <div class="col-md-11 mx-auto">
        <label for="address" class="col-form-label modal-address">Address:</label>
        <input type="text" class="form-control modal-add" id="address"></div>
      </div>

      <div class="row">
        <div class="col-md-5 mx-auto">
        <label for="contact" class="col-form-label modal-contact">Contact #:</label>
        <input type="text" class="form-control" id="contact"></div>
        <div class="col-md-5 mx-auto">
        <label for="email" class="col-form-label modal-mobile">Email:</label>
        <input type="text" class="form-control" id="email"></div>

      </div>

      </div>
      </div>

    </form>
      <div class="modal-footer">
        <button type="button" class="btn btn-info btn-savemem-modal" data-dismiss="modal">Save Changes</button>
        <button type="button" class="btn btn-secondary btn-close-modal" data-dismiss="modal">Close</button>

      </div>
    </div>
    </div>
    </div>
    <!----end of modal---->
    <!----start of modal for DELETE---->
    <div class="modal fade delete_staff" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Message</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
        <center>  <p> Are you sure you want to delete this <b>staff?</b></p> </center>
        </div>

    <div class="modal-footer">
      <button type="button" class="btn btn-info btn-savemem-modal" data-dismiss="modal">Yes</button>
      <button type="button" class="btn btn-secondary btn-close-modal" data-dismiss="modal">No</button>

    </div>
    </div>
    </div>
    </div>

    <!----end of modal---->

  </div>
</div>

</div>
</body>
</html>
