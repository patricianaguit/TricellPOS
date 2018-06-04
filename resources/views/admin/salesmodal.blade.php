  <input type="text" id="sales_id" value="{{sprintf('%08d',$sales->id)}}" hidden="hidden">
  <input type="text" id="sales_date" value="{{date('F d, Y h:i:s A', strtotime($sales->transaction_date))}}" hidden="hidden">
	<table class="table table_modal">
  <thead>
    <tr>
      <th scope="col">Description</th>
      <th scope="col">Qty</th>
      <th scope="col">Price</th>
      <th scope="col">Subtotal</th>
    </tr>
  </thead>
  <tbody>
    @foreach($salesdetails as $details)
    <tr class="productdetails">
      <td>{{$details->product->product_name}}</td>
      <td>{{$details->quantity}}</td>
      <td>₱ {{$details->product->price}}</td>
      <td class="totalprice">₱ {{number_format($details->subtotal,2, '.', '')}}</td>
    </tr>
    @endforeach
    
  <tr class="table-light">
      <td colspan="3"></td>
      <td colspan="2"></td>
  </tr>
	<tr class="table-light">
      <td colspan="3"><b>Subtotal</b></td>
      <td colspan="2">₱ <span class="subtotal"></span></td>
  </tr>
	<tr class="table-light">
      <td colspan="3"><b>12% VAT</b></td>
      <td colspan="2">₱ <span class="vat"></span></td>
  </tr>
  <tr class="table-light">
      <td colspan="3"><b>VAT Sale</b></td>
      <td colspan="2">₱ <span class="vatsale"></span></td>
  </tr>
  <tr class="table-light">
      <td colspan="3"><b>VAT Exempt Sales</b></td>
      <td colspan="2">₱ <span class="vatexempt"></span></td>
  </tr>
  <tr class="table-light">
      <td colspan="3"><b>Zero-Rated</b></td>
      <td colspan="2">₱ <span class="zerorated"></span></td>
  </tr>
  @foreach($discounts as $discount)
  <input type="text" id="discount_id" value="{{$discount->id}}" hidden="hidden">
  <input type="text" id="discount_name" value="{{$discount->discount_name}}" hidden="hidden">
  <input type="text" id="discount_amount" value="{{number_format($discount->amount,2, '.', '')}}" hidden="hidden">
  <input type="text" id="discount_percent" value="{{$discount->percent}}" hidden="hidden">
	<tr class="table-light">
      <td colspan="3"><b>Discount <span class="discount_name"></span></b></td>
      <td colspan="2">₱ <span class="discount"></span></td>
  </tr>
  @endforeach
	<tr class="table-light">
      <td colspan="3"><b>Total</b></td>
      <td colspan="2">₱ <span class="total"></span></td>
  </tr>
  <tr class="table-light">
      <td colspan="3"><b>Amount Paid</b></td>
      <td colspan="2">₱ {{number_format($sales->amount_paid,2, '.', '')}}<span class="payment"></span></td>
  </tr>
  <tr class="table-light">
      <td colspan="3"><b>Change</b></td>
      <td colspan="2">₱ {{number_format($sales->change_amount,2, '.', '')}} <span class="change"></span></td>
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
<script type="text/javascript">
  
 
</script>