@extends('layout')

@section('title')
SYSTEM PREFERENCES
@endsection

@section('css')
{{ asset('imports/css/members.css') }}
@endsection

@section('content')
</br>
<div class="container">
  <!----sys pref nav--->
  <nav>
    <h3 class="title">Profile</h3>
    <div class="nav nav-tabs justify-content-end memberstab" id="nav-tab" role="tablist">
      
      <a class="nav-item nav-link active " id="nav-profile-tab" href="/preferences/profile" role="tab" aria-controls="nav-profile" aria-selected="true">Profile
      <a class="nav-item nav-link" id="nav-discount-tab"  href="/preferences/discounts" role="tab" aria-controls="nav-discount" aria-selected="false">Discounts</a>
      <a class="nav-item nav-link" id="nav-discount-tab"  href="/preferences/backup" role="tab" aria-controls="nav-discount" aria-selected="false">Backup</a>
        
      </div>
    </nav>
    <!--sys pref nav---->
    <!---content of tabs start--->
    <div class="tab-content" id="nav-tabContent">
      
      
      <!-------profile------>
      <div class="tab-pane fade show active" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
        </br>
        <form class="nosubmitform">
          </br>
          <div class="row">
            <div class ="col-md-6 members-info border-right">
              
              <div class="form-group row mx-auto">
                <label for="first-name" class="col-form-label col-md-3 modal-fname">Branch Name:</label>
                <div class="col-md-9">
                  <input type="text" name="firstname" class="form-control modal-fname" id="firstname-add">
                  <p id="error-firstname-add" class="error-add" hidden="hidden"></p>
                </div>
              </div>
              <div class="form-group row mx-auto">
                <label for="last-name" class="col-form-label col-md-3 modal-lname">Address:</label>
                <div class="col-md-9">
                  <input type="text" name="lastname" class="form-control" id="lastname-add">
                  <p id="error-lastname-add" class="error-add" hidden="hidden"></p>
                </div>
              </div>
              <div class="form-group row mx-auto">
                <label for="contact" class="col-form-label col-md-3 modal-contact">Contact #:</label>
                <div class="col-md-9">
                  <input type="text" name="contact_number" class="form-control" id="contact-add">
                  <p id="error-contact-add" class="error-add" hidden="hidden"></p>
                </div>
              </div>
              <div class="form-group row mx-auto">
                <label for="email" class="col-form-label col-md-3 modal-mobile">Email:</label>
                <div class="col-md-9">
                  <input type="text" name="email" class="form-control" id="email-add">
                  <p id="error-email-add" class="error-add" hidden="hidden"></p>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row mx-auto">
                <label for="card-no" class="col-form-label col-md-3 modal-card">TIN:</label>
                <div class="col-md-9">
                  <input type="text" name="card_number" class="form-control modal-card" id="cardnumber-add">
                  <p id="error-cardnumber-add" class="error-add" hidden="hidden"></p>
                </div>
              </div>
              <div class="form-group row mx-auto">
                <label for="card-no" class="col-form-label col-md-3 modal-card">VAT %:</label>
                <div class="col-md-9">
                  <input type="text" name="card_number" class="form-control modal-card" id="cardnumber-add">
                  <p id="error-cardnumber-add" class="error-add" hidden="hidden"></p>
                </div>
              </div>
              
            </div>
          </div>
          <div class="modal-footer" id="modal-footer-member-add">
            <button type="submit" id="add-member" class="btn btn-info btn-savemem-modal">Update Profile</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!----end of modal---->
  
</div>
@endsection