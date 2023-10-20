<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Violations;
use App\Models\Guidance;
use App\Models\StudentRecords;
use App\Models\StudentFamily;
use App\Models\User;
use App\Models\Punishment;
// use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Storage;
// use App\Mail\ContactStudent;

// use App\Models\User;
use View;
use Redirect;
use DB;
use App\Mail\ContactMail;
use Mail;
use Auth;
use Validator;

class StudentRecordController extends Controller
{
    public function index()
    {
        
        $studentrecords = StudentRecords::with('students','violations','guidances','violations.punishments')->paginate(10);
        return View::make('studentrecord.index',compact( 'studentrecords')) ;
    }

    public function create()
    {
         $students = Student::pluck('fname','id');
         $violations = Violations::pluck('name','id');
         $guidances = Guidance::pluck('fname','id');

         $studentrecords = StudentRecords::all();
        return View::make('studentrecord.create',compact('students', 'violations', 'guidances', 'studentrecords'));

    }

    public function create1()
    {
         $students = Student::pluck('fname','id');
         $violations = Violations::pluck('name','id');
         $guidances = Guidance::pluck('fname','id');

         $studentrecords = StudentRecords::all();
        return View::make('studentrecord.create1',compact('students', 'violations', 'guidances', 'studentrecords'));
    }

    public function store(Request $request)
    {
        
      $user = Auth::user()->id;
        $guidance = Guidance::where('user_id',$user)->first();
        $role = User::where('id',$user)->select('role')->first();
        try{

        if($role->role == 'guidance'){
            $input['date_recorded'] = $request->date_recorded;
            $input['remarks'] = $request->remarks;
            $input['student_id'] = $request->student_id;
            $input['violation_id'] = $request->violation_id;
            $input['guidance_id'] =$guidance->id;
            $input['reported_by'] = Auth::user()->id;
            $input['status'] = 'APPROVED';

             

            $studentrecord = StudentRecords::create($input);
            $student= StudentRecords::with('students','violations','students.studentfamily')->where('student_id',$request->student_id)->orderby('id','DESC')->first();
            $guidance= Guidance::where('user_id',Auth::user()->id)->first();
            $data = array(
                'student_fname'=>$student->students->fname,
                'student_lname'=>$student->students->lname,
                'date_recorded'=>$student->date_recorded,
                'remarks'=>$student->remarks,
                'violation'=>$student->violations->name,
                'category'=>$student->violations->category,
                'parent_fname'=>$student->students->studentfamily->fname,
                'parent_lname'=>$student->students->studentfamily->lname,
                'guidance_lname'=>$guidance->lname,
                'guidance_fname'=>$guidance->fname,);
    
            Mail::to($student->students->studentfamily->email)->send(new ContactMail($data));
           

        }
        elseif ($role->role == 'student'){
            $input['date_recorded'] = $request->date_recorded;
            $input['remarks'] = $request->remarks;
            $input['student_id'] = $request->student_id;
            $input['violation_id'] = $request->violation_id;
            $input['guidance_id'] = $request->guidance_id;
            $input['reported_by'] = Auth::user()->id;

            $input['status'] = 'PENDING';

            if ($request->hasFile('video'))
            {
                $file = $request->file('video') ;
                $fileName = uniqid().'_'.$file->getClientOriginalName();
                $request->video->storeAs('videos', $fileName, 'public');
                $input['evidence'] = $fileName;
            }
            $studentrecord = StudentRecords::create($input);

            return Redirect::route('studentprofile')->with('success','Incident Reported Successfuly!');
        }
    }

            catch (\Exception $e) {
                 dd($e);
                DB::rollback();
        return redirect()->back()->with('error', $e->getMessage());
    }
        DB::commit();

        return Redirect::route('studentrecordindex')->with('success','incident Report Approved!');

    }


    public function show($id)
    {
        $studentrecord = StudentRecords::find($id);

        $studentrecords = StudentRecords::with('students','users','users.students')->where('id',$studentrecord->id)->first();
        return View::make('studentrecord.show',compact('studentrecords'));
        
    }

    public function edit($id)
    {
        $studentrecord = StudentRecords::find($id);

        $studentrecords = StudentRecords::with('students','users','users.students')->where('id',$studentrecord->id)->first();
    
        $students = Student::pluck('lname','id');
        $violations = Violations::pluck('name','id');
        $guidances = Guidance::pluck('lname','id');
     
        return View::make('studentrecord.edit',compact('students','violations', 'guidances','studentrecords'));
    }

    public function update(Request $request, $id)
    {

        try{
            DB::beginTransaction();
            $guidance = Guidance::where('user_id',Auth::id())->first();
            $student = Student::find($request->student_id);
            $studentrecords = StudentRecords::find($id);
            $records = StudentRecords::where('id',$studentrecords->id)->first();

            if($request->status == 'APPROVED'){
   
            $studentrecords->status = $request->status;
            $studentrecords->update();
            $student= StudentRecords::with('students','violations','students.studentfamily')->where('id',$studentrecords->id)->orderby('id','ASC')->first();
            $guidance= Guidance::where('user_id',Auth::user()->id)->first();
            $data = array(
                'student_fname'=>$student->students->fname,
                'student_lname'=>$student->students->lname,
                'date_recorded'=>$student->date_recorded,
                'remarks'=>$student->remarks,
                'violation'=>$student->violations->name,
                'category'=>$student->violations->category,
                'parent_fname'=>$student->students->studentfamily->fname,
                'parent_lname'=>$student->students->studentfamily->lname,
                'guidance_lname'=>$guidance->lname,
                'guidance_fname'=>$guidance->fname,);
     
             Mail::to($student->students->studentfamily->email)->send(new ContactMail($data));
            }
            elseif($request->status == 'DISAPPROVED'){
                $studentrecords = StudentRecords::find($id);
                $studentrecords->delete();
            }
         
    }
    catch (\Exception $e) {
      
        DB::rollback();
      
         return redirect()->back();
    }

    DB::commit();
        return Redirect::route('studentrecordindex')->with('success','Student Record Success!');


    }

    public function destroy($id)
    {
        $studentrecords = StudentRecords::find($id);
        $studentrecords->delete();
        return Redirect::route('studentrecordindex')->with('success','Student Record Deleted Success!');
    }
    
    public function search(Request $request){
        $search = $request->input('search');

        $studsearch = DB::table('studentrecords')
        ->join('students','students.id', 'studentrecords.student_id')
        ->join('violations','violations.id', 'studentrecords.violation_id')
        ->join('guidances','guidances.id','studentrecords.guidance_id')
        ->join('punishments','punishments.id','violations.punishment_id')
        ->select('studentrecords.*','students.fname','students.id','violations.name','punishments.name', 'guidances.fname')
        ->where('students.fname', 'LIKE', "%{$search}%")
        ->orwhere('students.lname', 'LIKE', "%{$search}%")
        ->get();
        return View::make('studentrecord.search',compact('studsearch')) ;
    }
}