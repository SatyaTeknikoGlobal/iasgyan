@extends('admin/layout')
@section('books')
active
@endsection
@section('book')
active
@endsection
@section('content')
<script src="https://cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>
<div class="container-fluid">
      <!-- Breadcrumb-->
     <div class="row pt-2 pb-2">
        <div class="col-sm-9">
		    <h4 class="page-title">Manage Book</h4>
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active"><a href="javaScript:void();">Book</a></li>
         </ol>
	   </div>
	   <div class="col-sm-3">
       <div class="btn-group float-sm-right">
        <a type="button" class="btn btn-primary waves-effect waves-light" href="{{  route('book.index') }}">List</a>
      </div>
     </div>
     </div>
    <!-- End Breadcrumb-->
	<div class="card">
        <div class="card-header">Edit Book</div>
           <div class="card-body">
           	 @if ($errors->any())
              @foreach ($errors->all() as $error)
              <div id="fadeout-msg" class="alert alert-danger">
                  {{ $error }}
              </div>
              @endforeach
          @endif
            <form action="{{ route('book.update', $data->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
           <div class="form-group row">
            <div class="col-6">
            <label for="input-26" class=" col-form-label">Book Name*</label>
            
            <input type="text" class="form-control form-control-rounded" id="input-26" placeholder="Enter Book Name" name="book_name" required="" value="{{$data->book_name}}">
           
            </div>
            <div class="col-6">
            <label for="input-26" class=" col-form-label">Category*</label>
              <select class="form-control form-control-rounded" aria-label="Default select example" name="category" required="">
              @foreach($category as $row)
              @if($row->id==$data->category)
               <option value="{{$row->id}}" selected="">{{$row->category_name}}</option>
              @else
               <option value="{{$row->id}}">{{$row->category_name}}</option>
              @endif
              @endforeach
            </select>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-6">
            <label for="input-26" class=" col-form-label">Author*</label>
            
             <select class="form-control form-control-rounded" aria-label="Default select example" name="author" required=" ">
              @foreach($author as $row)
              @if($row->id==$data->author)
              <option value="{{$row->id}}" selected="">{{$row->name}}</option>
              @else
              <option value="{{$row->id}}">{{$row->name}}</option>
              @endif
              @endforeach
             
            </select>
            </div>
            <div class="col-6">
            <label for="input-26" class=" col-form-label">Publisher</label>
            
            <select class="form-control form-control-rounded" aria-label="Default select example" name="publisher" required="">
              @foreach($publisher as $row)
              @if($row->id==$data->publisher)
                <option value="{{$row->id}}" selected="">{{$row->name}}</option>
              @else
                <option value="{{$row->id}}">{{$row->name}}</option>
              @endif
              @endforeach
            
            </select>
           
            </div>
          </div>
         
          <div class="form-group row">
            <div class="col-6">
            <label for="input-26" class=" col-form-label">Type</label>
            
             <select class="form-control form-control-rounded" aria-label="Default select example" id="type" name="type" onchange="getFilediv()">
              @if($data->type=='ebook')
                 <option value="ebook" selected="">Ebook</option>
                 <option value="hard_copy">Hard Copy</option>
              @else
              <option value="ebook">Ebook</option>
              <option value="hard_copy" selected="">Hard Copy</option>
             @endif
            </select>
           
            </div>
            <div class="col-6">
            <label for="input-26" class=" col-form-label">Language</label>
            <br>
             <select class="form-control form-control-rounded" aria-label="Default select example" name="language">
              @if($data->language=='hindi')
              <option value="hindi" selected="">Hindi</option>
              <option value="english">English</option>
              @else
              <option value="hindi">Hindi</option>
              <option value="english" selected="">English</option>
              @endif
            </select>
           
            </div>
          </div>
          <div class="form-group row">
                <div class="col-md-12">
                    <div class="lng_fst_com">
                        <label>Description</label>
                        <textarea id='description'  name='description' style='border: 1px solid black;'>{{$data->description}}</textarea><br>
                    </div>
                </div>
            
            </div>
            <div class="form-group row">
              <div class="col-sm-6">
            <label for="input-26" class=" col-form-label">Image</label>
            
            <input type="file" class="form-control-file-rounded" id="input-29" name="image">
            <br>
              @if(isset($data->image) && is_file(public_path('images/books/' .$data->image)))
                <img class="img-fluid" src="{{URL::asset('images/books')}}/{{$data->image}}" alt="Card image cap" height="30" width=120>
              @endif
            </div>
              @if($data->type=='ebook')
            <div class="col-sm-6" id="file_upload">                
            <label for="input-26" class=" col-form-label">File (in Pdf)</label>
            <input type="file" class="form-control-file-rounded" id="input-29" name="file_pdf">
            </div>
            @endif
          </div>
          <div class="form-group row">
            <div class="col-6">
            <label for="input-26" class=" col-form-label">Page</label>
            
            <input type="number" class="form-control form-control-rounded" id="input-26" placeholder="Enter page " name="page" required="" value="{{$data->pages}}">
           
            </div>
            <div class="col-6">
            <label for="input-26" class=" col-form-label">MRP</label>
            
            <input type="number" class="form-control form-control-rounded" id="input-26" placeholder="Enter mrp" name="mrp" required="" value="{{$data->mrp}}">
           
            </div>
          </div>
          <div class="form-group row">
            <div class="col-6">
            <label for="input-26" class=" col-form-label">sale price</label>
            
            <input type="number" class="form-control form-control-rounded" id="input-26" placeholder="Enter sale price" name="sale_price" required="" value="{{$data->sale_price}}">
           
            </div>
            <div class="col-6">
            <label for="input-26" class=" col-form-label">stock count</label>
            
            <input type="number" class="form-control form-control-rounded" id="input-26" placeholder="Enter stock count" name="stock_count" required="" value="{{$data->stock_count}}">
           
            </div>
          </div>
          <div class="form-group row">
            <div class="col-6">
            <label for="input-26" class=" col-form-label">Release Date</label>
            <input type="date" class="form-control form-control-rounded" id="input-26"  name="release_date" required="" value="{{$data->released}}">
            </div>
            <div class="col-6">
            <label for="input-26" class=" col-form-label">In stock</label>
             <select class="form-control form-control-rounded" name="in_stock" id="instock" required="">
                  @if($data->in_stock=='Y')
                  <option value="Y" selected="">Yes</option>
                  <option value="N">No</option>
                  @else
                  <option value="Y">Yes</option>
                  <option value="N" selected="">No</option>
                  @endif
              </select>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-6">
            <label for="input-26" class=" col-form-label">In deal</label>
             <select class="form-control form-control-rounded" name="in_deal" id="deal" required="">
                  @if($data->in_deal=='Y')
                  <option value="Y" selected="">Yes</option>
                  <option value="N">No</option>
                  @else
                  <option value="Y">Yes</option>
                  <option value="N" selected="">No</option>
                  @endif
              </select>
            </div>
            <div class="col-6">
            
             <label for="exampleInputEmail1" class=" col-form-label">Status</label>
              <select class="form-control form-control-rounded" name="status" id="status" required="">
                  @if($data->status=='Y')
                  <option value="Y" selected="">Active</option>
                  <option value="N">No</option>
                  @else
                  <option value="Y">Yes</option>
                  <option value="N" selected="">InActive</option>
                  @endif
              </select>
          </div>
        </div>
          
           <div class="form-group row">
            <label class="col-sm-2 col-form-label"></label>
            <div class="col-sm-10">
            <button type="submit" class="btn btn-dark btn-round px-5"><i class="icon-lock"></i> Submit</button>
            </div>
          </div>
          </form>
         </div>
         </div>
         <script>
              CKEDITOR.replace( 'description' );
             function getFilediv() {
              var type=  $("#type").val();
              if (type=='ebook') {
                $("#file_upload").show();
              }
              else{
                $("#file_upload").hide();
              }
             }
          </script>
@endsection