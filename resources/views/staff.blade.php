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
    <h3 class="title">Staff</h3>
    <div class="nav nav-tabs justify-content-end memberstab" id="nav-tab" role="tablist">
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
    <form class="form ml-auto" action="/accounts/search_staff" method="GET">
      <div class="input-group">
          <input class="form-control"  type="text" name ="staff_search" value="{{ old('username') }}" placeholder="Search by Username" aria-label="Search" style="padding-left: 20px; border-radius: 40px;" id="staff-search">
          <div class="input-group-addon" style="margin-left: -50px; z-index: 3; border-radius: 40px; background-color: transparent; border:none;">
            <button class="btn btn-outline-info btn-sm" type="submit" style="border-radius: 100px;" id="staff-search-submit"><i class="material-icons">search</i></button>
          </div>
      </div>
    </form>
  </div>
  </div>
  @if(!empty($search))
  <center><p> Showing {{$count }} results for <b> {{ $search }} </b> </p>
  @endif
  <table class="table table-hover" id="table">
    @csrf
      <thead class ="th_css">
        <tr>
          <th scope="col">Username</th>
          <th scope="col">Name</th>
          <th scope="col">E-mail Address</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody class="td_class">
        @foreach($staffs as $staff)
        <tr class="staff{{$staff->id}}">
          <td>{{ $staff->username }}</td>
          <td>{{ $staff->firstname . " " . $staff->lastname }}</td>
          <td>{{ $staff->email }}</td>
          <td>
            <button type="button" id="edit-staff" class="btn btn-primary edit-btn" data-toggle="modal" data-target=".edit_staff" data-id="{{ $staff->id }}" data-username ="{{ $staff->username }}" data-firstname="{{$staff->firstname}}" data-lastname="{{$staff->lastname}}" data-address="{{$staff->address}}" data-contact="{{$staff->contact_number}}" data-email="{{$staff->email}}"><i class="material-icons md-18">mode_edit</i></button>
            <button type="button" id="delete-staff" class="btn btn-danger del-btn" data-id="{{ $staff->id }}" data-toggle="modal" data-target=".delete_staff"><i class="material-icons md-18">delete</i></button>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    
    {{$staffs->links()}}

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

        <form id="add-form">
        <div class="form-group">
          <div class="containter-fluid">
          <div class="row">  
          <div class="col-md-11 mx-auto">
          <label for="username" class="col-form-label modal-user">Username:</label>
          <input type="text" name="username" class="form-control modal-card" id="username-add">
          <p class="error-username-add" id="error-add" hidden="hidden"></p></div>
          <div class="col-md-11 mx-auto">
          <label for="password" class="col-form-label modal-password">Password:</label>
          <input type="password" name="password" class="form-control" id="password-add">
          <p class="error-password-add" id="error-add" hidden="hidden"></p></div>
          <div class="col-md-11 mx-auto">
          <label for="password_confirmation" class="col-form-label modal-password">Confirm Password:</label>
          <input type="password" name="password_confirmation" class="form-control" id="confirm-password-add">
          <p class="error-confirm-password-add" id="error-add" hidden="hidden"></div>

        </div>

        <div class="row">
          <div class="col-md-11 mx-auto">
          <label for="first-name" class="col-form-label modal-fname">First Name:</label>
          <input type="text" name="firstname" class="form-control modal-fname" id="firstname-add">  
          <p class="error-firstname-add" id="error-add" hidden="hidden"></p></div>
          <div class="col-md-11 mx-auto">
          <label for="last-name" class="col-form-label modal-lname">Last Name:</label>
          <input type="text" name="lastname" class="form-control" id="lastname-add">  
          <p class="error-lastname-add" id="error-add" hidden="hidden"></p></div>
        </div>

        <div class="row">
          <div class="col-md-11 mx-auto">
          <label for="address" class="col-form-label modal-address">Address:</label>
          <input type="text" name="address" class="form-control modal-add" id="address-add">  
          <p class="error-address-add" id="error-add" hidden="hidden"></p></div>
        </div>

        <div class="row">
          <div class="col-md-11 mx-auto">
          <label for="contact" class="col-form-label modal-contact">Contact #:</label>
          <input type="text" name="contact_number" class="form-control" id="contact-add"> 
          <p class="error-contact-add" id="error-add" hidden="hidden"></p></div>
          <div class="col-md-11 mx-auto">
          <label for="email" class="col-form-label modal-mobile">E-mail Address:</label>
          <input type="email" name="email" class="form-control" id="email-add"> 
          <p class="error-email-add" id="error-add" hidden="hidden"></p></div>

        </div>

        </div>
        </div>

        <div class="modal-footer" id="modal-footer-staff-add">
          <button type="button" id="add-staff" class="btn btn-info btn-savemem-modal">Save New Staff</button>
          <button type="button" class="btn btn-secondary btn-close-modal" data-dismiss="modal">Close</button>
        </div>
      </form>
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
      
      <form id="edit-form">
      <input type="hidden" name="staff_id" id="staff-id-edit">
      <div class="form-group">
        <div class="containter-fluid">
        <div class="row">
        <div class="col-md-5 mx-auto">
        <label for="username" class="col-form-label modal-user">Username:</label>
        <input type="text" name="username" class="form-control modal-card" id="username-edit">
        <p class="error-username-edit" id="error-edit" hidden="hidden"></p></div>
        <div class="col-md-5 mx-auto">
        <label for="password" class="col-form-label modal-password">Password:</label>
        <input type="password" name="password" class="form-control" id="password-edit">
        <p class="error-password-edit" id="error-edit" hidden="hidden"></p></div>

      </div>

      <div class="row">
        <div class="col-md-5 mx-auto">
        <label for="first-name" class="col-form-label modal-fname">First Name:</label>
        <input type="text" name="firstname" class="form-control modal-fname" id="firstname-edit">
        <p class="error-firstname-edit" id="error-edit" hidden="hidden"></p></div>
        <div class="col-md-5 mx-auto">
        <label for="last-name"  class="col-form-label modal-lname">Last Name:</label>
        <input type="text" name="lastname" class="form-control" id="lastname-edit">
        <p class="error-lastname-edit" id="error-edit" hidden="hidden"></p></div>
      </div>

      <div class="row">
        <div class="col-md-11 mx-auto">
        <label for="address" class="col-form-label modal-address">Address:</label>
        <input type="text" name="address" class="form-control modal-add" id="address-edit">
        <p class="error-address-edit" id="error-edit" hidden="hidden"></p></div>
      </div>

      <div class="row">
        <div class="col-md-5 mx-auto">
        <label for="contact" class="col-form-label modal-contact">Contact #:</label>
        <input type="text" name="contact_number" class="form-control" id="contact-edit">
        <p class="error-contact-edit" id="error-edit" hidden="hidden"></p></div>
        <div class="col-md-5 mx-auto">
        <label for="email" class="col-form-label modal-mobile">E-mail Address:</label>
        <input type="email" name="email" class="form-control" id="email-edit">
        <p class="error-email-edit" id="error-edit" hidden="hidden"></p></div>

      </div>

      </div>
      </div>

      <div class="modal-footer" id="modal-footer-staff-edit">
        <button type="button" id="update-staff" class="btn btn-info btn-savemem-modal">Save Changes</button></a>
        <button type="button" class="btn btn-secondary btn-close-modal" data-dismiss="modal">Close</button>
      </div>
    </form>
    </div>
    </div>
    </div>
    <!----end of modal---->
    <!----start of modal for DELETE---->
    <form>
    <div class="modal fade delete_staff" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
        <center>  <p> Are you sure you want to delete this <b>staff?</b></p> </center>
        <span class="staff-id-delete" hidden="hidden"></span>
        </div>

    <div class="modal-footer" id="modal-footer-staff-delete">
      <button type="button" id="destroy-staff" class="btn btn-info btn-savemem-modal">Yes</button>
      <button type="button" class="btn btn-secondary btn-close-modal" data-dismiss="modal">No</button>
    </div>
    </div>
    </div>
    </div>
    </form>

    <!----end of modal---->

  </div>
    
  <script type="text/javascript">
  
  $('.edit_staff').on('hide.bs.modal', function(){
    $('.error-username-edit').attr("hidden", true);
    $('.error-password-edit').attr("hidden", true);
    $('.error-firstname-edit').attr("hidden", true);
    $('.error-lastname-edit').attr("hidden", true);
    $('.error-address-edit').attr("hidden", true);
    $('.error-contact-edit').attr("hidden", true);
    $('.error-email-edit').attr("hidden", true);
  });

  $('.add_staff').on('hide.bs.modal', function(){
    $('.error-username-add').attr("hidden", true);
    $('.error-password-add').attr("hidden", true);
    $('.error-confirm-password-add').attr("hidden", true);
    $('.error-firstname-add').attr("hidden", true);
    $('.error-lastname-add').attr("hidden", true);
    $('.error-address-add').attr("hidden", true);
    $('.error-contact-add').attr("hidden", true);
    $('.error-email-add').attr("hidden", true);
  });


  $(document).ready(function(){
  if(localStorage.getItem("update"))
  {
    swal({
            title: "Success!",
            text: "You have successfully updated the staff!",
            icon: "success",
            button: "Close",
          });
    localStorage.clear();
  }
  else if(localStorage.getItem("delete"))
  {
    swal({
            title: "Success!",
            text: "You have successfully deleted the staff!",
            icon: "success",
            button: "Close",
          });
    localStorage.clear(); 
  }
  else if(localStorage.getItem("add"))
  {
    swal({
            title: "Success!",
            text: "You have successfully added a staff!",
            icon: "success",
            button: "Close",
          });
    localStorage.clear(); 
  }
  });

  //add staff
  $('#modal-footer-staff-add').on('click', '#add-staff', function(event) {
  $.ajax({
    type: 'POST',
    url: '/accounts/add_staff',
    data: {
            '_token': $('input[name=_token]').val(),  
            'username': $("#username-add").val(),
            'password': $("#password-add").val(),
            'password_confirmation': $("#confirm-password-add").val(),
            'firstname': $("#firstname-add").val(),
            'lastname': $("#lastname-add").val(),
            'address': $("#address-add").val(),
            'contact': $("#contact-add").val(),
            'email': $("#email-add").val()
          },
    success: function(data) {
      console.log(data);
      if ((data.errors)) {
          if(data.errors.username)
          {
            $('.error-username-add').removeAttr("hidden");
            $('.error-username-add').text(data.errors.username);
          }
          else
          {
            $('.error-username-add').attr("hidden", true);
          }

          if(data.errors.password)
          {
            $('.error-password-add').removeAttr("hidden");
            $('.error-password-add').text(data.errors.password);
          }
          else
          {
            $('.error-password-add').attr("hidden", true);
          }

          if(data.errors.password_confirmation)
          {
            $('.error-confirm-password-add').removeAttr("hidden");
            $('.error-confirm-password-add').text(data.errors.password_confirmation);
          }
          else
          {
            $('.error-password-add').attr("hidden", true);
          }

          if(data.errors.firstname)
          {
            $('.error-firstname-add').removeAttr("hidden");
            $('.error-firstname-add').text(data.errors.firstname);
          }
          else
          {
            $('.error-firstname-add').attr("hidden", true);
          }

          if(data.errors.lastname)
          {
            $('.error-lastname-add').removeAttr("hidden");
            $('.error-lastname-add').text(data.errors.lastname);
          }
          else
          {
            $('.error-lastname-add').attr("hidden", true);
          }

          if(data.errors.address)
          {
            $('.error-address-add').removeAttr("hidden");
            $('.error-address-add').text(data.errors.address);
          }
          else
          {
            $('.error-address-add').attr("hidden", true);
          }

          if(data.errors.contact)
          {
            $('.error-contact-add').removeAttr("hidden");
            $('.error-contact-add').text(data.errors.contact);
          }
          else
          {
            $('.error-contact-add').attr("hidden", true);
          }

          if(data.errors.email)
          {
            $('.error-email-add').removeAttr("hidden");
            $('.error-email-add').text(data.errors.email);
          }
          else
          {
            $('.error-email-add').attr("hidden", true);
          }
      }
      else
      {
        localStorage.setItem("add","success");
        window.location.reload();
      }
    },

        error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
        console.log(JSON.stringify(jqXHR));
        console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
        }
    });
  });


  // edit staff
  $(document).on('click', '#edit-staff', function() {
    $('#staff-id-edit').val($(this).data('id'));
    $('#username-edit').val($(this).data('username'));
    $('#password-edit').val("");
    $("#firstname-edit").val($(this).data('firstname'));
    $("#lastname-edit").val($(this).data('lastname'));
    $("#address-edit").val($(this).data('address'));
    $("#contact-edit").val($(this).data('contact'));
    $("#email-edit").val($(this).data('email'));
  });

  $('#modal-footer-staff-edit').on('click', '#update-staff', function(event) {
  $.ajax({
    type: 'POST',
    url: '/accounts/update_staff',
    data: {
            '_token': $('input[name=_token]').val(),
            'staff_id': $("#staff-id-edit").val(),
            'username': $("#username-edit").val(),
            'password': $("#password-edit").val(),
            'firstname': $("#firstname-edit").val(),
            'lastname': $("#lastname-edit").val(),
            'address': $("#address-edit").val(),
            'contact': $("#contact-edit").val(),
            'email': $("#email-edit").val()
          },
    success: function(data) {
      console.log(data);
      if ((data.errors)) {
          if(data.errors.username)
          {
            $('.error-username-edit').removeAttr("hidden");
            $('.error-username-edit').text(data.errors.username);
          }
          else
          {
            $('.error-username-edit').attr("hidden", true);
          }

          if(data.errors.password)
          {
            $('.error-password-edit').removeAttr("hidden");
            $('.error-password-edit').text(data.errors.password);
          }
          else
          {
            $('.error-password-edit').attr("hidden", true);
          }

          if(data.errors.firstname)
          {
            $('.error-firstname-edit').removeAttr("hidden");
            $('.error-firstname-edit').text(data.errors.firstname);
          }
          else
          {
            $('.error-firstname-edit').attr("hidden", true);
          }

          if(data.errors.lastname)
          {
            $('.error-lastname-edit').removeAttr("hidden");
            $('.error-lastname-edit').text(data.errors.lastname);
          }
          else
          {
            $('.error-lastname-edit').attr("hidden", true);
          }

          if(data.errors.address)
          {
            $('.error-address-edit').removeAttr("hidden");
            $('.error-address-edit').text(data.errors.address);
          }
          else
          {
            $('.error-address-edit').attr("hidden", true);
          }

          if(data.errors.contact)
          {
            $('.error-contact-edit').removeAttr("hidden");
            $('.error-contact-edit').text(data.errors.contact);
          }
          else
          {
            $('.error-contact-edit').attr("hidden", true);
          }

          if(data.errors.email)
          {
            $('.error-email-edit').removeAttr("hidden");
            $('.error-email-edit').text(data.errors.email);
          }
          else
          {
            $('.error-email-edit').attr("hidden", true);
          }
      }
      else
      {
        localStorage.setItem("update","success");
        window.location.reload();   
      }
      },

        error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
        console.log(JSON.stringify(jqXHR));
        console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
        }
    });
  });


  //delete staff'
  $(document).on('click', '#delete-staff', function() {
    $('.staff-id-delete').text($(this).data('id'));
  });

  $('#modal-footer-staff-delete').on('click', '#destroy-staff', function(){
  $.ajax({
    type: 'POST',
    url: '/accounts/delete_staff',
    data: {
      '_token': $('input[name=_token]').val(),
      'staff_id': $('.staff-id-delete').text()
    },
    success: function(data){
      localStorage.setItem("delete","success");
      window.location.reload();
    },
       error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
        console.log(JSON.stringify(jqXHR));
        console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
      }
    });
  });

  </script>
@endsection
