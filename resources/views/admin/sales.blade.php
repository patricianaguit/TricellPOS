@extends('layout')

@section('title')
SALES
@endsection

@section('css')
{{ asset('imports/css/sales.css') }}
@endsection

@section('content')

</br>
<div class="container">
<!---title inventory-->
<h3 class="title">Sales Record</h3>
</br>
<hr>
<!---end of title inventory-->
<!--second row add item button and search bar--->
<div class="row">
  <div class="col-md-8">
    <h3 class="text-info">Total Sales: <span style="color:dimgray">₱ {{number_format($sumsales,2)}}</span></h3>
  </div>
   
  <div class="col-md-4">
    <form class="form ml-auto" action="/logs/sales/search" method="GET">
      <div class="input-group date" id="datetimepicker4" data-target-input="nearest">
          <input class="form-control datetimepicker-input" name="search" type="text" placeholder="Search by Date" aria-label="Search" style="padding-left: 20px; border-radius: 40px;" id="product-search" data-toggle ="datetimepicker" data-target="#datetimepicker4" autocomplete="off">
          <div class="input-group-addon" style="margin-left: -50px; z-index: 3; border-radius: 40px; background-color: transparent; border:none;">
              <button class="btn btn-outline-info btn-sm" type="submit" style="border-radius: 100px;" id="search-btn"><i class="material-icons">search</i></button>
          </div>
      </div>
    </form>
  </div>
 </div> <!----end of second row--->
 <!---table start---->

 @if(!empty($search))
      @if($totalcount > 7)
        <center><p> Showing {{$count}} out of {{$totalcount}}
          @if($count > 1)
            {{'results'}}
          @else
            {{'result'}}
          @endif
        for <b> {{ $search }} </b> </p></center>
      @else
        <center><p> Showing {{$count}}
        @if($count > 1 || $count == 0)
          {{'results'}}
        @else
          {{'result'}}
        @endif
          for <b> {{ $search }} </b> </p></center>
      @endif
  @endif
    <table class="table table-hover">
      @csrf
      <thead class ="th_css">
        <tr>
		      <th scope="col">Date</th>
          <th scope="col">Customer Name</th>
          <th scope="col">Account Type</th>
		      <th scope="col">Discount</th>
          <th scope="col">Total</th>
          <th scope="col">Mode of Payment</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody class="td_class">
        @foreach($sales as $sale)
        <!-- <input type="text" value="{{$sale->id}}" class="sales_id" hidden="hidden"> -->
        <tr>
          <th scope="row">{{ date("F d, Y", strtotime($sale->transaction_date)) }}</th>
          <td>{{$sale->user->firstname . " " . $sale->user->lastname}}</td>
          <td>{{ucfirst($sale->user->role)}}</td>
          <td>
            @if(isset($sale->discount->discount_name))
            {{$sale->discount->discount_name}}
            @else
            {{'None'}}
            @endif
          </td>
          <td>₱ {{number_format($sale->amount_due,2, '.', '')}}</td>
          <td>{{$sale->payment_mode}}</td>

          <td> <button type="button" class="btn btn-secondary edit-btn" id="view-receipt" data-id="{{$sale->id}}" data-discount_id="@if(isset($sale->discount->discount_name)){{$sale->discount->id}}@else
            {{'0'}}
            @endif"><i class="material-icons md-18">receipt</i></button>
		  <button type="button" class="btn btn-danger del-btn" id="delete-sales" data-id="{{$sale->id}}" data-toggle="modal" data-target=".delete"><i class="material-icons md-18">delete</i></button>

          </td>
        </tr>
        @endforeach


      </tbody>
    </table>

    {{$sales->links()}}


   <!----start of modal for view---->
  <div class="modal fade view_details" tabindex="-1" role="dialog">
    <div class="modal-dialog ">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Receipt #<span class="receiptnumber"></span></h5> <br>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

         <div class="modal-body" id="view_body">
      </div>
    </div>
  </div>

    <!----end of modal---->
   <!----start of modal for DELETE---->
    <div class="modal fade delete" tabindex="-1" role="dialog">
    <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Delete Log</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
        <center> <p> Are you sure you want to delete this <b>sales log</b>?</p> </center>
        <span class="sales-id-delete" hidden="hidden"></span>
        </div>

    <div class="modal-footer" id="modal-footer-sales-delete">
      <button type="button" class="btn btn-info btn-save-modal" id="destroy-sales">Yes</button>
      <button type="button" class="btn btn-secondary btn-close-modal" data-dismiss="modal">No</button>

    </div>
    </div>
    </div>
    </div>


    <!----end of modal---->

</div>


<script type="text/javascript">
  $(document).on('click', '#view-receipt', function() {
    $.ajax({
    type: 'POST',
    url: '/logs/sales/showdetails',
    data: {
      '_token': $('input[name=_token]').val(),
      'sales_id': $(this).data('id'),
      'discount_id': $(this).data('discount_id')
    },
    success: function(data){
    console.log(data);

      $('.view_details').modal('show');
      $('#view_body').html(data);
      $('.receiptnumber').text($('#sales_id').val());
      var sum = 0;

      $('.totalprice').each(function() {
         sum += parseFloat($(this).text().replace('₱', ''));  
      });
      $('.subtotal').text(sum.toFixed(2));


      
      if($('#discount_id').val() == 1)
      {
        var subtotal = $('.subtotal').text();
        var discount_name = $('#discount_name').val();
        var discount_percent = $('#discount_percent').val() * 100;
        var zero = 0;
        
        $('.vat').text(zero.toFixed(2));
        $('.vatsale').text(zero.toFixed(2));

        var vatexempt =  subtotal / 1.12;
        $('.vatexempt').text(vatexempt.toFixed(2));

        $('.zerorated').text(zero.toFixed(2));

        var percent = $('#discount_percent').val()
        var discount = (vatexempt * percent);
        $('.discount').text(discount.toFixed(2));

        var total = vatexempt -  discount;
        $('.total').text(total.toFixed(2));

        $('.discount_name').text('[' + discount_name + ' ' + discount_percent + '%]');
      }
      else
      {
        var zero = 0;
        var subtotal = $('.subtotal').text();
        var vatsale =  subtotal / 1.12;
        var vat = vatsale * .12;
        var discount_name = $('#discount_name').val();
        var discount_amount = $('#discount_amount').val();
        var discount_percent = $('#discount_percent').val() * 100;

        $('.vat').text(vat.toFixed(2));
        $('.vatsale').text(vatsale.toFixed(2));
        $('.vatexempt').text(zero.toFixed(2));
        $('.zerorated').text(zero.toFixed(2));

        if(discount_percent == '' && discount_amount != 0)
        {
          var discount = discount_amount;
          $('.discount').text(discount);


          var total = subtotal -  discount;
          if(total > 0)
          {
            $('.total').text(total.toFixed(2)); 
          }
          else
          {
            $('.total').text(zero.toFixed(2));
          }

          $('.discount_name').text('[' + discount_name + ' - ₱' + discount_amount + ']');
        }
        else if(discount_percent != '' && discount_amount == 0)
        {
          var percent = $('#discount_percent').val()
          var discount = subtotal * percent;
          $('.discount').text(discount.toFixed(2));

          var total = subtotal -  discount;
          if(total > 0)
          {
            $('.total').text(total.toFixed(2)); 
          }
          else
          {
            $('.total').text(zero.toFixed(2));
          } 

          $('.discount_name').text('[' + discount_name + ' ' + discount_percent + '%]');
        }
        else
        {
          var total = subtotal;
          $('.total').text(total);
        }
      }
      
    },
    error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
      console.log(JSON.stringify(jqXHR));
      console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
    }
    });
  });

  $(document).on('click', '#delete-sales', function() {
    $('.sales-id-delete').text($(this).data('id'));
    $('#delete-name').text($(this).data('prodname'));
  });

  $('#modal-footer-sales-delete').on('click', '#destroy-sales', function(){
  $.ajax({
    type: 'POST',
    url: '/logs/sales/delete_sales',
    data: {
      '_token': $('input[name=_token]').val(),
      'sales_id': $('.sales-id-delete').text()
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

  $(document).ready(function(){
    if(localStorage.getItem("delete"))
    {
        swal({
                title: "Success!",
                text: "You have successfully deleted the sales log!",
                icon: "success",
                button: "Close",
              });
        localStorage.clear();  
    }
  });

  $(function () {
    $('#datetimepicker4').datetimepicker({
        format: "MMMM DD, YYYY"
    });
  });


</script>
@endsection