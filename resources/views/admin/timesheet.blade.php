@extends('layout')

@section('title')
TIMESHEET
@endsection

@section('css')
{{ asset('imports/css/members.css') }}
@endsection

@section('content')

</br>
<div class="container">
<!---title inventory-->
<h3 class="title">Timesheet</h3>
</br>
<hr>
  <!--end of members nav---->
<!---content of tabs start-->
  <div class="row">
    <div class="col-md-8">
        <button type="button" class="btn btn-outline-info add-staff-btn">Export to CSV</button>
    </div>
    <div class="col-md-4">
      <form class="form ml-auto" action="/accounts/search_staff" method="GET">
      <div class="input-group">
          <input class="form-control" type="text" name ="search" placeholder="Search" aria-label="Search" style="padding-left: 20px; border-radius: 40px;" id="staff-search">
          <div class="input-group-addon" style="margin-left: -50px; z-index: 3; border-radius: 40px; background-color: transparent; border:none;">
            <button class="btn btn-outline-info btn-sm" type="submit" style="border-radius: 100px;" id="staff-search-submit"><i class="material-icons">search</i></button>
          </div>
      </div>
      </form>
    </div>
  </div>

  @if(!empty($search))
      @if($totalcount > 7)
        <center><p> Showing {{$count}} out of {{$totalcount}} results
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
          <th scope="col">ID Number</th>
          <th scope="col">Username</th>
          <th scope="col">Name</th>
          <th scope="col">Time In</th>
          <th scope="col">Time Out</th>
        </tr>
      </thead>
      <tbody class="td_class">
        @foreach($employees as $employee)
        <tr>
          <td class="td-center"><b>{{ date('F d, Y', strtotime($employee->time_in)) }}</b></td>
          <td class="td-center">{{ $employee->user->card_number }}</td>
          <td class="td-center">{{ $employee->user->username }}</td>
          <td class="td-center">{{ $employee->user->firstname . " " . $employee->user->lastname }}</td>
          <td class="td-center">{{ date('h:i:s A', strtotime($employee->time_in)) }}</td>
          <td class="td-center">
            @if(empty($employee->time_out))
              {{ 'Currently in'}}
            @else
              {{ date('h:i:s A', strtotime($employee->time_out)) }}
            @endif
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>

    {{$employees->links()}}
  </div>
@endsection
