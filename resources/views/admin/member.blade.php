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
      	@foreach($members as $member)
        <tr>
          <th scope="row">{{$member->card_number}}</th>
          <td>{{$member->firstname . " " . $member->lastname}}</td>
          <td>{{$member->contact_number}}</td>
          <td>{{$member->email}}</td>
          <td>{{$member->balance->load_balance}}</td>
          <td><button type="button" class="btn btn-danger del-btn" data-toggle="modal" data-target=".delete"><i class="material-icons md-18">delete</i></button>
            <button type="button" class="btn btn-primary edit-btn" data-toggle="modal" data-target=".edit"><i class="material-icons md-18">mode_edit</i></button>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>

    <div>{{$members->links()}}</div>

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
@endsection