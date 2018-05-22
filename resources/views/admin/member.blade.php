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
    <h3 class="title">Members</h3>
    <div class="nav nav-tabs justify-content-end memberstab" id="nav-tab" role="tablist">
      <a class="nav-item nav-link active" id="nav-members-tab" href="/accounts/members" role="tab" aria-controls="nav-members" aria-selected="false">Members</a>
      <a class="nav-item nav-link" id="nav-staff-tab"  href="/accounts/staff" role="tab" aria-controls="nav-staff" aria-selected="false">Staff</a>
      <a class="nav-item nav-link" id="nav-admin-tab"  href="/accounts/admin" role="tab" aria-controls="nav-admin" aria-selected="true">Admin</a>
    </div>
  </nav>
  <!--end of members nav---->
<!---content of tabs start-->
<div class="tab-content" id="nav-tabContent">
  <!-------members------>
  <div class="tab-pane fade  show active" id="nav-members" role="tabpanel" aria-labelledby="nav-members">
  </br>

  <div class="row">
    <div class="col-md-8">
    <button type="button" class="btn btn-outline-info add-mem-btn" data-toggle="modal" data-target=".bd-example-modal-lg">
      Add Member
    </button>
  </div>
  <div class="col-md-4">
    <form class="form ml-auto" action="/accounts/search_member" method="GET">
			<div class="input-group">
    			<input class="form-control" type="text" name ="member_search" placeholder="Search" aria-label="Search" style="padding-left: 20px; border-radius: 40px;" id="member-search">
    			<div class="input-group-addon" style="margin-left: -50px; z-index: 3; border-radius: 40px; background-color: transparent; border:none;">
    				<button class="btn btn-outline-info btn-sm" type="submit" style="border-radius: 100px;" id="search-btn"><i class="material-icons">search</i></button>
    			</div>
			</div>
		</form>
  	</div>
  	</div>

	@if(!empty($search))
    	@if($totalcount > 7)
    		<center><p> Showing {{$count}} out of {{$totalcount}} result<?php if($count > 1){ echo 's'; }else{ echo ''; } ?> for <b> {{ $search }} </b> </p></center>
    	@else
    		<center><p> Showing {{$count}} result<?php if($count > 1){ echo 's'; }else{ echo ''; } ?> for <b> {{ $search }} </b> </p></center>
    	@endif
  	@endif

    <table class="table table-hover">
    @csrf
      <thead class ="th_css">
        <tr>
          <th scope="col">Card No.</th>
          <th scope="col">Name</th>
          <th scope="col">Contact No.</th>
          <th scope="col">Load</th>
          <th scope="col" colspan="2">Actions</th>
        </tr>
      </thead>
      <tbody class="td_class">
      	@foreach($members as $member)
        <tr>
          <th scope="row">{{$member->card_number}}</th>
          <td>{{$member->firstname . " " . $member->lastname}}</td>
          <td>{{$member->contact_number}}</td>
          <td>{{$member->balance->load_balance}}</td>
          <td>
          	<button type="button" id="edit-member" class="btn btn-primary edit-btn" data-toggle="modal" data-target=".edit_member" data-id="{{ $member->id }}" data-cardnumber ="{{ $member->card_number }}" data-firstname="{{$member->firstname}}" data-lastname="{{$member->lastname}}" data-address="{{$member->address}}" data-contact="{{$member->contact_number}}" data-email="{{$member->email}}"><i class="material-icons md-18">mode_edit</i></button>
          	<button type="button" id="delete-member" class="btn btn-danger del-btn" data-id="{{$member->id}}" data-toggle="modal" data-target=".delete_member"><i class="material-icons md-18">delete</i></button>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>

    <div>{{$members->links()}}</div>

    <!----start of modal for add members---->
    <div class="modal fade bd-example-modal-lg add_member" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
          <div class="container-fluid">
          <div class="row">

          <div class="col-md-5 mx-auto">
          <label for="card-no" class="col-form-label modal-card">Card Number:</label>
          <input type="text" name="card_number" class="form-control modal-card" id="cardnumber-add">
      	  <p id="error-cardnumber-add" class="error-add" hidden="hidden"></p></div>
          <div class="col-md-5 mx-auto">
          <label for="initial-load" class="col-form-label modal-load">Initial Load:</label>
          <input type="text" name="load_balance" class="form-control" id="load-add">
      	  <p id="error-load-add" class="error-add" hidden="hidden"></p></div>

        </div>

        <div class="row">
          <div class="col-md-5 mx-auto">
          <label for="first-name" class="col-form-label modal-fname">First Name:</label>
          <input type="text" name="firstname" class="form-control modal-fname" id="firstname-add">
      	  <p id="error-firstname-add" class="error-add" hidden="hidden"></p></div>
          <div class="col-md-5 mx-auto">
          <label for="last-name" class="col-form-label modal-lname">Last Name:</label>
          <input type="text" name="lastname" class="form-control" id="lastname-add">
          <p id="error-lastname-add" class="error-add" hidden="hidden"></p></div>
        </div>

        <div class="row">
          <div class="col-md-11 mx-auto">
          <label for="address" class="col-form-label modal-address">Address:</label>
          <input type="text" name="address" class="form-control modal-add" id="address-add">
      	  <p id="error-address-add" class="error-add" hidden="hidden"></p></div>
        </div>

        <div class="row">

          <div class="col-md-5 mx-auto">
          <label for="contact" class="col-form-label modal-contact">Contact #:</label>
          <input type="text" name="contact_number" class="form-control" id="contact-add">
          <p id="error-contact-add" class="error-add" hidden="hidden"></p></div>
          <div class="col-md-5 mx-auto">
          <label for="email" class="col-form-label modal-mobile">Email:</label>
          <input type="text" name="email" class="form-control" id="email-add">
      	  <p id="error-email-add" class="error-add" hidden="hidden"></p></div>

        </div>

        </div>
        </div>

      </form>
        <div class="modal-footer" id="modal-footer-member-add">
          <button type="button" id="add-member" class="btn btn-info btn-savemem-modal">Save New Member</button>
          <button type="button" class="btn btn-secondary btn-close-modal" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
    </div>

    <!----end of modal---->
    <!----start of modal for EDIT---->
    <div class="modal fade edit_member" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Member</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="nosubmitform">
      <div class="form-group">
      <input type="hidden" name="member_id" id="member-id-edit">
      <div class="container-fluid">
      
      <div class="row">
		<div class="col-md-11 mx-auto">
        <label for="card-no" class="col-form-label modal-card">Card Number:</label>
        <input type="text" name="card_number" class="form-control modal-card" id="cardnumber-edit">
        <p id="error-cardnumber-edit" class="error-edit" hidden="hidden"></p></div>
      </div>

      <div class="row">
        <div class="col-md-5 mx-auto">
        <label for="first-name" class="col-form-label modal-fname">First Name:</label>
        <input type="text" name="firstname" class="form-control modal-fname" id="firstname-edit">
    	<p id="error-firstname-edit" class="error-edit" hidden="hidden"></p></div>
        <div class="col-md-5 mx-auto">
        <label for="last-name" class="col-form-label modal-lname">Last Name:</label>
        <input type="text" name="lastname" class="form-control" id="lastname-edit">
    	<p id="error-lastname-edit" class="error-edit" hidden="hidden"></p></div>
      </div>

      <div class="row">
        <div class="col-md-11 mx-auto">
        <label for="address" class="col-form-label modal-address">Address:</label>
        <input type="text" name="address" class="form-control modal-add" id="address-edit">
    	<p id="error-address-edit" class="error-edit" hidden="hidden"></div>
      </div>

      <div class="row">

        <div class="col-md-5 mx-auto">
        <label for="contact" class="col-form-label modal-contact">Contact #:</label>
        <input type="text" name="contact_number" class="form-control" id="contact-edit">
    	<p id="error-contact-edit" class="error-edit" hidden="hidden"></div>
        <div class="col-md-5 mx-auto">
        <label for="email" class="col-form-label modal-mobile">Email:</label>
        <input type="text" name="email" class="form-control" id="email-edit">
    	<p id="error-email-edit" class="error-edit" hidden="hidden"></div>

      </div>
	
      </div>
      </div>

      <div class="modal-footer" id="modal-footer-member-edit">
        <button type="submit" class="btn btn-info btn-savemem-modal" id="update-member">Save changes</button>
        <button type="button" class="btn btn-secondary btn-close-modal" data-dismiss="modal">Close</button>
      </div>

    </form>
    </div>
    </div>
    </div>
    <!----end of modal---->
    <!----start of modal for DELETE---->
    <div class="modal fade delete_member" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
        <span class="member-id-delete" hidden="hidden"></span>
    </div>

    <div class="modal-footer" id="modal-footer-member-delete">
      <button type="button" id="destroy-member" class="btn btn-info btn-savemem-modal">Yes</button>
      <button type="button" class="btn btn-secondary btn-close-modal" data-dismiss="modal">No</button>

    </div>
    </div>
    </div>
    </div>


    <!----end of modal---->

  </div>

  <script type="text/javascript">

  $('.nosubmitform').submit(function(event){
    event.preventDefault();
  });

  $('.add_member').on('hide.bs.modal', function(){
    //hide error messages in modal
    $("#cardnumber-add").val(""),
    $("#load-add").val(""),
    $("#firstname-add").val(""),
    $("#lastname-add").val(""),
    $("#address-add").val(""),
    $("#contact-add").val(""),
    $("#email-add").val("")
    $('#error-cardnumber-add').attr("hidden", true);
    $('#error-load-add').attr("hidden", true);
    $('#error-firstname-add').attr("hidden", true);
    $('#error-lastname-add').attr("hidden", true);
    $('#error-address-add').attr("hidden", true);
    $('#error-contact-add').attr("hidden", true);
    $('#error-email-add').attr("hidden", true);

    //remove css style in modal
    $('#cardnumber-add').removeAttr('style');
    $('#load-add').removeAttr('style');
    $('#firstname-add').removeAttr('style');
    $('#lastname-add').removeAttr('style');
    $('#address-add').removeAttr('style');
    $('#contact-add').removeAttr('style');
    $('#email-add').removeAttr('style');
  });

  $('.edit_member').on('hide.bs.modal', function(){
    //hide error messages in modal
    $('#error-cardnumber-edit').attr("hidden", true);
    $('#error-firstname-edit').attr("hidden", true);
    $('#error-lastname-edit').attr("hidden", true);
    $('#error-address-edit').attr("hidden", true);
    $('#error-contact-edit').attr("hidden", true);
    $('#error-email-edit').attr("hidden", true);

    //remove css style in modal
    $('#cardnumber-edit').removeAttr('style');
    $('#firstname-edit').removeAttr('style');
    $('#lastname-edit').removeAttr('style');
    $('#address-edit').removeAttr('style');
    $('#contact-edit').removeAttr('style');
    $('#email-edit').removeAttr('style');
  });

  //success alerts - add, update, delete
  $(document).ready(function(){
  if(localStorage.getItem("update"))
  {
    swal({
            title: "Success!",
            text: "You have successfully updated the member!",
            icon: "success",
            button: "Close",
          });
    localStorage.clear();
  }
  else if(localStorage.getItem("delete"))
  {
    swal({
            title: "Success!",
            text: "You have successfully deleted the member!",
            icon: "success",
            button: "Close",
          });
    localStorage.clear(); 
  }
  else if(localStorage.getItem("add"))
  {
    swal({
            title: "Success!",
            text: "You have successfully added a member!",
            icon: "success",
            button: "Close",
          });
    localStorage.clear(); 
  }
  });
  
  //add staff
  $('#modal-footer-member-add').on('click', '#add-member', function(event) {
  $.ajax({
    type: 'POST',
    url: '/accounts/add_member',
    data: {
            '_token': $('input[name=_token]').val(),  
            'card_number': $("#cardnumber-add").val(),
            'load_balance': $("#load-add").val(),
            'firstname': $("#firstname-add").val(),
            'lastname': $("#lastname-add").val(),
            'address': $("#address-add").val(),
            'contact': $("#contact-add").val(),
            'email': $("#email-add").val()
          },
    success: function(data) {
      console.log(data);
      if ((data.errors)) {
          if(data.errors.card_number)
          {
            $('#error-cardnumber-add').removeAttr("hidden");
            $('#error-cardnumber-add').text(data.errors.card_number);
            $('#cardnumber-add').css("border", "1px solid #cc0000");
          }
          else
          {
            $('#error-cardnumber-add').attr("hidden", true);
            $('#cardnumber-add').removeAttr('style');
          }

          if(data.errors.load_balance)
          {
            $('#error-load-add').removeAttr("hidden");
            $('#error-load-add').text(data.errors.load_balance);
            $('#load-add').css("border", "1px solid #cc0000");
          }
          else
          {
            $('#error-load-add').attr("hidden", true);
            $('#load-add').removeAttr('style');
          }

          if(data.errors.firstname)
          {
            $('#error-firstname-add').removeAttr("hidden");
            $('#error-firstname-add').text(data.errors.firstname);
            $('#firstname-add').css("border", "1px solid #cc0000");
          }
          else
          {
            $('#error-firstname-add').attr("hidden", true);
            $('#firstname-add').removeAttr('style');
          }

          if(data.errors.lastname)
          {
            $('#error-lastname-add').removeAttr("hidden");
            $('#error-lastname-add').text(data.errors.lastname);
            $('#lastname-add').css("border", "1px solid #cc0000");
          }
          else
          {
            $('#error-lastname-add').attr("hidden", true);
            $('#lastname-add').removeAttr('style');
          }

          if(data.errors.address)
          {
            $('#error-address-add').removeAttr("hidden");
            $('#error-address-add').text(data.errors.address);
            $('#address-add').css("border", "1px solid #cc0000");
          }
          else
          {
            $('#error-address-add').attr("hidden", true);
            $('#address-add').removeAttr('style');
          }

          if(data.errors.contact)
          {
            $('#error-contact-add').removeAttr("hidden");
            $('#error-contact-add').text(data.errors.contact);
            $('#contact-add').css("border", "1px solid #cc0000");
          }
          else
          {
            $('#error-contact-add').attr("hidden", true);
            $('#contact-add').removeAttr('style');
          }

          if(data.errors.email)
          {
            $('#error-email-add').removeAttr("hidden");
            $('#error-email-add').text(data.errors.email);
            $('#email-add').css("border", "1px solid #cc0000");
          }
          else
          {
            $('#error-email-add').attr("hidden", true);
            $('#email-add').removeAttr('style');
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

  //edit member
  $(document).on('click', '#edit-member', function() {
  	$('#member-id-edit').val($(this).data('id'));
    $('#cardnumber-edit').val($(this).data('cardnumber'));
    $("#firstname-edit").val($(this).data('firstname'));
    $("#lastname-edit").val($(this).data('lastname'));
    $("#address-edit").val($(this).data('address'));
    $("#contact-edit").val($(this).data('contact'));
    $("#email-edit").val($(this).data('email'));
  });	

  $('#modal-footer-member-edit').on('click', '#update-member', function(event) {
  $.ajax({
    type: 'POST',
    url: '/accounts/update_member',
    data: {
            '_token': $('input[name=_token]').val(),
            'member_id': $("#member-id-edit").val(),
            'card_number': $("#cardnumber-edit").val(),
            'firstname': $("#firstname-edit").val(),
            'lastname': $("#lastname-edit").val(),
            'address': $("#address-edit").val(),
            'contact': $("#contact-edit").val(),
            'email': $("#email-edit").val()
          },
    success: function(data) {
      console.log(data);
      if ((data.errors)) {
          if(data.errors.card_number)
          {
            $('#error-cardnumber-edit').removeAttr("hidden");
            $('#error-cardnumber-edit').text(data.errors.card_number);
            $('#cardnumber-edit').css("border", "1px solid #cc0000");
          }
          else
          {
            $('#error-username-edit').attr("hidden", true);
            $('#username-edit').removeAttr('style');
          }

          if(data.errors.firstname)
          {
            $('#error-firstname-edit').removeAttr("hidden");
            $('#error-firstname-edit').text(data.errors.firstname);
            $('#firstname-edit').css("border", "1px solid #cc0000");
          }
          else
          {
            $('#error-firstname-edit').attr("hidden", true);
            $('#firstname-edit').removeAttr('style');
          }

          if(data.errors.lastname)
          {
            $('#error-lastname-edit').removeAttr("hidden");
            $('#error-lastname-edit').text(data.errors.lastname);
            $('#lastname-edit').css("border", "1px solid #cc0000");
          }
          else
          {
            $('#error-lastname-edit').attr("hidden", true);
            $('#lastname-edit').removeAttr('style');
          }

          if(data.errors.address)
          {
            $('#error-address-edit').removeAttr("hidden");
            $('#error-address-edit').text(data.errors.address);
            $('#address-edit').css("border", "1px solid #cc0000");
          }
          else
          {
            $('#error-address-edit').attr("hidden", true);
            $('#address-edit').removeAttr('style');
          }

          if(data.errors.contact)
          {
            $('#error-contact-edit').removeAttr("hidden");
            $('#error-contact-edit').text(data.errors.contact);
            $('#contact-edit').css("border", "1px solid #cc0000");
          }
          else
          {
            $('#error-contact-edit').attr("hidden", true);
            $('#contact-edit').removeAttr('style');
          }

          if(data.errors.email)
          {
            $('#error-email-edit').removeAttr("hidden");
            $('#error-email-edit').text(data.errors.email);
            $('#email-edit').css("border", "1px solid #cc0000");
          }
          else
          {
            $('#error-email-edit').attr("hidden", true);
            $('#email-edit').removeAttr('style');
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

  //delete member
  $(document).on('click', '#delete-member', function() {
    $('.member-id-delete').text($(this).data('id'));
  });

  $('#modal-footer-member-delete').on('click', '#destroy-member', function(){
  $.ajax({
    type: 'POST',
    url: '/accounts/delete_member',
    data: {
      '_token': $('input[name=_token]').val(),
      'member_id': $('.member-id-delete').text()
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