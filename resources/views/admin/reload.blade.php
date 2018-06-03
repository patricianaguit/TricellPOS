@extends('layout')

@section('title')
RELOAD SALES
@endsection

@section('css')
{{ asset('imports/css/sales.css') }}
@endsection

@section('content')

</br>
<div class="container">
<!---title inventory-->
<h3 class="title">Reload Sales Record</h3>
</br>
<hr>
<!---end of title inventory-->
<!--second row add item button and search bar--->
<div class="row">
    <div class="col-md-8">
   <h3 class="text-info">Total Sales: <span style="color:dimgray">P100</span></h3>
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
 </div> <!----end of second row--->
 <!---table start---->
    <table class="table table-hover">
      <thead class ="th_css">
        <tr>
          <th scope="col">Date</th>
          <th scope="col">Card Number</th>
          <th scope="col">Member Name</th>
          <th scope="col">Amount Reloaded</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody class="td_class">
        @foreach($reloads as $reload)
        <tr>
          <th scope="row">{{date("F d, Y", strtotime($reload->transaction_date))}}</th>
          <td>{{$reload->user->card_number}}</td>
          <td>{{$reload->user->firstname . " " . $reload->user->lastname}}</td>
          <td>₱ {{number_format($reload->amount_due,2, '.', '')}}</td>

          <td> <button type="button" class="btn btn-secondary edit-btn" data-toggle="modal" data-target=".view"><i class="material-icons md-18">receipt</i></button>
      <button type="button" class="btn btn-danger del-btn" data-toggle="modal" data-target=".delete"><i class="material-icons md-18">delete</i></button>

          </td>
        </tr>
        @endforeach

      </tbody>
    </table>


   <!----start of modal for view---->
    <div class="modal fade view_details" tabindex="-1" role="dialog">
   <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">View Receipt</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

         <div class="modal-body">
      <table class="table table_modal">
  <thead>
    <tr>
      <th scope="col">Description</th>
      <th scope="col"></th>
      <th scope="col">Price</th>
      <th scope="col">Subtotal</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>Reload</td>
      <td></td>
      <td>P1.00</td>
      <td>P1.00</td>
    </tr>

  <tr class="table-light">
      <td colspan="3"><b>Subtotal</b></td>
      <td colspan="2"> P1.00</td>
  </tr>
  <tr class="table-light">
      <td colspan="3"><b>Total</b></td>
      <td colspan="2"> P1.00</td>
  </tr>
  <tr class="table-light">
      <td colspan="3"><b>Amount Paid</b></td>
      <td colspan="2">₱ 100 <span class="payment"></span></td>
  </tr>
  <tr class="table-light">
      <td colspan="3"><b>Change</b></td>
      <td colspan="2">₱ 100<span class="change"></span></td>
  </tr>
  </tbody>

</table>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-info btn-save-modal" data-dismiss="modal">Print</button>
          <button type="button" class="btn btn-secondary btn-close-modal" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
    </div>
    <!----end of modal---->
   <!----start of modal for DELETE---->
    <div class="modal fade delete" tabindex="-1" role="dialog">
    <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Message</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
        <center>  <p> Are you sure you want to delete this <b>log</b>?</p> </center>
        </div>

    <div class="modal-footer">
      <button type="button" class="btn btn-info btn-save-modal" data-dismiss="modal">Yes</button>
      <button type="button" class="btn btn-secondary btn-close-modal" data-dismiss="modal">No</button>

    </div>
    </div>
    </div>
    </div>


    <!----end of modal---->

</div><!-- end of container --->

@endsection