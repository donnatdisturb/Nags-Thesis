<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Student;
use App\Models\StudentFamily;
use App\Models\StudentRecords;
use App\Models\Guidance;

use DB;
use Auth;
use Mail;
use Redirect;


use App\Mail\ContactMail;
use App\Mail\ContactStudent;

class NotificationController extends Controller
{
    public function index(){
        $records = DB::table('students')
            ->join('studentrecords', 'studentrecords.student_id', '=', 'students.id')
            ->select(
                'students.id AS id',
                'students.fname AS fname',
                'students.lname AS lname',
                DB::raw("count(studentrecords.student_id) AS totalid"))
        ->groupBy('students.id','fname','lname')
        ->orderBy('students.id','ASC')
        ->take(3)
        ->get();

       return view('records.index',compact('records'));

    }

    public function getRecord($id){

        $student = Student::find($id);
        $profile = Student::with('studentfamily','section','course')->where('id', $student->id)->get();
        $records = StudentRecords::with('students','students.studentfamily','violations')->where('student_id',$student->id)->get();
      
        return view('records.profile',compact('profile','student','records'));
    }

    public function sendnotification($id){
        $student = Student::find($id);
        $family = Student::with('studentfamily')->where('id',$student->id)->first();
        $records = StudentRecords::with('students','students.studentfamily','violations')->where('student_id',$student->id)->get();

        $data = array(
            'student_fname'=>$student->fname,
            'student_lname'=>$student->lname);

        Mail::to($family->studentfamily->email)->send(new ContactMail($data));
        return Redirect::to('home')->with('success','Email sent successfully!');
        
    }

    public function sendemail($id){
        $student = Student::find($id);

        $students = Student::with('user')->where('id',$student->id)->first();
        $guidance_user = Auth::user()->id;

        $guidance = Guidance::with('user')->where('user_id', $guidance_user)->first();
        $data = array(
            'student_fname'=>$student->fname,
            'student_lname'=>$student->lname,
            'guidance_fname'=>$guidance->fname,
            'guidance_lname'=>$guidance->lname);

         Mail::to($students->user->email)->send(new ContactStudent($data));
        return Redirect::to('homepage')->with('success','Email sent successfully!');
        
    }

    
}
