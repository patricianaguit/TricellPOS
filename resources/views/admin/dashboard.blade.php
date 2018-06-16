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
      <div class="row">
        <div class ="col-xs-1">         
           <i class="material-icons group">group</i>
        </div>
        <div class ="col-xs-2">
           <p class="title">New Customers <span class="last-time"></br>Last 7 days</span></p>
        </div>
        <div class ="col-xs-9 mx-auto">
           <h1 class="newmember-count">{{$newmembers}}</h1>
        </div>
       </div>
    </div>
      <div class="col m-1" id="new-reload" onclick="window.location='{{ url("logs/reload") }}'">
        <div class="row">
          <div class ="col-xs-1"> 
            <i class="material-icons reload">credit_card</i>
          </div>
         <div class ="col-xs-2">
            <p class="title">Reload Sales <span class="last-time"></br>Last 30 days</span></p>
         </div>
         <div class ="col-xs-9 mx-auto">
            <h1 class="reload-sales">{{$reloadsales}}</h1>
         </div>
        </div>
      </div>
      <div class="col m-1" id="new-sales" onclick="window.location='{{ url("logs/sales") }}'">
        <div class="row">
          <div class ="col-xs-1"> 
            <i class="material-icons add_shopping_cart">add_shopping_cart</i>
          </div>
         <div class ="col-xs-2">
            <p class="title">Product Sales <span class="last-time"></br>Last 30 days</span></p>
         </div>
         <div class ="col-xs-9 mx-auto">
            <h1 class="product-sales">{{$sales}}</h1>
         </div>
       </div> 
      </div>
      <div class="col m-1" id="new-low" onclick="window.location='{{ url("inventory/low_stocks") }}'">
        <div class="row">
          <div class ="col-xs-1"> 
            <i class="material-icons trending_down">trending_down</i>
          </div>
         <div class ="col-xs-2">
            <p class="title">Low Stock Products <span class="last-time"></br>As of {{\Carbon\Carbon::now()->format('F d')}}</span></p>
         </div>
         <div class ="col-xs-9 mx-auto">
            <h1 class="low-stock">{{$lowstock}} </h1>
          </div>
        </div>
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
         <div class="row">
            <div class="col">
              <h3>1. Chocolates</h3>
            </div>
            <div class="col">
              <h2 class="top-product-price">P 10,000</h2>
            </div>
         <!-- <canvas id="sales-for-year" width="350" height="350">
         </canvas> -->
       </div>
       <div class="row">
            <div class="col">
              <h6>2. Candy</h6>
            </div>
            <div class="col">
              <h6 class="top-product-price">P 5,000</h6>
            </div>
         <!-- <canvas id="sales-for-year" width="350" height="350">
         </canvas> -->
       </div>
       <div class="row">
            <div class="col">
              <h6>3. Pen</h6>
            </div>
            <div class="col">
              <h6 class="top-product-price">P 2,500</h6>
            </div>
         <!-- <canvas id="sales-for-year" width="350" height="350">
         </canvas> -->
       </div>
       <div class="row">
            <div class="col">
              <h6>4. Paper</h6>
            </div>
            <div class="col">
              <h6 class="top-product-price">P 2,000</h6>
            </div>
         <!-- <canvas id="sales-for-year" width="350" height="350">
         </canvas> -->
       </div>
       <div class="row">
            <div class="col">
              <h6>5. Pencil</h6>
            </div>
            <div class="col">
              <h6 class="top-product-price">P 1,000</h6>
            </div>
         <!-- <canvas id="sales-for-year" width="350" height="350">
         </canvas> -->
       </div>
       <div class="row">
            <div class="col">
              <h6>6. Item 6</h6>
            </div>
            <div class="col">
              <h6 class="top-product-price">P 1,000</h6>
            </div>
         <!-- <canvas id="sales-for-year" width="350" height="350">
         </canvas> -->
       </div>
       <div class="row">
            <div class="col">
              <h6>7. Item 7</h6>
            </div>
            <div class="col">
              <h6 class="top-product-price">P 1,000</h6>
            </div>
         <!-- <canvas id="sales-for-year" width="350" height="350">
         </canvas> -->
       </div>
       <div class="row">
            <div class="col">
              <h6>8. Item 8</h6>
            </div>
            <div class="col">
              <h6 class="top-product-price">P 1,000</h6>
            </div>
         <!-- <canvas id="sales-for-year" width="350" height="350">
         </canvas> -->
       </div>
       <div class="row">
            <div class="col">
              <h6>9. Item 9</h6>
            </div>
            <div class="col">
              <h6 class="top-product-price">P 1,000</h6>
            </div>
         <!-- <canvas id="sales-for-year" width="350" height="350">
         </canvas> -->
       </div>
       <div class="row">
            <div class="col">
              <h6>10. Item 10</h6>
            </div>
            <div class="col">
              <h6 class="top-product-price">P 1,000</h6>
            </div>
         <!-- <canvas id="sales-for-year" width="350" height="350">
         </canvas> -->
       </div>
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
   cashgradient.addColorStop(0, '#7ef6b8');
   cashgradient.addColorStop(1, '#66ca72');

   var cardgradient = bar_ctx.createLinearGradient(0, 0, 0, 600);
   cardgradient.addColorStop(0, '#f4b591');
   cardgradient.addColorStop(1, '#eb5757');

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