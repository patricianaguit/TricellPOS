<input type="text" id="reload_id" value="{{$reloads->id}}" hidden="hidden">
<table class="table date-header">
  <thead>
    <th>Receipt #00000001</td>
    <th></td>
    <th> May 30, 2018</td>
    <th>11:18:50 PM</td>
  </thead>
</table>
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
      <td>₱ {{number_format($reloads->amount_due,2, '.', '')}}</td>
      <td>₱ {{number_format($reloads->amount_due,2, '.', '')}}</td>
    </tr>

  <tr class="table-light">
      <td colspan="3"><b>Subtotal</b></td>
      <td colspan="2"> ₱ {{number_format($reloads->amount_due,2, '.', '')}}</td>
  </tr>
  <tr class="table-light">
      <td colspan="3"><b>Total</b></td>
      <td colspan="2">₱ {{number_format($reloads->amount_due,2, '.', '')}}</td>
  </tr>
  <tr class="table-light">
      <td colspan="3"><b>Amount Paid</b></td>
      <td colspan="2">₱ {{number_format($reloads->amount_paid,2, '.', '')}}</span></td>
  </tr>
  <tr class="table-light">
      <td colspan="3"><b>Change</b></td>
      <td colspan="2">₱ {{number_format($reloads->change_amount,2, '.', '')}}</span></td>
  </tr>
  </tbody>

</table>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-info btn-save-modal" data-dismiss="modal">Print</button>
          <button type="button" class="btn btn-secondary btn-close-modal" data-dismiss="modal">Cancel</button>
        </div>
