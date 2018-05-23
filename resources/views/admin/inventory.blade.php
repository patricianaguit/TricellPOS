@extends('layout')

@section('title')
INVENTORY
@endsection

@section('css')
{{ asset('imports/css/inventory.css') }}
@endsection

@section('content')

</br>
<div class="container">
<!---title inventory-->
<h3 class="title">Inventory</h3>
</br>
<hr>
<!---end of title inventory-->
<!--second row add item button and search bar--->
<div class="row">
    <div class="col-md-8">
    <button type="button" class="btn btn-outline-info add-item-btn" data-toggle="modal" data-target=".add-item">
      Add Item
    </button>
  </div>
   <div class="col-md-4">
    <form class="form ml-auto" action="/inventory/search" method="GET">
			<div class="input-group">
    			<input class="form-control" name="product_search" type="text" placeholder="Search" aria-label="Search" style="padding-left: 20px; border-radius: 40px;" id="product-search">
    			<div class="input-group-addon" style="margin-left: -50px; z-index: 3; border-radius: 40px; background-color: transparent; border:none;">
    				<button class="btn btn-outline-info btn-sm" type="submit" style="border-radius: 100px;" id="search-btn"><i class="material-icons">search</i></button>
    			</div>
			</div>
		</form>
  </div>
 </div> 

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
		  <th scope="col">Item Name</th>
          <th scope="col">Type</th>	
		  <th scope="col">Price</th>
          <th scope="col">Stock on Hand</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody class="td_class">

      	@foreach($products as $product)
        <tr>
          <th scope="row">{{str_limit($product->product_name,40)}}</th>
          <td>{{str_limit($product->product_desc,30)}}</td>
          <td>₱ {{$product->price}}</td>
          <td>{{$product->product_qty}}</td>
          <td>
            <button type="button" class="btn btn-primary edit-btn" data-toggle="modal" data-target=".edit"><i class="material-icons md-18">mode_edit</i></button>
            <button type="button" class="btn btn-danger del-btn" data-toggle="modal" data-target=".delete"><i class="material-icons md-18">delete</i></button>
          </td>
        </tr>
        @endforeach

      </tbody>
    </table>

    {{$products->links()}}

 <!----start of modal for add item---->
    <div class="modal fade add-item" tabindex="-1" role="dialog">
     <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add New Item</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <form>
        <div class="form-group">
        <div class="containter-fluid">
		  <div class="col-md-11 mx-auto">
          <label for="address" class="col-form-label modal-address">Item Name:</label>
          <input type="text" class="form-control modal-add" id="address">
		  </div>
  		  <div class="col-md-11 mx-auto">
          <label for="address" class="col-form-label modal-address">Type:</label>
          <input type="text" class="form-control modal-add" id="address">
		  </div>
		  <div class="col-md-11 mx-auto">
          <label for="address" class="col-form-label modal-address">Price:</label>
          <input type="text" class="form-control modal-add" id="address">
		  </div>
		  <div class="col-md-11 mx-auto">
          <label for="address" class="col-form-label modal-address">Stock:</label>
          <input type="text" class="form-control modal-add" id="address">
		  </div>



        </div>
        </div>

      </form>
        <div class="modal-footer">
          <button type="button" class="btn btn-info btn-save-modal" data-dismiss="modal">Save New Member</button>
          <button type="button" class="btn btn-secondary btn-close-modal" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
    </div>

    <!----end of modal---->
   <!----start of modal for EDIT---->
    <div class="modal fade edit" tabindex="-1" role="dialog">
   <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Item</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <form>
        <div class="form-group">
        <div class="containter-fluid">
		  <div class="col-md-11 mx-auto">
          <label for="address" class="col-form-label modal-address">Item Name:</label>
          <input type="text" class="form-control modal-add" id="address">
		  </div>
  		  <div class="col-md-11 mx-auto">
          <label for="address" class="col-form-label modal-address">Type:</label>
          <input type="text" class="form-control modal-add" id="address">
		  </div>
		  <div class="col-md-11 mx-auto">
          <label for="address" class="col-form-label modal-address">Price:</label>
          <input type="text" class="form-control modal-add" id="address">
		  </div>
		  <div class="col-md-11 mx-auto">
          <label for="address" class="col-form-label modal-address">Stock:</label>
          <input type="text" class="form-control modal-add" id="address">
		  </div>



        </div>
        </div>

      </form>
        <div class="modal-footer">
          <button type="button" class="btn btn-info btn-save-modal" data-dismiss="modal">Save Changes</button>
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
        <center>  <p> Are you sure you want to delete this <b>item</b>?</p> </center>
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

@endsection