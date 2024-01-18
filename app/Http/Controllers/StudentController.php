<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Section;
use App\Models\Course;
use App\Models\StudentFamily;
use App\Models\User;

use View;
use Redirect;
use Validator;
use Auth;
use DB;
use Hash;

use App\Events\SendMail;
use Event;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;


use App\Imports\StudentImport;
use Excel;
use App\Rules\ExcelRule;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $students= Student::all();

        // return View::make('student.index',compact('students'));
        $students = Student::with('section','course')->paginate(10);


    return View::make('student.index',compact( 'students')) ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sections = Section::pluck('sectionname','id');
        $courses = Course::pluck('coursename','id');

        // return View::make('student.create');
        $students = Student::all();
        return View::make('student.create',compact('students','sections', 'courses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $input['fname'] = $request->fname;
        $input['lname'] = $request->lname;
        $input['section_id'] = $request->section_id;
        $input['course_id'] = $request->course_id;
        // $section = Section::with('student')->where('id', $student->section_id)->select('sectionname')->first();
        // $course = Course::with('student')->where('id', $student->course_id)->select('coursename')->first();

        // dd($input);
         if($request->hasFile('image')) {
            
            $file = $request->file('image') ;
            $fileName = uniqid().'_'.$file->getClientOriginalName();
            // $fileName = $file->getClientOriginalName();
            // dd($fileName);
            $request->image->storeAs('images', $fileName, 'public');
            $input['student_img'] = $fileName;
            //  $student = Student::create($input);
            
             // dd($input);
        }
        $students = Student::create($input);

        // return Redirect::to('students');
        return Redirect::route('studentindex')->with('success','Student Success!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show()
    // {
    //     // $customers = Customer::find($customer);
    //     // $customers = Customer::where('user_id',Auth::id())->get();
    //    return View::make('customer.show',compact('customers'));
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $students = Student::find($id);
        $sections = Section::pluck('sectionname','id');
        $courses = Course::pluck('coursename','id');
        // dd($artist);
        return View::make('student.edit',compact('students','sections', 'courses'));
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
        $students = Student::find($id);

         $input = $request->all();
        // $image = $request->hasFile('image');
         
       if ($request->hasFile('image')) {

            $file = $request->file('image') ;
            $fileName = uniqid().'_'.$file->getClientOriginalName();
            $request->image->storeAs('images', $fileName, 'public');
            $input['student_img'] = $fileName;
             // dd($input);
            // $customer->update($input);
        // }
        }
         $students->update($input);
         // dd($customer);

         return Redirect::route('studentindex')->with('success','Student Success!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //      $students = Student::find($id);

    //     $students->delete();
    //      return Redirect::to('/students')->with('success','Student deleted!');
    // }
    // public function destroyStudent($id)
    // {
    //      $students = Student::find($id);
    //      $students->delete();
    //     return Redirect::route('student.index')->with('success','Student Deleted Success!');
    // }

    public function destroy($id)
    {
         $students = Student::find($id);
        // $customers->users()->detach();
         // if (file_exists($image)) {
        // @unlink($image);
        $students->delete();
        return Redirect::route('student.index')->with('success','Student Deleted Success!');
    }

    public function import(Request $request) {

        $request->validate([
           'student_upload' => ['required', new ExcelRule($request->file('student_upload'))],
       ]);
        Excel::import(new StudentImport, request()->file('student_upload'));
       return redirect()->back()->with('success', 'Excel file Imported Successfully');
   }

   public function profile(){
    $student= Auth::user()->id;
    
    $studentinfo = Student::with('section','course','studentfamily','user')->where('user_id','=',$student)->get();
        //dd($studentinfo);
    return view('student.profile', compact('studentinfo') );

   }

   public function editProfile($id){
    $studentid= Auth::user()->id;
     //dd($studentid);
    $student = Student::find($id);
    // dd($student);
    $students = DB::table('students')
                 ->Join('users','users.id','=','students.user_id')
                  ->select('users.*')
          ->where('users.id','=',$studentid)
          ->get();

    //dd($student);

          
    return View::make('student.editprofile',compact('studentid','student','students'));

   }

   public function updateprofile(Request $request, $id)
    {
        
        $students = Student::find($id);

         $input = $request->all();
        
        // $image = $request->hasFile('image');
         
       if ($request->hasFile('image')) {

            $file = $request->file('image') ;
            $fileName = uniqid().'_'.$file->getClientOriginalName();
            $request->image->storeAs('images', $fileName, 'public');
            $input['student_img'] = $fileName;
             // dd($input);
            // $customer->update($input);
        // }
        }
         $students->update($input);

        

        // $user = auth()->user();
        // $user->update([
        //     // 'name' => $request->input('fname').' '.$request->lname,
        //     // 'email' => $request->input('email'),
        //     'password' => bcrypt($request->input('password')),
        // ]);

        return redirect()->route('studentprofile');
        }

        public function editPassword($id){
            $studentid= Auth::user()->id;
             //dd($studentid);
            $student = Student::find($id);
            // dd($student);
            $students = DB::table('students')
                         ->Join('users','users.id','=','students.user_id')
                          ->select('users.*')
                  ->where('users.id','=',$studentid)
                  ->get();
        
            //dd($student);
        
                  
            return View::make('student.password',compact('studentid','students','student'));
        
           }
        

        public function updatePassword(Request $request, $id){
            $user = auth()->user();
            $users = User::where('id', $user->id)->first();

            if (Hash::check($request->oldpassword, $user->password)) {
                $user->update([
                    'password' => bcrypt($request->input('password')),
                ]);
            } else {
                return redirect()->back()->withErrors(['Invalid email or password']);
            }

    
            return redirect()->route('studentprofile');
        }



 
}



 
