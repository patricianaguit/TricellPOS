</br>

@foreach($items->chunk(4) as $chunk)

  @if($chunk->count() == 4) 
    <div class="row pad">
      @foreach($chunk as $item)
      <div class="col-lg-3 ">
        <div class="btn btn-sm btn-info full pos-button" data-description="{{$item->product_name}}" data-price="{{$item->price}}">{{str_limit($item->product_name,10)}}</div>
      </div>
      @endforeach
    </div>
  @elseif($chunk->count() == 3) 
    <div class="row pad">
      @foreach($chunk as $item)
      <div class="col-lg-4 ">
        <div class="btn btn-sm btn-info full pos-button" data-description="{{$item->product_name}}" data-price="{{$item->price}}">{{str_limit($item->product_name,10)}}</div>
      </div>
      @endforeach
    </div>
  @elseif($chunk->count() == 2) 
    <div class="row pad">
      @foreach($chunk as $item)
      <div class="col-lg-6">
        <div class="btn btn-sm btn-info full pos-button" data-description="{{$item->product_name}}" data-price="{{$item->price}}">{{str_limit($item->product_name,10)}}</div>
      </div>
      @endforeach
    </div>
  @else
    <div class="row pad">
      @foreach($chunk as $item)
      <div class="col-lg-12">
        <div class="btn btn-sm btn-info full pos-button" data-description="{{$item->product_name}}" data-price="{{$item->price}}">{{str_limit($item->product_name,10)}}</div>
      </div>
      @endforeach
    </div>
  @endif
@endforeach 

{{$items->links()}}