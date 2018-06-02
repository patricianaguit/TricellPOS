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
          <td>₱ {{$sale->amount_due}}</td>
          <td>{{$sale->payment_mode}}</td>

          <td> <button type="button" class="btn btn-secondary edit-btn" data-id="{{$sale->id}}" data-discount_id="@if(isset($sale->discount->discount_name)){{$sale->discount->id}}@else
            {{'0'}}
            @endif"><i class="material-icons md-18">receipt</i></button>
		  <button type="button" class="btn btn-danger del-btn" data-toggle="modal" data-target=".delete"><i class="material-icons md-18">delete</i></button>

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
          <h5 class="modal-title" id="exampleModalLabel">View Receipt </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

         <div class="modal-body" id="view_body">

      

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

</div>


<script type="text/javascript">
  $(document).on('click', '.edit-btn', function() {
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


</script>
@endsection