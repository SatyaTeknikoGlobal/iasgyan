<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\BookCategory;
use App\Author;
use App\Publisher;
use Yajra\DataTables\DataTables;


class BookController extends Controller
{/**

         * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getBooks(Request $request)
    {

         $search_data = $request->search['value'];
          if(!empty($search_data)) {
         $data = Book::with(['authors'])
         ->where('book_name', 'LIKE', "%{$search_data}%")
         ->orwhere('type', 'LIKE', "%{$search_data}%")
         ->orwhere('language', 'LIKE', "%{$search_data}%")
         ->orwhere('sale_price', 'LIKE', "%{$search_data}%")
         ->get();
        }
        else{
            $data = Book::with(['authors'])
            ->get();
        }
         return Datatables::of($data)
            ->filter(function ($instance) use ($request) {

            })
            ->make(true);
    }
    public function index()
    {
         // $data = Book::with(['authors','publishers','categories'])->get();
        return view('admin/books/list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
       $category=BookCategory::where('status',1)->get();
       $author=Author::where('status','Y')->get();
       $publisher=Publisher::where('status','Y')->get();
        return view('admin/books/add',array('category'=>$category,'author'=>$author,'publisher'=>$publisher));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
        'book_name' =>'required',
        'category' =>'required',
        'author' =>'required',
        'publisher' =>'required',
        'type' =>'required',
        'language' =>'required',
        'page' =>'required',
        'mrp' =>'required',
        'sale_price' =>'required',
        'stock_count' =>'required',
        'release_date' =>'required',
        'in_stock' =>'required',
        'file_pdf' =>'nullable|mimes:pdf',
        'in_deal' =>'required',
        'status' =>'required',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:8192',
        ]);
        $imageName = time().'.'.request()->image->getClientOriginalExtension();
        request()->image->move(public_path('images/books'), $imageName);
        $fileData ='';
         $file_pdf = $request->file('file_pdf');
        if (!empty($file_pdf)) {
         $fileData = time().'books.'.request()->file_pdf->getClientOriginalExtension();
        request()->file_pdf->move(public_path('images/books'), $fileData);
        }
        else{
           $fileData = '';  
        }
        Book::create([
            'book_name'=>request('book_name'),
            'description'=>request('description'),
            'category'=>request('category'),
            'author'=>request('author'),
            'publisher'=>request('publisher'),
            'type'=>request('type'),
            'language'=>request('language'),
            'file_name'=>$fileData,
            'pages'=>request('page'),
            'mrp'=>request('mrp'),
            'sale_price'=>request('sale_price'),
            'stock_count'=>request('stock_count'),
            'released'=>request('release_date'),
            'in_stock'=>request('in_stock'),
            'in_deal'=>request('in_deal'),
            'status'=>request('status'),
            'image'=>$imageName, 
        ]);
        return redirect()->route('book.index')
        ->with('success','Book Added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Book::where(['id'=>$id])->with(['authors','publishers','categories'])->first();
        return view('admin/books/show',array('data'=>$data));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $category=BookCategory::where('status',1)->get();
       $author=Author::where('status','Y')->get();
       $publisher=Publisher::where('status','Y')->get();
       $data = Book::where(['id'=>$id])->first();
        return view('admin/books/edit',array('category'=>$category,'author'=>$author,'publisher'=>$publisher,'data'=>$data));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $request->validate([
        'book_name' =>'required',
        'category' =>'required',
        'author' =>'required',
        'publisher' =>'required',
        'type' =>'required',
        'language' =>'required',
        'page' =>'required',
        'mrp' =>'required',
        'sale_price' =>'required',
        'stock_count' =>'required',
        'release_date' =>'required',
        'in_stock' =>'required',
        'file_pdf' =>'nullable|mimes:pdf',
        'in_deal' =>'required',
        'status' =>'required',
        'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:8192',
        ]);
        $image = $request->file('image');
        $fileData ='';
        $file_pdf = $request->file('file_pdf');
        if (!empty($file_pdf)) {
         $fileData = time().'books.'.request()->file_pdf->getClientOriginalExtension();
        request()->file_pdf->move(public_path('images/books'), $fileData);
        }
        else{
           $fileData = '';  
        }

       if (!empty($image)) {
        //Store Image In Folder
        $imageName = time().'.'.request()->image->getClientOriginalExtension();
        request()->image->move(public_path('images/books'), $imageName);
        $data = array(
            'book_name'=>request('book_name'),
            'description'=>request('description'),
            'category'=>request('category'),
            'author'=>request('author'),
            'publisher'=>request('publisher'),
            'type'=>request('type'),
            'language'=>request('language'),
            'file_name'=>$fileData,
            'pages'=>request('page'),
            'mrp'=>request('mrp'),
            'sale_price'=>request('sale_price'),
            'stock_count'=>request('stock_count'),
            'released'=>request('release_date'),
            'in_stock'=>request('in_stock'),
            'in_deal'=>request('in_deal'),
            'status'=>request('status'),
            'image'=>$imageName, 
        );
        }
        else{
              $data = array(
                'book_name'=>request('book_name'),
                'description'=>request('description'),
                'category'=>request('category'),
                'author'=>request('author'),
                'publisher'=>request('publisher'),
                'type'=>request('type'),
                'language'=>request('language'),
                'file_name'=>$fileData,
                'pages'=>request('page'),
                'mrp'=>request('mrp'),
                'sale_price'=>request('sale_price'),
                'stock_count'=>request('stock_count'),
                'released'=>request('release_date'),
                'in_stock'=>request('in_stock'),
                'in_deal'=>request('in_deal'),
                'status'=>request('status'),
            );

        }
       Book::where(['id'=>$id])->update($data);
        return redirect()->route('book.index')
        ->with('success','Book Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Book::find($id)->delete();
          return redirect()->route('book.index')
        ->with('success','Book deleted successfully.');
    }
}
