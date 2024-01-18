<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Violations;
use App\Models\Guidance;
use App\Models\StudentRecords;
use App\Models\StudentFamily;
use App\Models\User;
use App\Models\Punishments;
use App\Models\YearLevel;
use App\Models\Section;
use App\Models\ViolationPunishment;
use App\Models\Offense;
use Illuminate\Support\Facades\File;
use Storage;
use View;
use Redirect;
use DB;
use App\Mail\ContactMail;
use Mail;
use Auth;
use Validator;

class StudentRecordController extends Controller
{
    public function __construct()
{
    $this->middleware('web');
}
    public function index()
    {
        
        $studentrecords = StudentRecords::with('students','violations','guidances','punishments')->paginate(10);
        return View::make('studentrecord.index',compact( 'studentrecords')) ;
    }

    public function create()
    {
        $students = Student::select(DB::raw("CONCAT(fname, ' ', lname) AS full_name"), 'id')->pluck('full_name', 'id');
        $students->prepend('--- Select Student ---', '');

        $violations = Violations::pluck('name','id');
        $guidances = Guidance::pluck('fname','id');
        $Yearlevel = YearLevel::pluck('Name','id');
        $sections = Section::pluck('sectionname','id');
        $violations = Violations::pluck('Statement','id');
        $studentsWithYearLevel = Student::select('id', 'fname','lname', 'YearLevel_id as year_level','section_id as section')->get();
        $studentData = $studentsWithYearLevel->reduce(function ($result, $student) {
            $result[$student->id] = [
                'fname' => $student->fname,
                'YearLevel_id' => $student->YearLevel_id,
            ];
            return $result;
        }, []);
        
    $selectedViolation = request('violation_id');
    $selectedOffenseLevel = $this->determineOffenseLevel(request('student_id'), $selectedViolation);
    $selectedPunishment = $this->getPunishmentForOffenseLevel($selectedViolation, $selectedOffenseLevel);

        $studentrecords = StudentRecords::all();
        return View::make('studentrecord.create',compact('violations',
        'studentData','studentsWithYearLevel',
        'students', 'violations', 'guidances', 
        'studentrecords','Yearlevel','sections',
        'selectedViolation','selectedOffenseLevel','selectedPunishment'));

    }

    public function getOffenseLevel(Request $request)
    {
        $studentId = $request->input('studentId');
        $violationId = $request->input('violationId');
        $offenseLevel = $this->determineOffenseLevel($studentId, $violationId);
    
        
        $punishment = $this->getPunishmentForOffenseLevel($violationId, $offenseLevel);
        return response()->json(['offenseLevel' => $offenseLevel, 'punishment' => $punishment]);
    }
    
    

    private function determineOffenseLevel($studentId, $violationId)
    {   
        $offenseCount = StudentRecords::where('student_id', $studentId)
            ->where('violation_id', $violationId)
            ->count();

        if ($offenseCount == 0) {
            return 'First Offense';
        } elseif ($offenseCount == 1) {
            return 'Second Offense';
        } elseif ($offenseCount == 2) {
            return 'Third Offense';
        } else {
            return 'Subsequent Offense';
        }
    }
    
    private function getPunishmentForOffenseLevel($violationId, $offenseLevel)
    {   
    $offenseLevels = Offense::where('offensename', $offenseLevel)->first();
    if (!$offenseLevels) {
        return 'Offense level not found';
    }
    $offenseLevelId = $offenseLevels->id;
    
    $punishment = ViolationPunishment::where('offense_id', $offenseLevelId)
     ->where('violation_id', $violationId)
     ->first();
    if ($punishment) {
        return $punishment->punishment->name;
    } else {
        return 'No punishment found';
    }
}


    public function create1()
    {
         $students = Student::pluck('fname','id');
         $violations = Violations::pluck('name','id');
         $guidances = Guidance::pluck('fname','id');

         $studentrecords = StudentRecords::all();
        return View::make('studentrecord.create1',compact('students', 'violations', 'guidances', 'studentrecords'));
    }

    // public function store(Request $request)
    // {
        
    //   $user = Auth::user()->id;
    //     $guidance = Guidance::where('user_id',$user)->first();
    //     $role = User::where('id',$user)->select('role')->first();
    //     try{

    //     if($role->role == 'guidance'){
    //         $input['date_recorded'] = $request->date_recorded;
    //         $input['remarks'] = $request->remarks;
    //         $input['student_id'] = $request->student_id;
    //         $input['violation_id'] = $request->violation_id;
    //         $input['guidance_id'] =$guidance->id;
    //         $input['reported_by'] = Auth::user()->id;
    //         $input['status'] = 'APPROVED';

             

    //         $studentrecord = StudentRecords::create($input);
    //         $student= StudentRecords::with('students','violations','students.studentfamily')->where('student_id',$request->student_id)->orderby('id','DESC')->first();
    //         $guidance= Guidance::where('user_id',Auth::user()->id)->first();
    //         $data = array(
    //             'student_fname'=>$student->students->fname,
    //             'student_lname'=>$student->students->lname,
    //             'date_recorded'=>$student->date_recorded,
    //             'remarks'=>$student->remarks,
    //             'violation'=>$student->violations->name,
    //             'category'=>$student->violations->category,
    //             'parent_fname'=>$student->students->studentfamily->fname,
    //             'parent_lname'=>$student->students->studentfamily->lname,
    //             'guidance_lname'=>$guidance->lname,
    //             'guidance_fname'=>$guidance->fname,);
    
    //         Mail::to($student->students->studentfamily->email)->send(new ContactMail($data));
           

    //     }
    //     elseif ($role->role == 'student'){
    //         $input['date_recorded'] = $request->date_recorded;
    //         $input['remarks'] = $request->remarks;
    //         $input['student_id'] = $request->student_id;
    //         $input['violation_id'] = $request->violation_id;
    //         $input['guidance_id'] = $request->guidance_id;
    //         $input['reported_by'] = Auth::user()->id;

    //         $input['status'] = 'PENDING';

    //         if ($request->hasFile('video'))
    //         {
    //             $file = $request->file('video') ;
    //             $fileName = uniqid().'_'.$file->getClientOriginalName();
    //             $request->video->storeAs('videos', $fileName, 'public');
    //             $input['evidence'] = $fileName;
    //         }
    //         $studentrecord = StudentRecords::create($input);

    //         return Redirect::route('studentprofile')->with('success','Incident Reported Successfuly!');
    //     }
    // }

    //         catch (\Exception $e) {
    //              dd($e);
    //             DB::rollback();
    //     return redirect()->back()->with('error', $e->getMessage());
    // }
    //     DB::commit();

    //     return Redirect::route('studentrecordindex')->with('success','incident Report Approved!');

    // }

public function store(Request $request)
{
    $user = Auth::user()->id;
    $guidance = Guidance::where('user_id',$user)->first();
    $punishmentID = Punishments::where('name',$request->punishment)->first();
    $validatedData = $request->validate([
        'date_recorded' => 'required|date',
        'student_id' => 'required',
        'violation_id' => 'required',
        'offenseCount' => 'required',
        'punishment' => 'required',
    ]);

    $studentRecord = new StudentRecords();
    $studentRecord->date_recorded = $validatedData['date_recorded'];
    $studentRecord->student_id = $validatedData['student_id'];
    $studentRecord->violation_id = $validatedData['violation_id'];
    $studentRecord->offense_count = $validatedData['offenseCount'];
    $studentRecord->punishment_id = $punishmentID->id;
    $studentRecord->remarks = $request->remarks;
    $studentRecord->guidance_id = $guidance->id;
    $studentRecord->status = 'Pending';
    $studentRecord->reported_by =Auth::user()->id;
    $studentRecord->save();

    $studentFamily = StudentRecords::with('students','violations','students.studentfamily')->where('student_id',$request->student_id)->orderby('id','DESC')->first();
   
    $guidance= Guidance::where('user_id',Auth::user()->id)->first();
    $data1 = array(
        'student_fname'=>$studentFamily->students->fname,
        'student_lname'=>$studentFamily->students->lname,
        'date_recorded'=>$studentFamily->date_recorded,
        'remarks'=>$studentFamily->remarks,
        'violation'=>$studentFamily->violations->name,
        'category'=>$studentFamily->violations->category,
        'parent_fname'=>$studentFamily->students->studentfamily->fname,
        'parent_lname'=>$studentFamily->students->studentfamily->lname,
        'guidance_lname'=>$guidance->lname,
        'guidance_fname'=>$guidance->fname,);
        Mail::to($studentFamily->students->studentfamily->email)->send(new ContactMail($data1));

    $students = StudentRecords::with('students','violations','students.studentfamily','students.user')->where('student_id',$request->student_id)->orderby('id','DESC')->first();
    $guidance= Guidance::where('user_id',Auth::user()->id)->first();

    $data2 = array(
        'student_fname'=>$students->students->fname,
        'student_lname'=>$studentFamily->students->lname,
        'date_recorded'=>$studentFamily->date_recorded,
        'remarks'=>$studentFamily->remarks,
        'violation'=>$studentFamily->violations->name,
        'category'=>$studentFamily->violations->category,
        'parent_fname'=>$studentFamily->students->studentfamily->fname,
        'parent_lname'=>$studentFamily->students->studentfamily->lname,
        'guidance_lname'=>$guidance->lname,
        'guidance_fname'=>$guidance->fname,);
        Mail::to($studentFamily->students->user->email)->send(new ContactMail($data2));

    return redirect()->route('studentrecordindex')->with('success', 'Student record has been saved.');
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
        // ->join('punishments','punishments.id','violations.punishment_id')
        ->join('violation_punishment','violations.id','violation_punishment.violation_id')
        ->join('punishments','punishments.id','violation_punishment.punishment_id')
        // ->join('violation_punishment','violations.id','violation_punishment.violation_id')
        ->select('studentrecords.*','students.fname','students.id','violations.name','punishments.name', 'guidances.fname')
        ->where('students.fname', 'LIKE', "%{$search}%")
        ->orwhere('students.lname', 'LIKE', "%{$search}%")
        ->get();
        return View::make('studentrecord.search',compact('studsearch')) ;
    }

    public function sendSmsNotificaition(Request $request, $id)
    {
    $student = Student::with('studentfamily')->find($id);

    if (!$student) {
        return abort(404); 
    }

    $contactnumber = $student->studentfamily->phone;

    $basic  = new \Vonage\Client\Credentials\Basic("a7a9ab7e", "6jyWKqGBOaD3CDt3");
    $client = new \Vonage\Client($basic);

    $response = $client->sms()->send(
        new \Vonage\SMS\Message\SMS($contactnumber, 'MBHS GUIDANCE OFFICE', 'This is to inform you that we will have a scheduled home visitation due to the behavior of your chid.Thank you')
    );
    
    $message = $response->current();
    
    if ($message->getStatus() == 0) {
        echo "The message was sent successfully\n";
    } else {
        echo "The message failed with status: " . $message->getStatus() . "\n";
    }
    
}

}