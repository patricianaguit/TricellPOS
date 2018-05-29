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
<h3 class="title">Backup</h3>
</br>
<hr>
<!---end of title inventory-->
<!--second row add item button and search bar--->
<div class="row">
    <div class="col-md-8">
       <a id="create-new-backup-button" href="{{ url('backup/create') }}" class="btn btn-outline-info add-item-btn"> Create New Backup</a>
    </div>

    <div class="col-md-4">
      <form class="form ml-auto" action="/inventory/search" method="GET">
            <div class="input-group">
                <input class="form-control" name="search" type="text" placeholder="Search" aria-label="Search" style="padding-left: 20px; border-radius: 40px;" id="product-search">
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
        <th>File Name</th>
        <th>Size</th>
        <th>Date</th>
        <th>Age</th>
        <th>Actions</th>
    </tr>
    </thead>
        <tbody>
        @foreach($backups as $backup)
            <tr>
                <td>{{ $backup['file_name'] }}</td>
                <td>{{ $backup['file_size'] }}</td>
                <td>{{ $backup['last_modified'] }}</td>
                <td>{{ $backup['age'] }}</td>
                <td>
                    <a class="btn btn-primary edit-btn"
                       href="{{ url('backup/download/'.$backup['file_name']) }}"><i class="material-icons md-18">cloud_download</i>
                    </a>
                    <a class="btn btn-xs btn-danger del-btn" data-button-type="delete"
                       href="{{ url('backup/delete/'.$backup['file_name']) }}"><i class="material-icons md-18">delete</i>
                   </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$backups->links()}}


</div>


@endsection
