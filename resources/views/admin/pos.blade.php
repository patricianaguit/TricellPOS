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
                <td class="table-dark" id="total">P 3.00</td>
              </tr>
              
            </tbody>
          </table>
          
        </div>
        
        
        <div class="row items-table">
          <table class="table pos-table">
            <thead class="table-light">
              <tr>
                <th scope="col">Description</th>
                <th scope="col">Quantity</th>
                <th scope="col">Price</th>
                <th scope="col">Subtotal</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            
            <tbody id="display_table">
            </tbody>
          </table>
          
          
          </div><!---end of row-->
          
          <div class="row">
            
            <table class="table table-total">
              <tbody>
                
                <tr>
                  <th scope="row" class="table-light" style="width: 73%">Subtotal</th>
                  <td class="table-light">P 3.00</td>
                </tr>
                <tr>
                  <th scope="row" class="table-light" style="width: 73%">Discount</th>
                  <td class="table-light"> <input type="text" id="tax_input"></td>
                </tr>
                <tr>
                  <th scope="row" class="table-light" style="width: 73%">Tax</th>
                  <td class="table-light">12%</td>
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
        <div class="col-lg-7 mx-auto right second_div">
          @include('admin.posbuttons')
        </div> <!---end second div--->

          
          
          
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
    console.log(page);
    $.ajax({
      url:'/sales/buttons?page='+ page

    }).done(function(data){

      console.log(data);
      $('.second_div').html(data);
      location.hash=page;
    })
  }

$(document).ready(function() {
    $('table').on('click', '.delete', function() {
        DeleteRow(this);
    });
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
            });
    }, 250);
};


$('body').on('mouseenter mouseleave', '.dropdown', function(e) {
    var _d = $(e.target).closest('.dropdown');
    _d.addClass('show');
    setTimeout(function() {
        _d[_d.is(':hover') ? 'addClass' : 'removeClass']('show');
        $('[data-toggle="dropdown"]', _d).attr('aria-expanded', _d.is(':hover'));
    }, 300);
});

$(document).on("click",".pos-button", function() {

    var price = $(this).attr("data-price");
    var description = $(this).attr("data-description");

    var str_item = '<tr><td><b>' + description + '</b></td>' +
        '<td><input type="text" id="qty_input" value="1"></td>' +
        '<td>P ' + price + '</td>' +
        '<td>P ' + price + '</td>' +
        '<td><button type="submit" class="btn btn-default delete">x</button></tr>';

    //$("#display_table").append(str_item).fadeIn(1000);
    $(str_item).hide().appendTo("#display_table").fadeIn(400);
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