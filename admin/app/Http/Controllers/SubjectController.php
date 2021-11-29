<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;
use App\Classes;
use App\Subject;
use App\Boards;
use App\Faculties;
use App\Chapter;
use App\Topic;

use Illuminate\Support\Facades\DB;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data= DB::table('subjects')
        ->select('subjects.*','boards.board_name')
        ->join('boards','subjects.board_id','=','boards.id')
        ->orderby('subjects.id','DESC')
        ->get();
      $faculties = Faculties::latest()->get();
        return view('admin/subject/list',array('data'=>$data,'faculties'=>$faculties));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      
        $board = Boards::latest()->select('id','board_name')->get();
        $faculties = Faculties::latest()->select('id','name','phone')->get();
        return view('admin/subject/add',array('board'=>$board,'faculties'=>$faculties));
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
        'board_id' =>'required',
        'title' =>'required',
        'title_hindi' =>'',
        'description' =>'',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:8192',
        'faculties_id'=>'required',
        'status'=>'required',
        ]);
        $imageName = time().'.'.request()->image->getClientOriginalExtension();
        request()->image->move(public_path('images/subject'), $imageName); //orginal 
        copy(public_path('images/subject/').$imageName, public_path('images/chapter/').$imageName); //backup
        $id = auth()->user()->id;
        $faculties_id = implode($request->faculties_id, ',');
        $subject =  Subject::create([
            'board_id'=>request('board_id'),
            'title'=>request('title'),
            'title_hindi'=>request('title_hindi'),
            'image'=>$imageName,
            'description'=>request('description'),
            'slug'=>request('title'),
            'record_updated_by'=>$id,
            'faculties_id'=>$faculties_id,
            'status'=>request('status'),

        ]);
         Chapter::create([
            'boards_id'=>request('board_id'),
            'subject_id'=>$subject->id,
            'chapter_name'=>request('title'),
            'chapter_name_hindi'=>request('title_hindi'),
            'description'=>request('description'),
            'image'=>$imageName,
            'status'=>request('status'),

        ]);
        return redirect()->route('subject.create')
        ->with('success','Subject Added successfully.');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response 
     */
    public function edit($id)
    {
        $class = Classes::latest()->select('id','class_name')->get();
        $board = Boards::latest()->select('id','board_name')->get();
        $data= DB::table('subjects')
        ->select('subjects.*','boards.board_name','boards.id as board_id',)
        ->leftjoin('boards','subjects.board_id','=','boards.id')
        ->orderby('subjects.id','DESC')
        ->where('subjects.id',$id)
        ->get();
        return view('admin/subject/edit',array('board'=>$board,'data'=>$data));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
         $request->validate([
        'board_id' =>'required',
        'title' =>'required',
        'description' =>'',
         'title_hindi' =>'',
        'status'=>'required',
        'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:8192',
        'id'=>'required',
        ]);
         $update_id = auth()->user()->id;
         $id = $request->input('id');
        $image = $request->file('image');
         if (!empty($image)) {
        //Store Image In Folder
        $imageName = time().'.'.request()->image->getClientOriginalExtension();
        request()->image->move(public_path('images/subject'), $imageName);
         $data = array(
            'board_id'=>request('board_id'),
            'title'=>request('title'),
            'title_hindi'=>request('title_hindi'),
            'image'=>$imageName,
            'description'=>request('description'),
            'slug'=>request('title'),
            'record_updated_by'=>$update_id,
            'status'=>request('status'),
         );

          Subject::where('id',$id)->update($data);
          return redirect()->route('subject.index')
        ->with('success','Record Updated successfully.');
    }
    else{
         $data = array(
            'board_id'=>request('board_id'),
            'title'=>request('title'),
              'title_hindi'=>request('title_hindi'),
            'description'=>request('description'),
            'slug'=>request('title'),
            'record_updated_by'=>$update_id,
            'status'=>request('status'),
         );

          Subject::where('id',$id)->update($data);
          return redirect()->route('subject.index')
        ->with('success','Record Updated successfully.');
    }
    }

    // Chapgter List
    public function getSubject()
    {
       $id = $_POST['id'];
       if (!empty($id)) {
        $data=   Topic::where(['subject_id'=>$id])->select('id','name')->get();
        ?>
          <option readonly selected="" value="0">Select Program</option>
      <?php
        foreach ($data as $row) {?>
             <option value="<?=$row->id?>"><?=$row->name?></option>
     <?php }
       }
    }

    // Subject LIST
    public function getSubjectList(Request $request)
    {
       $board_id = $request->input('board_id');
       $subjectList ='<option readonly selected value="0">Select SubCourses</option>';
       $questionList ='';
       if (!empty($board_id)) {
        $data=   Subject::where(['board_id'=>$board_id])->select('id','title')->get();
        foreach ($data as $row) {
           $subjectList.= '<option value="'.$row->id.'">'.$row->title.'</option>';
       }
        $data2 = Question::where(['boards'=>$board_id])->with('subjects')->get();

        foreach ($data2 as $r) {
            $questionList .= ' <tr>
                                    <td>'.$r->id.'</td>
                                    <td class="text-wrap">'.$r->e_question.'</td>
                                    <td class="text-wrap">'.$r->marks.'</td>
                                    <td class="text-wrap">'.$r->difficulty_level.'</td>
                                    <td>
                                        <button href="javascript:void(0);" type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button></td>
                                    </td>
                                 </tr>';

        }
           $arrayName = array('subjectList' => $subjectList,'questionList' =>$questionList);
           echo json_encode($arrayName);exit();
       }

    }

    // Topic LIST
    public function getTopic(Request $request)
    {
       $chapter_id= $request->input('id');
       if (!empty($chapter_id)) {
        $data=   Topic::where(['chapter_id'=>$chapter_id])->select('id','name')->get(); 
        ?>
        <option readonly selected="" value="0">Select Topic</option>
      <?php  foreach ($data as $row) {?>
             <option value="<?=$row->id?>"><?=$row->name?></option>
     <?php }
       }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Subject::where('id',$id)->delete();
         return redirect()->route('subject.index')
        ->with('success','Record Delete successfully.');
    }
}
