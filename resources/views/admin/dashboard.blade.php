@extends('layout')

@section('title')
DASHBOARD
@endsection

@section('css')
{{ asset('imports/css/dashboard.css') }}
@endsection

@section('content')
<div class="container-fluid">
   <br>
   <div class="row">
      <div class="col m-1" id="new-customers">
         New Customers
         <center>
            <h1>{{$newmembers}}</h1>
         </center>
      </div>
      <div class="col m-1" id="new-quotes">
         Reload Sales
         <center>
            <h1>{{$reloadsales}}</h1>
         </center>
      </div>
      <div class="col m-1" id="new-orders">
         Product Sales
         <center>
            <h1>{{$sales}}</h1>
         </center>
      </div>
      <div class="col m-1" id="new-invoices">
         Low Stock Items
         <center>
            <h1>{{$lowstock}}</h1>
         </center>
      </div>
   </div>
   <div class="row">
      <div class="col m-1 border" id="top-products">
         <h6>Top Sales by Product</h6>
      </div>
      <div class="col m-1 border" id="active-members">
         <h6>Most Active Members</h6>
      </div>
   </div>
   <div class="row">
      <div class="col m-1 border" id="sales-day">
         <h6>Sales per Day</h6>
      </div>
      <div class="col m-1 border" id="sales-payment">
         <h6>Sales by Payment Mode</h6>
      </div>
      <div class="col m-1 border" id="member-walkin">
         <h6>Member vs Walk-in</h6>
      </div>
   </div>
</div>
@endsection