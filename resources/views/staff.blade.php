@extends('layout')

@section('title')
ACCOUNTS
@endsection

@section('content')

</br>
<div class="container">
  <!--members nav-->
  <nav>
    <h3 class="title">Staff</h3>
    <div class="nav nav-tabs justify-content-end memberstab" id="nav-tab" role="tablist">
      <a class="nav-item nav-link " id="nav-members-tab"  href="/accounts/members" role="tab" aria-controls="nav-members" aria-selected="false">Members</a>
      <a class="nav-item nav-link " id="nav-admin-tab"  href="/accounts/admin" role="tab" aria-controls="nav-admin" aria-selected="true">Admin</a>
      <a class="nav-item nav-link active " id="nav-staff-tab"  href="/accounts/staff" role="tab" aria-controls="nav-staff" aria-selected="false">Staff</a>

    </div>
  </nav>
  <!--end of members nav---->
<!---content of tabs start-->
<div class="tab-content" id="nav-tabContent">
  <!-------staff------>
   <div class="tab-pane fade show active" id="nav-staff" role="tabpanel" aria-labelledby="nav-staff-tab">
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
        @foreach($staffs as $staff)
        <tr>
          <td>{{ $staff->username }}</td>
          <td>{{ $staff->firstname . " " . $staff->lastname }}</td>
          <td>{{ $staff->email }}</td>
          <td><button type="button" class="btn btn-danger del-btn" data-toggle="modal" data-target=".delete_staff"><i class="material-icons md-18">delete</i></button>
            <button type="button" class="btn btn-primary edit-btn" data-toggle="modal" data-target=".edit_staff"><i class="material-icons md-18">mode_edit</i></button>
          </td>
        </tr>
        @endforeach
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
@endsection
