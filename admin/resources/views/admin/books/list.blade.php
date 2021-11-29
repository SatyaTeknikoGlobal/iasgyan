@extends('admin/layout')



@section('books')



active



@endsection



@section('book')



active



@endsection



@section('content')



    <div class="container-fluid">



      <!-- Breadcrumb-->



     <div class="row pt-2 pb-2">



        <div class="col-sm-9">



		    <h4 class="page-title">Manage Books</h4>



		    <ol class="breadcrumb">



            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>



            <li class="breadcrumb-item active"><a href="javaScript:void();">Books</a></li>



         </ol>



	   </div>



	   <div class="col-sm-3">



       <div class="btn-group float-sm-right">



        <a type="button" class="btn btn-primary waves-effect waves-light" href="{{ route('book.create')}}">Add</a>



      </div>



     </div>



     </div>



    <!-- End Breadcrumb-->



      <div class="row">



        <div class="col-lg-12">



          <div class="card">



            <div class="card-header"><i class="fa fa-book"></i> Books List </div>



            <div class="card-body">



              <div class="table-responsive">



              <table id="default" class="table table-bordered">



                <thead>



                    <tr>



                        <th>#</th>



                        <th>Books</th>



                        <th>Type</th>



                        <th>Price</th>



                        <th>AUTHOR</th>



                        <th>Status</th>



                        <th>Action</th>



                    </tr>



                </thead>



                



            </table>



            </div>



            </div>



          </div>



        </div>



      </div><!-- End Row-->



    <!-- End container-fluid-->



     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>



   @if ($message = Session::get('success'))



        <script>



        Swal.fire({



            icon: 'success',



            title: '{{ $message }}',



            showConfirmButton: false,



            timer: 2500



          });



    </script>



@endif



 <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

     <script>

        $(document).ready(function() {

        var oTable = $('#default').DataTable({

        processing: true,

        serverSide: true,

          ajax: {

              url: '{{ route("get_books")}}',

              data: function (d) {



              }

          },

         

          columns: [

              {data: 'id', name: 'id'},

              { "data": 'name', "render":function (data, type, full, meta){

                    return   '<a href="{{ url("book") }}/'+full['id']+'">'+full['book_name']+'</a>';

                    } },

               { "data": 'type', "render":function (data, type, full, meta){

                    return  full['type'];

               } },

                 { "data": 'sale_price', "render":function (data, type, full, meta){

                    return  full['sale_price'];

                } },

               { "data": 'state_name', "render":function (data, type, full, meta){

                  return  full['authors']['name'];

                } },

                 { "data": 'author', "render":function (data, type, full, meta){



                  if (full['status']=='Y') {

                    return '<span class="badge badge-success">Active</span>';

                  }

                  else

                  {

                     return '<span class="badge badge-danger">Deactive</span>';

                  }

                } },

                { "data": null, "render":function (data, type, full, meta){

                        return '<a href="{{ url ("book") }}/'+full["id"]+'/edit" class="btn btn-primary btn-sm"><i class="fa fa-edit" aria-hidden="true"></i> Edit</a><form action="{{ url("book") }}/'+full["id"]+'" method="POST">@csrf @method("DELETE")<button href="javascript:void(0);" type="submit" class="btn btn-danger btn-sm" onclick="return confirm('You Want to Delete this?')"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button></form></td>';

                    } },

          ],

        });



        $('#search-form').on('submit', function(e) {

            oTable.draw();

            e.preventDefault();

        });

       });

    </script>



@endsection