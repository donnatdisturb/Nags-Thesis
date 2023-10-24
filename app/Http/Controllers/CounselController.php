<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Student;
use App\Models\Guidance;
use App\Models\User;
use App\Models\Counsel;
use DB;
use Auth;
use Mail;
use Redirect;
use View;
use App\Mail\ContactStudent; 
use App\Mail\ContactStudent2;
use App\Mail\ContactStudent3; 
use App\Mail\ContactStudent4; 


class CounselController extends Controller
{
    Public function showcalendar()
    {
        return view('counsel.calendar');
    }
    public function __invoke()
    {
        $events = [];
 
        $appointments = Counsel::with(['student', 'guidance'])->get();
 
        foreach ($appointments as $appointment) {
            $events[] = [
                'title' => $appointment->student->fname . ' ('.$appointment->guidance->fname.')',
                'start' => $appointment->start_time,
                'end' => $appointment->end_time,
            ];
        }
 
        return view('counsel.index', compact('events'));
    }
    public function index(Request $request)
{
    if ($request->ajax()) {
        $counselSchedules = Counsel::with(['student', 'guidance'])->get();
        $events = [];

        foreach ($counselSchedules as $schedule) {
            $events[] = [
                'id' => $schedule->id,
                'title' => $schedule->title,
                'start' => $schedule->scheduled_date,
                'end' => $schedule->scheduled_date,
            ];
        }

        return response()->json($events);
    }

    return view('counsel.calendar');
}

    public function ajax(Request $request)
    {
        switch ($request->type) {
            case 'add':
                $event = Event::create([
                    'title' => $request->title,
                    'start' => $request->start,
                    'end' => $request->end,
                ]);
                return response()->json($event);
                break;
           case 'update':
            $event = Event::find($request->id)->update([
                'title' => $request->title,
                'start' => $request->start,
                'end' => $request->end,
            ]);
            return response()->json($event);
            break;
            case 'delete':
                $event = Event::find($request->id)->delete();
                return response()->json($event);
                break;
                default:
                # code...
                break;
            }
        }
 

    // public function index(){
    //     $events = [];
     
    //     $appointments = Counsel::with(['student', 'guidance'])->get();
     
    //     foreach ($appointments as $appointment) {
    //         $events[] = [
    //             'title' => $appointment->student->fname . ' ' . $appointment->student->lname . ' (' . $appointment->guidance->fname . ' ' . $appointment->guidance->lname . ')',
    //             'start' => $appointment->scheduled_date . ' ' . $appointment->start_time,
    //             'end' => $appointment->scheduled_date . ' ' . $appointment->end_time,
    //         ];
    //     }
        
    //     $counsel = Counsel::with('student')->orderBy('id','DESC')->get();
    //     return View::make('counsel.index', compact('counsel', 'events'));
    // }

    public function create(Request $request, $id)
    {
        $student = Student::find($id);
        $students = Student::with('user')->where('id',$student->id)->first();
       
        return View::make('counsel.calendar',compact('students'));
    }


    public function store(Request $request)
    {
        try{
            $guidance = Guidance::where('user_id',Auth::id())->first();
            $student = Student::find($request->student_id);

            DB::beginTransaction();
            $counsel = new Counsel;
        
            $counsel->guidance()->associate($guidance);
            $counsel->student()->associate($student);
            $counsel->scheduled_date= $request->scheduled_date;
            $counsel->start_time= $request->start_time;
            $counsel->end_time= $request->end_time;
            $counsel->Status = 'PENDING';
       
            $counsel->save();
        }
        catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('topviolator')->with('error', $e->getMessage());
        }
        $student_id = Student::find($request->student_id);
        $stud = Student::with('user')->where('id',$student_id->id)->first();
        $guidance_user = Auth::user()->id;
        $guidance = Guidance::with('user')->where('user_id', $guidance_user)->first();
        $data = array(
            'student_fname'=>$student->fname,
            'student_lname'=>$student->lname,
            'guidance_fname'=>$guidance->fname,
            'guidance_lname'=>$guidance->lname,
            'start_time'=>$counsel->start_time,
            'end_time'=>$counsel->end_time,
            'scheduled_date'=>$counsel->scheduled_date
        );
        Mail::to($stud->user->email)->send(new ContactStudent($data));
        DB::commit();
        return Redirect::to('/counsel/index')->with('success','counsel Recorded!');
    }

    public function edit($id)
    {
        $counsel = counsel::find($id);
        $counsels = counsel::with('student')->where('id',$counsel->id)->first();

        return View::make('counsel.edit',compact('counsel','counsels'));

    }

    public function update(Request $request,$id){
        
        try{
            
            $guidance = Guidance::where('user_id',Auth::id())->first();
            $student = Student::find($request->student_id);
            $counsel = Counsel::find($id);
    
            DB::beginTransaction();
            $counsels = Counsel::find($id);
            
            $counsels->guidance()->associate($guidance);
            $counsels->student()->associate($student);
            $counsels->scheduled_date= $request->scheduled_date;
            $counsels->start_time= $request->start_time;
            $counsels->end_time= $request->end_time;
            $counsels->Status = $request->Status;

            $counsels->update();
        }
        
        catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('topviolator')->with('error', $e->getMessage());
        }
        
        if($request->Status == 'DID NOT ATTEND'){
            $student_id = Student::find($request->student_id);
            $stud = Student::with('user')->where('id',$student_id->id)->first();
            $guidance_user = Auth::user()->id;
            $guidance = Guidance::with('user')->where('user_id', $guidance_user)->first();
            $data = array(
                'student_fname'=>$student->fname,
                'student_lname'=>$student->lname,
                'guidance_fname'=>$guidance->fname,
                'guidance_lname'=>$guidance->lname,
                'start_time'=>$counsel->start_time,
                'end_time'=>$counsel->end_time,
                'scheduled_date'=>$counsel->scheduled_date
            );
            Mail::to($stud->user->email)->send(new ContactStudent2($data));
        }
        elseif($request->Status == 'ATTENDED'){
            $student_id = Student::find($request->student_id);
            $stud = Student::with('user')->where('id',$student_id->id)->first();
            $guidance_user = Auth::user()->id;
            $guidance = Guidance::with('user')->where('user_id', $guidance_user)->first();
            $data = array(
            'student_fname'=>$student->fname,
            'student_lname'=>$student->lname,
            'guidance_fname'=>$guidance->fname,
            'guidance_lname'=>$guidance->lname,
            'start_time'=>$counsel->start_time,
            'end_time'=>$counsel->end_time,
            'scheduled_date'=>$counsel->scheduled_date
        );
        Mail::to($stud->user->email)->send(new ContactStudent4($data));
    }
    DB::commit();
    
    if($request->Status == 'PENDING'){
        $student_id = Student::find($request->student_id);
        $stud = Student::with('user')->where('id',$student_id->id)->first();
        $guidance_user = Auth::user()->id;
        $guidance = Guidance::with('user')->where('user_id', $guidance_user)->first();
        
        $data = array(
                 'student_fname'=>$student->fname,
                 'student_lname'=>$student->lname,
                 'guidance_fname'=>$guidance->fname,
                 'guidance_lname'=>$guidance->lname,
                 'start_time'=>$counsels->start_time,
                 'end_time'=>$counsels->end_time,
                 'scheduled_date'=>$counsels->scheduled_date
                );
                Mail::to($stud->user->email)->send(new ContactStudent3($data));
            }
            return Redirect::to('/counsel/index')->with('success','Counselling Record Updated Successfully!');
        }
    }
