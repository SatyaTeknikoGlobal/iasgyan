@extends('admin/layout')


@section('dashboard')

active

@endsection

@section('content')

<?php 
$colourArr = config('custom.course_color');

$today = date('Y-m-d');
$todayname = date('l');

$january = 0;
$february = 0;
$march = 0;
$march = 0;
$april = 0;
$may = 0;
$june = 0;
$july = 0;
$august = 0;
$september = 0;
$october = 0;
$november = 0;
$december = 0;

$users = \App\AppUser::whereYear('created_at',date('Y'))->get();
if(!empty($users)){
  foreach($users as $user){




    $day  = date('F', strtotime($user->created_at));


    if($day == 'January'){
      $january += 1;
    }
    if($day == 'February'){
      $february += 1;
    }

    if($day == 'March'){
      $march += 1;
    }

    if($day == 'April'){
      $april += 1;
    }

     if($day == 'May'){
      $may += 1;
    }

 if($day == 'June'){
      $june += 1;
    }

 if($day == 'July'){
      $july += 1;
    }

 if($day == 'August'){
      $august += 1;
    }

 if($day == 'September'){
      $september += 1;
    }

 if($day == 'October'){
      $october += 1;
    }

 if($day == 'November'){
      $november += 1;
    }

 if($day == 'December'){
      $december += 1;
    }

    
  }
}









?>


<!--Start Dashboard Content-->


<h2 style="text-transform: capitalize;">Dashboard</h2>
<div class="container">
  <div class="row">

   <div class="col-12 col-lg-6 col-xl-3">

     <div class="card gradient-deepblue">

       <div class="card-body">

        <h5 class="text-white mb-0">{{count($total_user ?? '')}} <span class="float-right"><i class="fa fa-users"></i></span></h5>

        <div class="progress my-3" style="height:3px;">

         <div class="progress-bar" style="width:55%"></div>

       </div>

       <a href="{{url('/app_users')}}"> <p class="mb-0 text-white small-font">Total Users <span class="float-right"></span></p></a>

     </div>

   </div> 

 </div>



 <div class="col-12 col-lg-6 col-xl-3">

   <div class="card gradient-ohhappiness">

    <div class="card-body">

      <h5 class="text-white mb-0">{{$faculties ?? ''}} <span class="float-right"><i class="fa fa-eye"></i></span></h5>

      <div class="progress my-3" style="height:3px;">

       <div class="progress-bar" style="width:55%"></div>

     </div>

     <a href="{{url('/faculties')}}"><p class="mb-0 text-white small-font">Faculties <span class="float-right"></span></p></a>

   </div>

 </div>

</div>

<div class="col-12 col-lg-6 col-xl-3">

 <div class="card gradient-ibiza">

  <div class="card-body">

    <h5 class="text-white mb-0">{{count($boards)}} <span class="float-right"><i class="fa fa-envira"></i></span></h5>

    <div class="progress my-3" style="height:3px;">

     <div class="progress-bar" style="width:55%"></div>

   </div>

   <a href="{{url('/course')}}"><p class="mb-0 text-white small-font">Courses <span class="float-right"></span></p> </a>

 </div>


</div>

</div>


<div class="col-12 col-lg-6 col-xl-3">

 <div class="card gradient-orange">

   <div class="card-body">
    <h5 class="text-white mb-0"><?=$free_user?> <span class="float-right"><i class="fa fa-usd"></i></span></h5>

    <div class="progress my-3" style="height:3px;">

     <div class="progress-bar" style="width:55%"></div>

   </div>

   <p class="mb-0 text-white small-font">Free Users<span class="float-right"></span></p>

 </div>

</div>

</div>



<div class="col-12 col-lg-6 col-xl-3">

 <div class="card gradient-deepblue">

   <div class="card-body">

    <h5 class="text-white mb-0">{{count($news ?? '')}} <span class="float-right"><i class="fa fa-users"></i></span></h5>

    <div class="progress my-3" style="height:3px;">

     <div class="progress-bar" style="width:55%"></div>

   </div>

   <a href="{{url('/app_users')}}"> <p class="mb-0 text-white small-font">Total News <span class="float-right"></span></p></a>

 </div>

</div> 

</div>




</div>
</div>


<!-- <link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/cdbootstrap@1.0.0/css/bootstrap.min.css"/>
<link
rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/cdbootstrap@1.0.0/css/cdb.min.css" />
<script
src="https://cdn.jsdelivr.net/npm/cdbootstrap@1.0.0/js/cdb.min.js"></script>
<script
src="https://cdn.jsdelivr.net/npm/cdbootstrap@1.0.0/js/bootstrap.min.js">
</script>
<script src="https://kit.fontawesome.com/9d1d9a82d2.js"
crossorigin="anonymous"></script>

 -->

<h2 style="text-transform: capitalize;">Users</h2>

<div class="container">
  <div class="row" style="background:white;">
    <div class="col-md-8">
     <canvas id="chart"></canvas>
   </div>



   <div class="col-md-4">
    <canvas id="pieChart" style="max-width: 500px;"></canvas>
   </div>



 </div>

</div>






<script>
  var toggler = document.getElementsByClassName("caret");
  var i;

  for (i = 0; i < toggler.length; i++) {
    toggler[i].addEventListener("click", function() {
      this.parentElement.querySelector(".nested").classList.toggle("active");
      this.classList.toggle("caret-down");
    });
  }
</script>


<script type="text/javascript">
  $("#status").change(function(){
    // $('#status_update').submit();
    var _token = '{{ csrf_token() }}';
    var data = $('#status_update').serialize();
    alert(data);
    $.ajax({
      url: "{{ route('board.update_status') }}",
      type: "POST",
      data: {data:data},
      dataType:"JSON",
      headers:{'X-CSRF-TOKEN': _token},
      cache: false,
      success: function(resp){

      }
    });
  });
</script>







<!-- End New Section  -->


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script
src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js">
</script>



<script type="text/javascript">

  const ctx = document.getElementById("chart").getContext('2d');
  const myChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: ["January", "February", "March",
      "April", "May", "June", "July",'August','September','October','November','December'],
      datasets: [{
        label: 'Last Month',
        backgroundColor: 'rgba(65,105,225)',
        borderColor: 'rgb(47, 128, 237)',
        data: [{{$january}}, {{$february}}, {{$march}}, {{$april}}, {{$may}}, {{$june}}, {{$july}} ,{{$august}},{{$september}},{{$october}},{{$november}},{{$december}}],
      },


        <?php 
        // $board = \App\Board::get();
        // $i=0;
        // foreach($board as $b){

        //   $count_user

      ?>

      // {
      //   label: '{{$b->board_name ?? ''}}',
      //   backgroundColor: 'rgba(161, 198, 247, 1)',
      //   borderColor: 'rgb(47, 128, 237)',
      //   data: [{{$january}}, {{$february}}, {{$march}}, {{$april}}, {{$may}}, {{$june}}, {{$july}} ,{{$august}},{{$september}},{{$october}},{{$november}},{{$december}}],
      // },


    <?php //}?>


      ],
    },
    options: {
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true,
          }
        }]
      }
    },
  });
</script>
<script type="text/javascript">
  //pie
    var ctxP = document.getElementById("pieChart").getContext('2d');
    var myPieChart = new Chart(ctxP, {
      type: 'pie',
      data: {
        labels: ["Red", "Green", "Yellow", "Grey", "Dark Grey"],
        datasets: [{
          data: [300, 50, 100, 40, 120],
          backgroundColor: ["#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360"],
          hoverBackgroundColor: ["#FF5A5E", "#5AD3D1", "#FFC870", "#A8B3C5", "#616774"]
        }]
      },
      options: {
        responsive: true
      }
    });
</script>


@endsection