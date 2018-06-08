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
                    <input type="text" id="tax_input"></td>
                </tr>
                <tr>
                  <th scope="row" class="table-light" style="width: 73%">VAT</th>
                  <td class="table-light">{{floatval($vat->vat)}}%</td>
                </tr>
                
              </tbody>
            </table>
          </div>
          
          <div class="row" id="onchange">
            <select class="form-control form-control-sm select-box">
              <option value="guest">Guest</option>
              <option value="member">Member</option>
            </select>
          </div>
          
          <div class="row" id="member">
            
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
        <div class="col-lg-7 mx-auto right ">
          <div class="second_div">
            @include('admin.posbuttons')
          </div>
        </div> <!---end second div--->

          
          
          
     </div>  <!---row-->
  </div> <!--container-->
         
<script>
var checkScrollBars = function(){
    var b = $('body');
    var normalw = 0;
    var scrollw = 0;
    if(b.prop('scrollHeight')>b.height()){
        normalw = window.innerWidth;
        scrollw = normalw - b.width();
        $('#container').css({marginRight:'-'+scrollw+'px'});
    }
}
  $(document).on('click', '.pagination a', function(e){
    e.preventDefault();
    var myurl = $(this).attr('href');

    var page=$(this).attr('href').split('page=')[1];

    getData(page);
  });

  function getData(page)
  {
    console.log(page);
    $.ajax({
      url:'/sales/buttons?page='+ page

    }).done(function(data){

      console.log(data);
      $('.second_div').html(data);
      location.hash=page;
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
      var price = $(this).attr("data-price");
      var description = $(this).attr("data-description");
      var checkContent =  $('#display_table').find($('.description:contains('+ description + ')')).length;

      if(checkContent == 0)
      {
      var str_item = '<tr class="itemrow"><td class="description"><b>' + description + '</b></td>' +
          '<td><input type="text" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" id="qty_input" value="1" maxlength="6"></td>' +
          '<td class="itemprice">' + price + '</td>' +
          '<td class="itemsubtotal">' + price + '</td>' +
          '<td><button type="submit" class="btn btn-default delete">&times;</button></tr>';

        //$("#display_table").append(str_item).fadeIn(1000);
        $(str_item).hide().appendTo("#display_table").fadeIn(370);
        update_total();
      }
      else
      {
        var existdelete = $('#display_table').find($('.description:contains('+ description + ')'));
        $(this).removeClass('active');
        DeleteRow(existdelete);
        update_total();
      }
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
          DeleteRow(this);
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
        // update_total();
    }
  });

  $(document).on('input','#qty_input', function() {
    var whichtr = $(this).closest("tr");  
    var zero = 0;
    var product = 0;
    var qty = $(this).val();
    var price = parseFloat(whichtr.find($('.itemprice')).text());
    product = qty * price;

    whichtr.find($('.itemsubtotal')).text(product.toFixed(2));
    update_total();
  });

  $("select").change(function() {
    var str = $("select option:selected").text();
    if (str === "Member") {
        if ($("#member").not(':visible')) {

            $("#member").show();
            $("#guest").hide();
        }
    } else {
        $("#member").hide();
        $("#guest").show();
    }

})
.trigger("change");
        
        
</script>
@endsection