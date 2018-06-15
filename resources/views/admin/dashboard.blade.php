@extends('layout')

@section('title')
DASHBOARD
@endsection

@section('css')
{{ asset('imports/css/dashboard.css') }}
@endsection

@section('content')
<div class="container-fluid">
   <br>
   <div class="row">
      <div class="col m-1" id="new-customers" onclick="window.location='{{ url("accounts/members") }}'">
         New Customers
         <center>
            <h1>{{$newmembers}}</h1>
         </center>
      </div>
      <div class="col m-1" id="new-reload" onclick="window.location='{{ url("logs/reload") }}'">
         Reload Sales
         <center>
            <h1>{{$reloadsales}}</h1>
         </center>
      </div>
      <div class="col m-1" id="new-sales" onclick="window.location='{{ url("logs/sales") }}'">
         Product Sales
         <center>
            <h1>{{$sales}}</h1>
         </center>
      </div>
      <div class="col m-1" id="new-low" onclick="window.location='{{ url("inventory/low_stocks") }}'">
         Low Stock Items
         <center>
            <h1>{{$lowstock}} </h1>
         </center>
      </div>
   </div>

   <div class="row">
      <div class="col m-1 border" id="sales-day">
         <!-- <h6>Sales for {{ \Carbon\Carbon::now()->format('Y')}}</h6> -->
         <canvas id="sales-for-year">
         </canvas>
      </div>
      <div class="col m-1 border" id="member-walkin">
        <!--  <h6>Member vs Walk-in</h6> -->
         <canvas id="member-vs-walkin">
         </canvas>  
      </div>
   </div>

   <div class="row">
      <div class="col m-1 border" id="top-products">
         <h6>Top Selling Products</h6>
         <!-- <canvas id="sales-for-year" width="350" height="350">
         </canvas> -->
      </div>
      <div class="col m-1 border" id="sales-payment">
      <!--    <h6>Sales by Payment Mode</h6> -->
         <canvas id="payment-mode">
         </canvas>
      </div>
      <div class="col m-1 border" id="active-members">
         <h6>Most Active Members</h6>
          
      </div>
   </div>

</div>

<script type="text/javascript">
   var bar_ctx = document.getElementById('payment-mode').getContext('2d');
   var cashgradient = bar_ctx.createLinearGradient(0, 0, 0, 600);
   cashgradient.addColorStop(0, '#42D4C4');
   cashgradient.addColorStop(1, '#8AF5E9');

   var cardgradient = bar_ctx.createLinearGradient(0, 0, 0, 600);
   cardgradient.addColorStop(0, '#81FBB8');
   cardgradient.addColorStop(1, '#2DCA73');

   var cash = <?php echo $cashpay; ?>;
   var load = <?php echo $loadpay; ?>;
   new Chart(document.getElementById("payment-mode"), {
    type: 'doughnut',
    data: {
      labels: ["Cash", "Card Load"],
      datasets: [
        {
          backgroundColor: [cashgradient, cardgradient],
          hoverBackgroundColor: [cashgradient, cardgradient],
          hoverBorderWidth: 2,
          hoverBorderColor: [cashgradient, cardgradient],
          data: [cash,load]
        }
      ]
    },
    options: {
      title: {
         display: true,
         text: 'Sales by Payment Mode',
         fontSize: '17',
         fontColor: 'black',
         fontStyle: 'normal',
      },
      cutoutPercentage: 70,
      responsive:true,
      maintainAspectRatio: false,
    }
   });

   var bar_ctx = document.getElementById('member-vs-walkin').getContext('2d');
   var bargradient = bar_ctx.createLinearGradient(0, 0, 0, 600);
   bargradient.addColorStop(0, '#2dedc3');
   bargradient.addColorStop(1, '#960de0');

   var membersales = <?php echo $membersales ?>;
   var guestsales = <?php echo $guestsales ?>;
 
   new Chart(document.getElementById("member-vs-walkin"), {
    type: 'horizontalBar',
    data: {
      labels: ["Member", "Walk-in"],
      datasets: [
        {
          backgroundColor:  bargradient,
          hoverBackgroundColor: bargradient,
          hoverBorderWidth: 2,
          hoverBorderColor: 'purple',
          data: [membersales, guestsales]
        }
      ]
    },
    options: {
      title: {
         display: true,
         text: 'Sales by Customer Type',
         fontSize: '17',
         fontColor: 'black',
         fontStyle: 'normal',
      },
      legend: {
         display: false
      },
      scales: {
         xAxes: [{
            ticks: {
               beginAtZero: true,
            } 
         }]
      },
      responsive:true,
      maintainAspectRatio: false,
    }
   });


   var year = <?php echo \Carbon\Carbon::now()->format('Y') ?>;
    new Chart(document.getElementById("sales-for-year"), {
    type: 'line',
    data: {
         labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
         datasets: [{
            data: <?php echo json_encode($yearsales)?>,
            label: "",
            borderWidth: 2,
            borderColor: "#3e95cd",
            fill: 'origin',
         }]
      },
      options: {
         title: {
            display: true,
            text: 'Sales for ' + year,
            fontSize: '17',
            fontColor: 'black',
            fontStyle: 'normal',
         },
         plugins: {
            filler: {
                propagate: true
            }
         },
         elements: {
           line: {
               tension: 0
           }
         },
         scales: {
            yAxes: [{
                  display: true,
                  ticks: {
                      beginAtZero: true,
                      steps: 1000,
                      stepValue: 5,
                  }
              }],
            xAxes: [{
               ticks: {
                  autoSkip: false
               }
            }]
         },
         responsive:true,
         maintainAspectRatio: false,
         legend: {
            display: false
         },
      },

   });

   
</script>
@endsection