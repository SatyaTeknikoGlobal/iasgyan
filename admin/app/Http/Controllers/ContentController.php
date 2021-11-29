<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Content;
use App\Subject;
use App\Chapter;
use App\Boards;
use App\Classes;
use App\Topic;
use App\StoragePushModel;
use Illuminate\Support\Facades\DB;


class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private function getVideoUrl($video)
    {
        return "https://storage.agricoaching.in/".$video;
    }


    public function index(Request $request)
    {   
      
        $delete = isset($request->content_delete) ? $request->content_delete : '';

        if(!empty($delete) && count($delete) > 0){

            $deleted = DB::table('contents')->wherein('id',$delete)->delete();
            if($deleted){
              return redirect()->to('/new/content');
            }
        }

        $data = Topic::select('contents.*','topics.name as topic_name','topics.chapter_id as topic_chap','topics.subject_id as topic_sub','topics.course_id as topic_course','topics.id as topics_id')->join('contents','topics.id','=','contents.topic_id')->groupBy('contents.topic_id')->orderBy('contents.id','DESC')->paginate(15);

        return view('admin/content/list',array('data'=>$data));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    { 

        $board_id = isset($request->id) ? $request->id: '';
        $subject = Subject::latest()->get();
        $chapter = Chapter::latest()->get();
        $board = Boards::latest()->get();
        $class = Classes::latest()->get();
        return view('admin/content/add',array('board'=>$board,'class'=>$class,'subject'=>$subject,'chapter'=>$chapter,'board_id'=>$board_id));
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
        'subject_id' =>'required|not_in:0',
        'topic_id'=>'required|not_in:0',
        'title' => 'required|not_in:0',
        'sub_topic'=>'',
        'hls_type' => 'required',
       // 'thumbnail' => 'required',
        'type'=>'required',
        'is_paid'=>'required',
        //'is_free'=>'required',

        ]);
        $type = $request->input('type');
        $content_name = $type.time();
        $hls_type = $request->input('hls_type');

        if(!empty($request->thumbnail)){
             $thumbnail = 'thumbnail'.time().'.'.request()->thumbnail->getClientOriginalExtension();
        }
       
        if ($type=='video') {
            if($hls_type != 'youtube'){
                request()->file_upload->move(public_path('content/video'), $content_name.'.mp4');
                 if(!empty($request->thumbnail)){
                request()->thumbnail->move(public_path('content/video/images'), $thumbnail);
             }
            }
            $status = "N";

            if($hls_type == 'youtube'){
                $content_name = $request->input("hls");
                $status = "Y";
            }
            
              $id = auth()->user()->id;
            $insert_content = Content::create([
                'subject_id'=>request('subject_id'),
                'topic_id'=>request('topic_id'),
                'title'=>request('title'),
                'thumbnail'=>$thumbnail ?? '',
                'hls'=>$content_name,
                'hls_type'=>$hls_type,
                'description'=>request('description'),
                'type'=>request('type'),
                'is_paid'=>request('is_paid'),
                'is_free'=>request('is_free'),
                'status'=>$status,
                'record_updated_by'=>$id,
            ]);
            if($hls_type != 'youtube'){
                StoragePushModel::create([
                   "storage_id"=>$insert_content->id,
                   "content_name"=>$content_name,
                   "status"=>'Y'
               ]);
            }
        
        }
        else{
            $content_name = time().'notes.'.request()->file_upload->getClientOriginalExtension();
            $thumbnail = 'thumbnail'.time().'.'.request()->thumbnail->getClientOriginalExtension();
            request()->thumbnail->move(public_path('content/notes/images'), $thumbnail);
            request()->file_upload->move(public_path('content/notes'), $content_name);
           $id = auth()->user()->id;
           $insert_content = Content::create([
            'subject_id'=>request('subject_id'),
            'topic_id'=>request('topic_id'),
            'title'=>request('title'),
            'thumbnail'=>$thumbnail ?? '',
            'hls'=>$content_name,
            'type'=>request('type'),
            'is_paid'=>request('is_paid'),
            'is_free'=>request('is_free'),
            'status'=>'Y',
            'record_updated_by'=>  $id,
        ]);
        }

        return redirect()->route('content.create')
        ->with('success','Content Added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function delete_note(Request $request){

        $delete = isset($request->note_delete) ? $request->note_delete : '';

        if(!empty($delete) && count($delete) > 0){

            $deleted = Content::wherein('topic_id',$delete)->where('type','notes')->delete();
             return redirect()->route('content.index');
        }
      return redirect()->back();
    }



    public function show(Request $request,$id)
    {
         $video = Content::where(['topic_id'=>$id,'type'=>'video'])->get();

         $pre_id = isset($request->pre_id) ? $request->pre_id : 0;
         $id = isset($id) ? $id : $pre_id;
         // foreach ($video as $value) {
         //     $value->hls = $this->getVideoUrl($value->hls);
         // }

        


         $notes = Content::where(['topic_id'=>$id,'type'=>'notes'])->latest()->get();


         $topic = Topic::where(['topics.id'=>$id])
        ->select('topics.*','chapters.chapter_name','subjects.title','boards.board_name')
        ->leftjoin('chapters','topics.chapter_id','=','chapters.id')
        ->leftjoin('boards','topics.course_id','=','boards.id')
        ->leftjoin('subjects','topics.subject_id','=','subjects.id')
        ->first();
         return view('admin/content/show',array('video'=>$video,'topic'=>$topic,'notes'=>$notes,'pre_id'=>$id));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subject = Subject::latest()->get();
        $chapter = Chapter::latest()->get();
        $data= DB::table('contents')
        ->where('contents.id',$id)
        ->get();
        return view('admin/content/edit',array('subject'=>$subject,'chapter'=>$chapter,'data'=>$data));
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
        'title' => 'required',
        'image' => '',
        'is_paid'=>'required',
        'hls_type' => '',
        'status'=>'required'
        ]);

          $image = $request->file('image');
          $hls_type = $request->input('hls_type');
         if (!empty($image)) {  
        $thumbnail = 'thumbnail'.time().'.'.request()->image->getClientOriginalExtension();
        request()->image->move(public_path('content/video/images'), $thumbnail);
            if($hls_type == 'vimeo'){
                $content_name = $request->input("hls");
                $status = "Y";
            
            $data = array(
                'title'=>request('title'),
                'thumbnail'=>$thumbnail,
                'is_paid'=>request('is_paid'),
                'status'=>request('status'),
                'hls_type'=>$hls_type,
                'hls'=>$content_name

            );
            }
            else{
                 $data = array(
                'title'=>request('title'),
                'thumbnail'=>$thumbnail,
                'is_paid'=>request('is_paid'),
                'status'=>request('status'),
                 'hls_type'=>$hls_type,
            );
            }
        }
        else{
            if($hls_type == 'vimeo'){
                $content_name = $request->input("hls");
                $status = "Y";
            $data = array(
                'title'=>request('title'),
                'is_paid'=>request('is_paid'),
                'status'=>request('status'),
                'hls_type'=>$hls_type,
                'hls'=>$content_name

            );
            }
            else{
                 $data = array(
                'title'=>request('title'),
                'is_paid'=>request('is_paid'),
                'status'=>request('status'),
                'hls_type'=>$hls_type,

            );
            }
        }

        Content::where(['id'=>$id])->update($data);
        
        return redirect()->back()
        ->with('success','Content Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         Content::where('id',$id)->delete();
         return redirect()->route('content.index')
        ->with('success','Record Delete successfully.');
    }


    public function run_scheduler()
    {
        $storage_push = StoragePushModel::where(['status'=>'Y'])->first();

        if (!empty($storage_push)){
            $storage_push->status = 'N';
            $storage_push->save();
            $content = Content::find($storage_push->storage_id);
            $this->move_convert_hls($storage_push->content_name);
            $content->status = 'Y';
            $content->save();
            $storage_push->delete();
        }

    }

    private function move_to_spaces($type,$content_name){
        $contents = public_path("/admin/upload_file/".$content_name);
        $contents = \File::get($contents);
        $client = new S3Client([
            'version' => 'latest',
            'region'  => 'sgp1',
            'endpoint' => 'https://sgp1.digitaloceanspaces.com',
            'credentials' => [
                'key'    => env('AWS_ACCESS_KEY_ID'),
                'secret' => env('AWS_SECRET_ACCESS_KEY'),
            ],
        ]);
        $upload_dir = 'documents';
        if ($type == 'video'){
            $upload_dir = 'video';
        }
        $client->putObject([
            'Bucket' => 'epxyz/easy/'.$upload_dir,
            'Key'    => $content_name,
            'Body'   => $contents,
            'ACL'    => 'public-read'
        ]);
        unlink(public_path("/admin/upload_file/".$content_name));
    }
    //1605073677.mp4

    private function move_convert_hls($content_name){
        // $content_name = '1605073677.mp4';
        $contents = public_path("/content/video/".$content_name.'.mp4');
        $destination = public_path("/content/video/../../../../storage.agricoaching.in/".$content_name.'.mp4');
        $shell_path = public_path("/content/video/../../../../storage.agricoaching.in/create-vod-hls.sh");
        rename($contents,$destination);
        $output = shell_exec('/bin/bash '.$shell_path.' '.$destination);
    }
}
