@extends('layout')

@section('title')
ACCOUNTS
@endsection

@section('css')
{{ asset('imports/css/members2.css') }}
@endsection

@section('content')

</br>
<div class="container">
  <!--members nav-->
  <nav>
    <h3 class="title">Admin</h3>
    <div class="nav nav-tabs justify-content-end memberstab" id="nav-tab" role="tablist">
      <a class="nav-item nav-link active " id="nav-admin-tab"  href="/accounts/admin" role="tab" aria-controls="nav-admin" aria-selected="true">Admin</a>
      <a class="nav-item nav-link" id="nav-staff-tab"  href="/accounts/staff" role="tab" aria-controls="nav-staff" aria-selected="false">Staff</a>

    </div>
  </nav>
<!----body of admin start-->
<div class="tab-content" id="nav-tabContent">


  <!-------admin------>
  <div class="tab-pane fade show active" id="nav-admin" role="tabpanel" aria-labelledby="nav-admin-tab">
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
        @foreach($admins as $admin)
        <tr>
          <td>{{ $admin->username }}</td>
          <td>{{ $admin->firstname . " " . $admin->lastname }}</td>
          <td>{{ $admin->email }}</td>
          <td>
            <button type="button" id="view-admin" class="btn btn-secondary view-btn" data-toggle="modal" data-target=".view_admin" data-username ="{{ $admin->username }}" data-firstname="{{$admin->firstname}}" data-lastname="{{$admin->lastname}}" data-address="{{$admin->address}}" data-contact="{{$admin->contact_number}}" data-email="{{$admin->email}}"><i class="material-icons md-18">info_outline</i></button>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    
    <center><div>{{$admins->links()}}</div></center>

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
          <button type="button" class="btn btn-info btn-savemem-modal" data-dismiss="modal" id= "add-admin">Save New Admin</button>
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
        <input type="text" class="form-control modal-card" id="username-view" disabled="disabled"> </div>

        <div class="col-md-11 mx-auto">
        <label for="password" class="col-form-label modal-password">Password:</label>
        <input type="password" class="form-control" value ="{{rand()}}" id="password-view" disabled="disabled"></div>

        <div class="col-md-11 mx-auto">
        <label for="first-name" class="col-form-label modal-fname">First Name:</label>
        <input type="text" class="form-control modal-fname" id="firstname-view" disabled="disabled"></div>

        <div class="col-md-11 mx-auto">
        <label for="last-name" class="col-form-label modal-lname">Last Name:</label>
        <input type="text" class="form-control" id="lastname-view" disabled="disabled"></div>

        <div class="col-md-11 mx-auto">
        <label for="address" class="col-form-label modal-address">Address:</label>
        <input type="text" class="form-control modal-add" id="address-view" disabled="disabled"></div>

        <div class="col-md-11 mx-auto">
        <label for="contact" class="col-form-label modal-contact">Contact #:</label>
        <input type="text" class="form-control" id="contact-view" disabled="disabled"></div>

        <div class="col-md-11 mx-auto">
        <label for="email" class="col-form-label modal-mobile">Email:</label>
        <input type="text" class="form-control" id="email-view" disabled="disabled"></div>



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

  <!--View Ajax -->
  <script type="text/javascript">

    $(document).on('click', '#view-admin', function() {
    $('#username-view').val($(this).data('username'));
    $("#firstname-view").val($(this).data('firstname'));
    $("#lastname-view").val($(this).data('lastname'));
    $("#address-view").val($(this).data('address'));
    $("#contact-view").val($(this).data('contact'));
    $("#email-view").val($(this).data('email'));
  });
    
  </script>
  
@endsection
