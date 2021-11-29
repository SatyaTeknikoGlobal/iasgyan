<!DOCTYPE html>

<html lang="en">

<head>

  <meta charset="utf-8"/>

  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>

  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>

  <meta name="description" content=""/>

  <meta name="author" content=""/>

  <title>IAS GYAN- Admin</title>

  <!-- loader-->

  <link href="{{URL::asset('assets/css/pace.min.css')}}" rel="stylesheet"/>

  <script src="{{URL::asset('assets/js/pace.min.js')}}"></script>
  <script src="{{URL::asset('assets/js/jquery.min.js')}}"></script>

  <!--favicon-->

   <!--Select Plugins-->
  <link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet"/>


  <link rel="icon" href="{{URL::asset('assets/images/logo.png')}}" type="image/x-icon"/>

  <!-- Vector CSS -->

  <link href="{{URL::asset('assets/plugins/vectormap/jquery-jvectormap-2.0.2.css')}}" rel="stylesheet"/>

  <!-- simplebar CSS-->

  <link href="{{URL::asset('assets/plugins/simplebar/css/simplebar.css')}}" rel="stylesheet"/>

  <!-- Bootstrap core CSS-->

  <link href="{{URL::asset('assets/css/bootstrap.min.css')}}" rel="stylesheet"/>

 <!--Lightbox Css-->
  <link href="{{URL::asset('assets/plugins/fancybox/css/jquery.fancybox.min.css')}}" rel="stylesheet" type="text/css"/>
 
 <!--multi select-->

  <link href="{{URL::asset('assets/plugins/jquery-multi-select/multi-select.css')}}" rel="stylesheet" type="text/css">

  <!--Data Tables -->

  <link href="{{URL::asset('assets/plugins/bootstrap-datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css">



  <link href="{{URL::asset('assets/plugins/bootstrap-datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css">

  <!-- animate CSS-->

  <link href="{{URL::asset('assets/css/animate.css')}}" rel="stylesheet" type="text/css"/>

  <!-- Icons CSS-->

  <link href="{{URL::asset('assets/css/icons.css')}}" rel="stylesheet" type="text/css"/>

  <!-- Sidebar CSS-->

  <link href="{{URL::asset('assets/css/sidebar-menu.css')}}" rel="stylesheet"/>

  <!-- Custom Style-->

  <link href="{{URL::asset('assets/css/app-style.css')}}" rel="stylesheet"/>

  <!-- skins CSS-->

  <link href="{{URL::asset('assets/css/skins.css')}}" rel="stylesheet"/>

   <!--Image Upload CSS-->

  <link href="{{URL::asset('assets/imageupload.css')}}" rel="stylesheet"/>

  <link href="{{URL::asset('assets/demo.css')}}" rel="stylesheet"/>

<!--inputtags-->
  <link href="{{URL::asset('assets/plugins/inputtags/css/bootstrap-tagsinput.css')}}" rel="stylesheet" />

<script src="https://cdn.tiny.cloud/1/hn0hkmezzc5loqi41fbzd7xqiqcz5bqzafnf23xsor7eq5sq/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

<script src="https://cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>

</head>
<style type="text/css">
  /*body::after {
  content: '';
  position: fixed;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  background: url('https://admin.agricoaching.co.in/public/assets/images/logo.png');
  opacity: 0.1;
  pointer-events: none;
}*/
</style>
<body>

   

<!-- Start wrapper-->

 <div id="wrapper">

 

  <!--Start sidebar-wrapper-->

   <div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true">

     <div class="brand-logo">

       <a href="{{ url('dashboard') }}">

        <img src="{{URL::asset('assets/images/logo.png')}}" class="logo-icon" alt="logo icon" style="height: 100px;width: 100%;">

         

       </a>

     </div>

   <div class="user-details">

    <div class="media align-items-center user-pointer collapsed" data-toggle="collapse" data-target="#user-dropdown">

      <div class="avatar"><img class="mr-3 side-user-img" src="{{URL::asset('assets/images/logo.png')}}" alt="user avatar"></div>

       <div class="media-body">

       <h6 class="side-user-name"> 

               @if (Auth::check())

                {{ Auth::user()->name}}

                @endif

          </h6>

      </div>

       </div>

     <div id="user-dropdown" class="collapse">

      <ul class="user-setting-menu">

            <li><a href="{{ route('myprofile.index') }}"><i class="icon-user"></i>  My Profile</a></li>

            <li><a href="{{ route('setting.index') }}"><i class="icon-settings"></i> Setting</a></li>

      <li><a href="{{ url('/logout') }}"><i class="icon-power"></i> Logout</a></li>

      </ul>

     </div>

      </div>

   <ul class="sidebar-menu">

      <li class="sidebar-header">MANAGE RECORDS</li>

      @if (Auth::user()->is_admin==1 || Auth::user()->is_admin==0 ||Auth::user()->is_admin==3)

      <li class="">

        <a href="{{ url('dashboard') }}" class="waves-effect">

          <i class="zmdi zmdi-view-dashboard"></i> <span>Dashboard</span>

        </a>

      </li>
       @endif
        @if (Auth::user()->is_admin==2 ||Auth::user()->is_admin==1) 

         <li class="@yield('subject') d-none">
          <!-- {{ url('/summary') }} -->
          <a href="#" class="waves-effect">

            <i class="fa fa-book"></i> <span>Summary</span>

          </a>

        </li>
        <li class="@yield('board')">

        <a href="javaScript:void();" class="waves-effect">

          <i class="fa fa-gear"></i> <span>Master</span>

          <i class="fa fa-angle-left float-right"></i>

        </a>

        <ul class="sidebar-submenu">

          <li class="@yield('board')">
          
            <!-- {{ route('course.index') }} -->
            <!--  -->
          <a href="{{ route('course.index') }}" class="waves-effect">

            <i class="fa fa-clipboard"></i> <span>Courses</span>

          </a>

        </li>

       
        <li class="@yield('subject')">
          <!-- -->
          <a href=" {{ route('subject.index') }}" class="waves-effect">

            <i class="fa fa-book"></i> <span>SubCourses</span>

          </a>

        </li>

        

     <!--  <li class="@yield('chapter')">

          <a href="{{ route('chapter.index') }}" class="waves-effect">

            <i class="fa fa-book"></i> <span>Subjects</span>

          </a>

        </li> -->

         <li class="@yield('topic')">
          <!-- {{ route('topic.index') }} -->
          <a href="{{ route('topic.index') }}" class="waves-effect">

            <i class="fa fa-newspaper-o"></i> <span>Programs</span>

          </a>

        </li>

          <li class="@yield('corner') d-none">
            <!-- {{ route('corner.index') }} -->
          <a href="" class="waves-effect">

            <i class="fa fa-calendar"></i> <span>Corners</span>

          </a>

        </li>



         <li class="@yield('chapter')">

          <a href="{{ route('subtopic.index') }}" class="waves-effect">

            <i class="fa fa-book"></i> <span>Subject & Topics</span>

          </a>

        </li>




          <li class="@yield('app_banner')">
            <!-- -->
          <a href=" {{ route('app_banner.index') }}" class="waves-effect">

            <i class="fa fa-picture-o"></i> <span>App Banners</span>

          </a>

        </li>



         <li class="@yield('promotionalvideo')">
          <!-- {{ route('topic.index') }} -->
          <a href="{{ route('promotionalvideo.index') }}" class="waves-effect">

            <i class="fa fa-newspaper-o"></i> <span>Promotional Video</span>

          </a>

        </li>




        <!--  <li class="@yield('partner')">

          <a href="{{ route('partner.index') }}" class="waves-effect">

            <i class="zmdi zmdi-widgets"></i> <span>Partner Apps</span>

          </a>

        </li> -->

        </ul>

       </li>



         <li class="@yield('news')">
         
          <a href="{{ url('/news') }}" class="waves-effect">

            <i class="fa fa-book"></i> <span>News & Feeds</span>

          </a>

        </li>

         <li class="@yield('app_sidebar')">
         
          <a href="{{ url('/app_sidebar') }}" class="waves-effect">

            <i class="fa fa-book"></i> <span>App Side Bar</span>

          </a>

        </li>


        <li class="@yield('assignment')">
         
          <a href="{{ url('/assignment') }}" class="waves-effect">

            <i class="fa fa-book"></i> <span>Assignment</span>

          </a>

        </li>



        <li class="@yield('monthweekpdf')">
         
          <a href="{{ url('/monthweekpdf') }}" class="waves-effect">

            <i class="fa fa-book"></i> <span>Monthly & Weekly PDF</span>

          </a>

        </li>

      
       @endif

       @if (Auth::user()->is_admin==1)
        <li class="@yield('manage_content')">

        <a href="javaScript:void();" class="waves-effect">

          <i class="fa fa-sliders"></i> <span>Contents</span>

          <i class="fa fa-angle-left float-right"></i>

        </a>

        <ul class="sidebar-submenu">

            <li class="@yield('contents')">
<!-- {{ url('/new/content') }} -->
        <a href="{{ url('/new/content') }}" class="waves-effect">

          <i class="fa fa-play-circle"></i> <span>Content</span>

        </a>

      </li>

         <li class="@yield('faq')">
<!-- {{ route('faq.index') }} -->
        <a href="{{ route('faq.index') }}" class="waves-effect">

          <i class="fa fa-question-circle"></i> <span>Faq</span>

        </a>

      </li>

       <li class="@yield('live_classes')">
<!-- {{ route('live_classes.index') }} -->
        <a href="{{ route('live_classes.index') }}" class="waves-effect">

          <i class="fa fa-video-camera"></i> <span>Live Classes</span>

        </a>

      </li>

        </ul>

       </li>
       @endif
        @if (Auth::user()->is_admin==1)
       
        <li class="@yield('examination')">

        <a href="javaScript:void();" class="waves-effect">

          <i class="fa fa-question-circle"></i> <span>Examination</span>

          <i class="fa fa-angle-left float-right"></i>

        </a>

        <ul class="sidebar-submenu">

          <li class="@yield('question')">
            <!-- {{ route('question.index') }} -->
            <a href="{{ route('question.index') }}"><i class="fa fa-book"></i>Question</a>

          </li>

          <li class="@yield('exam')">
<!-- {{ route('exam.index') }} -->
            <a href="{{ route('exam.index') }}"><i class="fa fa-question-circle"></i>Test Series</a>

          </li>

            <li class="@yield('test') d-none">
<!-- {{ route('test.index') }} -->
            <a href="#"><i class="fa fa-question-circle"></i>Mock Test</a>

          </li>

             <li class="@yield('quiz')">
<!-- {{ route('quiz.index') }} -->
            <a href="{{ route('quiz.index') }}"><i class="fa fa-question-circle"></i>Quizzes</a>

          </li>

           <li class="@yield('instraction')">
            <!-- {{ route('instraction.index') }} -->
            <a href="{{ route('instraction.index') }}"><i class="fa fa-question"></i>Instructions</a>

          </li>

        </ul>

       </li>
       @endif
        @if (Auth::user()->is_admin==1 || Auth::user()->is_admin==0 || Auth::user()->is_admin==3)
       <li class="@yield('subcription')">

        <a href="javaScript:void();" class="waves-effect">

          <i class="zmdi zmdi-lock"></i> <span>Manage Subcription</span>

          <i class="fa fa-angle-left float-right"></i>

        </a>
        <?php
        $url = $_SERVER['REQUEST_URI'];
        ?>
        <ul class="sidebar-submenu">
          <!-- {{ route('subcription_type.index') }} -->
          <!-- <li class="@yield('type')"><a href="{{ route('subcription_type.index') }}"><i class="fa fa-lock"></i>Subcription</a></li> -->

           <!-- <li class="@yield('report')"><a href="{{ route('subcription.create') }}"><i class="fa fa-lock"></i>Subcription Report</a></li> -->
           <!-- {{ route('subcription.create') }} -->
            <li class="<?php if($url == '/subcription/create') echo "active"?>"><a href="{{ route('subcription.create') }}"><i class="fa fa-lock"></i>Subcription Report</a></li>

         <!--  <li class="@yield('packages')"><a href="{{ route('subcription_packages.index') }}"><i class="fa fa-sticky-note-o"></i>Subcription Packages</a></li>-->
         <!-- @yield('histories') -->
         <!-- {{ route('subcription.index') }} -->
         <!--  <li class="<?php //if($url == '/subcription') echo "active"?>"><a href="{{ route('subcription_packages.index') }}"><i class="fa fa-book"></i>Subcription Histories</a></li> -->

        </ul>

       </li>
       @endif



         @if (Auth::user()->is_admin==1 || Auth::user()->is_admin==0 || Auth::user()->is_admin==3)
       <li class="@yield('users')">

        <a href="javaScript:void();" class="waves-effect">

          <i class="zmdi zmdi-accounts"></i> <span>Users</span>

          <i class="fa fa-angle-left float-right"></i>

        </a>

    
        <ul class="sidebar-submenu">
           @if (Auth::user()->is_admin==1)
          <li class="@yield('subadmin')">
            <!-- {{ route('subadmin.index') }} -->
            <a href="{{ route('subadmin.index') }}" class="waves-effect">

              <i class="zmdi zmdi-accounts"></i> <span>Subadmins/Accountant</span>

            </a>
          </li>
       <li class="@yield('faculties')">
        <!-- {{ route('faculties.index') }} -->
        <a href="{{ route('faculties.index') }}" class="waves-effect">

          <i class="zmdi zmdi-account"></i> <span>Faculties</span>
        </a>
      @endif
      </li>
        @if (Auth::user()->is_admin==0 || Auth::user()->is_admin==3 || Auth::user()->is_admin==1)
        <li class="@yield('app_users')">
          <!-- {{ route('app_users.index') }} -->
            <a href="{{ route('app_users.index') }}" class="waves-effect">
                <i class="fa fa-address-book"></i> <span>Users</span>
            </a>
        </li>
        @endif
        </ul>
       </li>
       @endif

        <li class="@yield('chats')">

        <a href="javaScript:void();" class="waves-effect">

          <i class="zmdi zmdi-lock"></i> <span>Chats</span>

          <i class="fa fa-angle-left float-right"></i>

        </a>
        <?php
        $url = $_SERVER['REQUEST_URI'];
        ?>
        <ul class="sidebar-submenu">
           
            <li class="<?php if($url == '/chats/create') echo "active"?>"><a href="{{ route('chats.index') }}"><i class="fa fa-lock"></i>Doubts</a></li>

            <li class="<?php if($url == '/chats/create') echo "active"?>"><a href="{{ route('chats.group_chat') }}"><i class="fa fa-lock"></i>Group Chat</a></li>
        </ul>

       </li>










    
         <li class="@yield('testimonials')">
        
          <a href="{{ url('/testimonials') }}" class="waves-effect">

            <i class="fa fa-book"></i> <span>Tesimonials</span>

          </a>

        </li>


         @if (Auth::user()->is_admin==1 )


          <li class="@yield('allusers')">
        
          <a href="{{ route('notification.create') }}" class="waves-effect">

            <i class="fa fa-book"></i> <span>Notification</span>

          </a>

        </li>




       <?php /*
        <li class="@yield('notification')">

        <a href="javaScript:void();" class="waves-effect">

          <i class="fa fa-bell"></i> <span>Notification</span>

          <i class="fa fa-angle-left float-right"></i>

        </a>

        <ul class="sidebar-submenu">

          <li class="@yield('specific')">
<!-- {{ route('notification.index') }} -->
            <a href="{{ route('notification.index') }}"><i class="fa fa-user"></i>Specific Users</a>

          </li>

          <li class="@yield('allusers')">
<!-- {{ route('notification.create') }} -->
            <a href="{{ route('notification.create') }}"><i class="fa fa-bell"></i>All User</a>

          </li>
        </ul>

       </li>
       */?>





      <li class="">

        <a href="{{ url('logout') }}" class="waves-effect">

          <i class="icon-power"></i> <span>Logout</span>

        </a>

      </li>
      @endif
    </ul>

   

   </div>

   <!--End sidebar-wrapper-->



<!--Start topbar header-->

<header class="topbar-nav">

 <nav id="header-setting" class="navbar navbar-expand fixed-top">

  <ul class="navbar-nav mr-auto align-items-center">

    <li class="nav-item">

      <a class="nav-link toggle-menu" href="javascript:void();">

       <i class="icon-menu menu-icon"></i>

     </a>

    </li>

    <li class="nav-item">

      <form class="search-bar">

        <input type="text" class="form-control" placeholder="Enter keywords">

         <a href="javascript:void();"><i class="icon-magnifier"></i></a>

      </form>

    </li>

  </ul>

     

  <ul class="navbar-nav align-items-center right-nav-link">

    <li class="nav-item">

      <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown" href="#">

        <span class="user-profile"><img src="{{URL::asset('assets/images/logo.png')}}" class="img-circle" alt="user avatar"></span>

      </a>

      <ul class="dropdown-menu dropdown-menu-right">

        <li class="dropdown-item"><i class="icon-power mr-2"></i> <a href="{{ url('/logout') }}">Logout</a></li>

      </ul>

    </li>

  </ul>

</nav>

</header>

<!--End topbar header-->


	

  <div class="content-wrapper">

    <div class="container-fluid">



    @yield('content')

    <!-- End container-fluid-->

    

    </div><!--End content-wrapper-->

   <!--Start Back To Top Button-->

    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>

    <!--End Back To Top Button-->
</div>


	<!--End footer-->


  <footer class="footer">

      <div class="container">

        <div class="text-center">

           Copyright &copy; teknikoglobal.com {{date('Y')}} 

        </div>

      </div>

    </footer>


  <!-- Bootstrap core JavaScript-->

  

  <script src="{{URL::asset('assets/js/popper.min.js')}}"></script>

  <script src="{{URL::asset('assets/js/bootstrap.min.js')}}"></script>

	<!-- js image upload CSS-->
  <script type="text/javascript" src="{{URL::asset('assets/imageupload.js')}}"></script>

 <!-- simplebar js -->

  <script src="{{URL::asset('assets/plugins/simplebar/js/simplebar.js')}}"></script>

  <!-- sidebar-menu js -->

  <script src="{{URL::asset('assets/js/sidebar-menu.js')}}"></script>

  <!-- loader scripts -->

  <script src="{{URL::asset('assets/js/jquery.loading-indicator.html')}}"></script>

  <!-- Custom scripts -->

  <script src="{{URL::asset('assets/js/app-script.js')}}"></script>

  <!-- Chart js -->

  

  <script src="{{URL::asset('assets/plugins/Chart.js/Chart.min.js')}}"></script>

  <!-- Vector map JavaScript -->

  <script src="{{URL::asset('assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js')}}"></script>

  <script src="{{URL::asset('assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js')}}"></script>

  <!-- Easy Pie Chart JS -->

  <script src="{{URL::asset('assets/plugins/jquery.easy-pie-chart/jquery.easypiechart.min.js')}}"></script>

  <!-- Sparkline JS -->

  <script src="{{URL::asset('assets/plugins/sparkline-charts/jquery.sparkline.min.js')}}"></script>

  <script src="{{URL::asset('assets/plugins/jquery-knob/excanvas.js')}}"></script>

  <script src="{{URL::asset('assets/plugins/jquery-knob/jquery.knob.js')}}"></script>

  

   <!--Data Tables js-->

  <script src="{{URL::asset('assets/plugins/bootstrap-datatable/js/jquery.dataTables.min.js')}}"></script>

  <script src="{{URL::asset('assets/plugins/bootstrap-datatable/js/dataTables.bootstrap4.min.js')}}"></script>

  <script src="{{URL::asset('assets/plugins/bootstrap-datatable/js/dataTables.buttons.min.js')}}"></script>

  <script src="{{URL::asset('assets/plugins/bootstrap-datatable/js/buttons.bootstrap4.min.js')}}"></script>

  <script src="{{URL::asset('assets/plugins/bootstrap-datatable/js/jszip.min.js')}}"></script>

  <script src="{{URL::asset('assets/plugins/bootstrap-datatable/js/pdfmake.min.js')}}"></script>

  <script src="{{URL::asset('assets/plugins/bootstrap-datatable/js/vfs_fonts.js')}}"></script>

  <script src="{{URL::asset('assets/plugins/bootstrap-datatable/js/buttons.html5.min.js')}}"></script>

  <script src="{{URL::asset('assets/plugins/bootstrap-datatable/js/buttons.print.min.js')}}"></script>

  <script src="{{URL::asset('assets/plugins/bootstrap-datatable/js/buttons.colVis.min.js')}}"></script>

 <!--Light-box-->
  <script src="{{URL::asset('assets/plugins/fancybox/js/jquery.fancybox.min.js')}}"></script>
  
    <script>

     $(document).ready(function() {

      //Default data table

       //$('#default-datatable').DataTable();



       var table = $('#default-datatable').DataTable( {

        lengthChange: true,

        "lengthMenu": [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
        ],
 

        order: [1, "desc" ],

        buttons: [ 'copy', 'excel', 'pdf', 'print', 'colvis' ]

      } );



     table.buttons().container()

        .appendTo( '#default-datatable_wrapper .col-md-6:eq(0)' );

      

      } );



    </script>



    <script>

        $(function() {

            $(".knob").knob();

        });

    </script>

  <!-- Index js -->

  <!-- <script src="{{URL::asset('assets/js/index.js')}}"></script> -->


 <script>
    tinymce.init({
      selector: 'textarea',
      plugins: 'a11ychecker advcode casechange export formatpainter linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinycomments tinymcespellchecker',
      toolbar: 'a11ycheck addcomment showcomments casechange checklist code export formatpainter pageembed permanentpen table',
      toolbar_mode: 'floating',
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name',
      height:"350px",
   });
  </script>


  

</body>

</html>

