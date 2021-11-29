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
        <div class="card-header">Add Book</div>
           <div class="card-body">
           	 @if ($errors->any())
              @foreach ($errors->all() as $error)
              <div id="fadeout-msg" class="alert alert-danger">
                  {{ $error }}
              </div>
              @endforeach
          @endif
            <form action="{{ route('book.store')}}" method="post" enctype="multipart/form-data">
            @csrf
           <div class="form-group row">
            <div class="col-6">
            <label for="input-26" class=" col-form-label">Book Name*</label>
            
            <input type="text" class="form-control form-control-rounded" id="input-26" placeholder="Enter Book Name" name="book_name" required="">
           
            </div>
            <div class="col-6">
            <label for="input-26" class=" col-form-label">Category*</label>
              <select class="form-control form-control-rounded" aria-label="Default select example" name="category" required="">
              <option selected>Open this select Category</option>
              @foreach($category as $row)
              <option value="{{$row->id}}">{{$row->category_name}}</option>
              @endforeach
            </select>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-6">
            <label for="input-26" class=" col-form-label">Author*</label>
            
             <select class="form-control form-control-rounded" aria-label="Default select example" name="author" required=" ">
              <option selected readonly>Open this select Author</option>
              @foreach($author as $row)
              <option value="{{$row->id}}">{{$row->name}}</option>
              @endforeach
             
            </select>
            </div>
            <div class="col-6">
            <label for="input-26" class=" col-form-label">Publisher</label>
            
            <select class="form-control form-control-rounded" aria-label="Default select example" name="publisher" required="">
              <option selected>Open this select publisher</option>
              @foreach($publisher as $row)
              <option value="{{$row->id}}">{{$row->name}}</option>
              @endforeach
            
            </select>
           
            </div>
          </div>
         
          <div class="form-group row">
            <div class="col-6">
            <label for="input-26" class=" col-form-label">Type</label>
            
             <select class="form-control form-control-rounded" aria-label="Default select example" id="type" name="type" onchange="getFilediv()">
              <option selected>Open this select type</option>
              <option value="ebook">Ebook</option>
              <option value="hard_copy">Hard Copy</option>
            </select>
           
            </div>
            <div class="col-6">
            <label for="input-26" class=" col-form-label">Language</label>
            <br>
             <select class="form-control form-control-rounded" aria-label="Default select example" name="language">
              <option selected>Open this select language</option>
              <option value="hindi">Hindi</option>
              <option value="english">English</option>
            </select>
           
            </div>
          </div>
          <div class="form-group row">
                <div class="col-md-12">
                    <div class="lng_fst_com">
                        <label>Description</label>
                        <textarea id='description'  name='description' style='border: 1px solid black;'></textarea><br>
                    </div>
                </div>
            
            </div>
            <div class="form-group row">
              <div class="col-sm-6">
            <label for="input-26" class=" col-form-label">Image</label>
            
            <input type="file" class="form-control-file-rounded" id="input-29" name="image">
            </div>

              <div class="col-sm-6" id="file_upload" style="display: none;">
            <label for="input-26" class=" col-form-label">File (in Pdf)</label>
            <input type="file" class="form-control-file-rounded" id="input-29" name="file_pdf">
            </div>
          </div>
          <div class="form-group row">
            <div class="col-6">
            <label for="input-26" class=" col-form-label">Page</label>
            
            <input type="number" class="form-control form-control-rounded" id="input-26" placeholder="Enter page " name="page" required="">
           
            </div>
            <div class="col-6">
            <label for="input-26" class=" col-form-label">MRP</label>
            
            <input type="number" class="form-control form-control-rounded" id="input-26" placeholder="Enter mrp" name="mrp" required="">
           
            </div>
          </div>
          <div class="form-group row">
            <div class="col-6">
            <label for="input-26" class=" col-form-label">sale price</label>
            
            <input type="number" class="form-control form-control-rounded" id="input-26" placeholder="Enter sale price" name="sale_price" required="">
           
            </div>
            <div class="col-6">
            <label for="input-26" class=" col-form-label">stock count</label>
            
            <input type="number" class="form-control form-control-rounded" id="input-26" placeholder="Enter stock count" name="stock_count" required="">
           
            </div>
          </div>
          <div class="form-group row">
            <div class="col-6">
            <label for="input-26" class=" col-form-label">Release Date</label>
            <input type="date" class="form-control form-control-rounded" id="input-26"  name="release_date" required="">
           
            </div>
            <div class="col-6">
            <label for="input-26" class=" col-form-label">In stock</label>
            
             <select class="form-control form-control-rounded" name="in_stock" id="instock" required="">
                  <option value="Y">Yes</option>
                  <option value="N">No</option>
              </select>
           
            </div>
          </div>
          <div class="form-group row">
            <div class="col-6">
            <label for="input-26" class=" col-form-label">In deal</label>
             <select class="form-control form-control-rounded" name="in_deal" id="deal" required="">
                  <option value="Y">Yes</option>
                  <option value="N">No</option>
              </select>
            </div>
            <div class="col-6">
            
             <label for="exampleInputEmail1" class=" col-form-label">Status</label>
              <select class="form-control form-control-rounded" name="status" id="status" required="">
                  <option value="Y" selected="">Active</option>
                  <option value="N">Deactive</option>
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