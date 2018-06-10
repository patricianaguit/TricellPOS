@extends('layout')

@section('title')
SALE
@endsection

@section('css')
{{ asset('imports/css/pos.css') }}
@endsection

@section('content')

<div class="container-fluid">
  
  <div class="row">
    <div class="col-lg-5 border" id="left">
      <div class="mx-auto">
        
        <div class="row">
          
          <table class="table main-total">
            <tbody>
              <tr>
                <th scope="row" class="table-dark" style="width: 73%" id="total">TOTAL</th>
                <td class="table-dark" id="total">₱ <span class="totalprice">0.00</span></td>
              </tr>
              
            </tbody>
          </table>
          
        </div>
        
        
        <div class="row items-table">
          <table class="table pos-table" id="display_table">
            <thead class="table-light">
              <tr>
                <th scope="col">Description</th>
                <th scope="col">Quantity</th>
                <th scope="col">Price</th>
                <th scope="col">Subtotal</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            
            <tbody>
            </tbody>
          </table>
        </div><!---end of row-->
          
          <div class="row">
            
            <table class="table table-total">
              <tbody>
                
                <tr>
                  <th scope="row" class="table-light" style="width: 73%">Subtotal</th>
                  <td class="table-light">₱ <span class="subtotal">0.00</td>
                </tr>
                <tr>
                  <th scope="row" class="table-light" style="width: 73%">Discount</th>
                  <td class="table-light"> 
                    <input type="hidden" id="discountvalue" value="" data-type=""> 
                    <select class="form-control form-control-sm select-box-discount">
                      <option class="discountoption" data-name="No Discount" data-type="deduction" data-value="0">No Discount</option>
                      @foreach($discounts as $discount)
                        @if($discount->discount_type=='percentage')
                          <option class="discountoption" data-id="{{$discount->id}}" data-name="{{$discount->discount_name}}" data-type="{{$discount->discount_type}}" data-value="{{$discount->discount_value}}">{{$discount->discount_name}} - {{$discount->discount_value * 100}}%</option>
                        @else
                          <option class="discountoption" data-id="{{$discount->id}}" data-name="{{$discount->discount_name}}" data-type="{{$discount->discount_type}}" data-value="{{$discount->discount_value}}">{{$discount->discount_name}} - ₱{{$discount->discount_value}}</option>
                        @endif
                      @endforeach
                    </select></td>
                </tr>
                <tr>
                  <th scope="row" class="table-light" style="width: 73%">VAT</th>
                  <td class="table-light">{{floatval($vat->vat)}}%</td>
                </tr>
                
              </tbody>
            </table>
          </div>
          
          <div class="row" id="onchange">
            <select class="form-control form-control-sm select-box-role">
              <option value="guest" selected>Walk-in</option>
              <option value="member">Member</option>
            </select>
          </div>
          
          <div class="row" id="member">
            <input type="hidden" id="membercardno" value="">
            
            <input type="text" class="form-control form-control-sm" id="member_input">
            <i class="material-icons" id="faces">faces</i>
            <p id="member-name">Howell Manongsong</p>
            <i class="material-icons icon-align-right" id="date_range">date_range</i>
            <p align="right" id="date">Jun 2, 2018</p>
            
          </div>
          
          <div class="row" id="guest">
            <input type="text" class="form-control form-control-sm" id="guest_input">
            <i class="material-icons icon-align-right" id="date_range_2">date_range</i>
            <p id="date_2">Jun 2, 2018</p>
          </div>
          
          <div class="row">
            <table class="table">
              <tbody>
                <tr>
                  <th scope="row"  style="width: 73%" id="total"></th>
                  <td><button type="button" class="btn btn-secondary float-right payment-btn" data-toggle="modal" data-target=".payment">&#8369;</button><td>
                  <button type="button" class="btn btn-secondary float-right lpayment-btn" data-toggle="modal" data-target=".lpayment"><i class="material-icons" id="card">credit_card</i></button></td>
                </td></td>
              </tr>
            </tbody>
          </table>
          
          <!----start of modal for payment---->
          <div class="modal fade payment" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Cash Payment</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                
                <form>
                  <div class="form-group">
                    <div class="containter-fluid">
                      
                      <table class="table" id="table-modal">
                        <tbody>
                          <tr class="table-success">
                            <td>Amount</td>
                            <td>P100</td>
                          </tr>
                          
                          <tr>
                            <td>Payment</td>
                            <td>  <input type="text" class="form-control modal-add" id="address"></td>
                          </tr>
                          <tr class="table-danger">
                            <td>Change</td>
                            <td>P0.00</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  
                </form>
                <div class="modal-footer">
                  <button type="button" class="btn btn-info btn-savemem-modal" data-dismiss="modal">Pay</button>
                  <button type="button" class="btn btn-secondary btn-close-modal" data-dismiss="modal">Cancel</button>
                </div>
              </div>
            </div>
          </div>
          
          <!----end of modal---->
          <!----start of modal for load payment---->
          <div class="modal fade lpayment" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Load Payment</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                
                <form>
                  <div class="form-group">
                    <div class="containter-fluid">
                      
                      <table class="table" id="table-modal">
                        <tbody>
                          <tr class>
                            <td>Current Load</td>
                            <td>P1000.00</td>
                          </tr>
                          <tr class="table-success">
                            <td>Amount</td>
                            <td>P100</td>
                          </tr>
                          
                        </tbody>
                      </table>
                    </div>
                  </div>
                  
                </form>
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger btn-savemem-modal reload-btn" data-toggle="modal" data-target=".reload">Reload</button>
                  <button type="button" class="btn btn-info btn-savemem-modal" data-dismiss="modal">Pay</button>
                  <button type="button" class="btn btn-secondary btn-close-modal" data-dismiss="modal">Cancel</button>
                </div>
              </div>
            </div>
          </div>
          
          <!----end of modal---->
          <!----start of modal for reload---->
          <div class="modal fade reload" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Reload</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                
                <form>
                  <div class="form-group">
                    <div class="containter-fluid">
                      
                      <table class="table" id="table-modal">
                        <tbody>
                          <tr class="table-success">
                            <td>Current Load</td>
                            <td>P100</td>
                          </tr>
                          
                          <tr>
                            <td>Amount</td>
                            <td>  <input type="text" class="form-control modal-add" id="address"></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  
                </form>
                <div class="modal-footer">
                  <button type="button" class="btn btn-info btn-savemem-modal" data-dismiss="modal">Reload</button>
                  <button type="button" class="btn btn-secondary btn-close-modal" data-dismiss="modal">Cancel</button>
                </div>
              </div>
            </div>
          </div>
          
          <!----end of modal---->
        </div>
        
        
        
        
        </div><!---end of center--->
        
        </div> <!---end first div--->
        
        <!---second div start-->
        <div class="col-lg-7 mx-auto right second_div">
            @include('admin.posbuttons')
        </div> <!---end second div--->

        <div id="mirror-pos" hidden="hidden">
          @foreach($allitems as $item)
            <div class="col-lg-12 ">
              <div class="btn btn-sm btn-info full mirror-pos-button" data-id="{{$item->product_id}}" data-description="{{$item->product_name}}" data-price="{{$item->price}}" data-memprice="{{$item->member_price}}">{{str_limit($item->product_name,10)}}</div>
            </div>
          @endforeach
        </div>

          
          
          
     </div>  <!---row-->
  </div> <!--container-->
         
<script>
  $(document).on('click', '.pagination a', function(e){
    e.preventDefault();
    var myurl = $(this).attr('href');

    var page=$(this).attr('href').split('page=')[1];

    getData(page);
  });

  function getData(page)
  {
    $.ajax({
      url:'/sales/buttons?page='+ page

    }).done(function(data){
      $('.second_div').html(data);
      location.hash=page;
      update_paginate();
    })
  }

  function update_total(){
    var sum = 0;
       
    $('.itemsubtotal').each(function() {
      sum += parseFloat($(this).text());
    });
    
    $('.totalprice').text(sum.toFixed(2));
    $('.subtotal').text(sum.toFixed(2));
  }

  $(document).on("click",".pos-button", function() {
      $(this).addClass('active');
      var id =$(this).attr("data-id");
      var price = $(this).attr("data-price");
      var description = $(this).attr("data-description");
      var checkContent =  $('#display_table').find($('.description:contains('+ description + ')')).length;
      var checkMirror =  $('#mirror-pos').find($('[data-id="'+id +'"]')).addClass('active');



      if($("#membercardno").val().length == 0)
      {
        price = $(this).attr("data-price");
      }
      else
      {
        price = $(this).attr("data-memprice");

      }

      if(checkContent == 0)
      {
      var str_item = '<tr class="itemrow" id="'+ id +'"><td class="description"><b>' + description + '</b></td>' +
          '<td><input type="text" class="quantity" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" id="qty_input" value="1" maxlength="6"></td>' +
          '<td class="itemprice">' + price + '</td>' +
          '<td class="itemsubtotal">' + price + '</td>' +
          '<td><button type="submit" class="btn btn-default delete">&times;</button></tr>';

        //$("#display_table").append(str_item).fadeIn(1000);
        $(str_item).hide().appendTo("#display_table tbody").fadeIn(370);
        $(".quantity").focus().select();
        update_total();
      }
      // else
      // {
      //   var existdelete = $('#display_table').find($('.description:contains('+ description + ')'));
      //   $(this).removeClass('active');
      //   DeleteRow(existdelete);
      //   update_total();
      // }
  });

  function DeleteRow(cellButton) {
    var row = $(cellButton).closest('tr')
        .children('td');
    setTimeout(function() {
        $(row)
            .animate({
                paddingTop: 0,
                paddingBottom: 0
            }, 400)
            .wrapInner('<div />')
            .children()
            .slideUp(400, function() {
                $(this).closest('tr').remove();
                update_total();
            });
    }, 150);
  }

  $(document).ready(function() {
      $(document).on('click', '.delete', function() {
        var whichtr = $(this).closest("tr"); 
        var description = whichtr.find($('.description')).text();
        var existdelete = $('.second_div').find($('[data-description="'+description +'"]'));
        var deletemirror =  $('#mirror-pos').find($('[data-description="'+description +'"]'));
        
        DeleteRow(this);
        $(existdelete).removeClass('active');
        $(deletemirror).removeClass('active');
      });
  });

 $(document).on('blur','#qty_input',function(){
    var whichtr = $(this).closest("tr"); 
    var itemprice = whichtr.find($('.itemprice')).text();

    if(whichtr.find($(this)).val().trim().length == 0 || whichtr.find($(this)).val().trim() == 0){
      whichtr.find($(this)).val(1);
      whichtr.find($('.itemsubtotal')).text(itemprice); 
    }
  });

  $(document).on('keydown','#qty_input',function(event){
    if (event.which == 13) {
        $(this).blur();
    }
  });

  $(document).on('input','#qty_input', function() {
    var whichtr = $(this).closest("tr");  
    var zero = 0;
    var subtotal = 0;
    var qty = $(this).val();
    var price = parseFloat(whichtr.find($('.itemprice')).text());
    subtotal = qty * price;

    whichtr.find($('.itemsubtotal')).text(subtotal.toFixed(2));
    update_total();
  });

  $(document).on('change', '.select-box-discount',function() {
    var discount_id = $('.select-box-discount option:selected').attr('data-id');
    var discount_name = $('.select-box-discount option:selected').attr('data-name');
    var discount_type = $('.select-box-discount option:selected').attr('data-type');
    var discount_value = $('.select-box-discount option:selected').attr('data-value');

    $('#discountvalue').attr('data-id', discount_id);
    $('#discountvalue').attr('discount_name', discount_name);
    $('#discountvalue').attr('discount_type', discount_type);
    $('#discountvalue').val(discount_value);
  });

  $(document).ready(function(){
    $("#member").hide();
    $("#guest").show();
  });

  $(document).on('change', '.select-box-role',function() {
    var type = $(".select-box-role option:selected").text();
    
    if (type === "Member") 
    {
      //$("#membercardno").val(1);
      align_price();
      if($("#member").not(':visible')) 
      {
        $("#member").show();
        $("#guest").hide();
      }
    } 
    else 
    {
      //$("#membercardno").val('');
      align_price();
      $("#member").hide();
      $("#guest").show();
    }

  }).trigger("change");

  function align_price()
  {
    $("#mirror-pos .btn.active").each(function(){
    var price = $(this).attr("data-price");

    if($("#membernumber").val().length == 0)
    {
      price = price;
    }
    else
    {
      price = $(this).attr("data-memprice");
    }

    var quantity = $("#display_table tbody tr#"+$(this).attr("data-id")).find("input.quantity").val();
    var subtotal = parseFloat(price) * quantity;

    $("#display_table tbody tr#"+$(this).attr("data-id")).find("td.itemprice").text(price);

    $("#display_table tbody tr#"+$(this).attr("data-id")).find("td.itemsubtotal").text(subtotal.toFixed(2));
    });
    update_total();

  }

  function update_paginate(){
    $("#mirror-pos .btn.active").each(function(){
      var id = $(this).attr("data-id");
      var button = $('.second_div').find($('[data-id="'+ id +'"]'));
      button.addClass("active");
    });
  };
  
</script>
@endsection