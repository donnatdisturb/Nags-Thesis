<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GoodMoral;
use App\Models\User;
use App\Models\Guidance;
use App\Models\Student;
use App\Mail\ContactGuidance1;
use App\Mail\ContactStudent1;
use App\Mail\ContactStudent5;

use App\Events\SendMail;
use Event;
use View;
use Redirect;
use DB;
use Mail;
use Auth;
use Validator;
use Hash;
use Carbon\Carbon;


class GoodMoralController extends Controller
{
    public function index()
    {
        if (auth()->user()->isGuidance()) {
            $goodmorals = GoodMoral::with('student')->paginate(5);
        } else {
            $studentId = auth()->user()->id;
            $goodmorals = GoodMoral::where('student_id', $studentId)->with('student')->paginate(5);
        }
    
        return view('goodmoral.index', compact('goodmorals'));
    }

    public function store(Request $request)
    {
        $studentId = auth()->user()->id;
        $student = Student::where('user_id', $studentId)->first();
        
        if ($student) {
            $studentFName = $student->fname; 
            $studentLName = $student->lname;
            $description = $request->input('description'); 
    
            $input = $request->except('updated_at');
            $input['description'] = 'Good Moral';
            $input['status'] = 'pending';
            $input['schedule_date'] = 'pending';
            $input['student_id'] = $studentId;
    
            $goodmoral = new GoodMoral($input);
            $goodmoral->save();
    
            Mail::to('abigail.geroza@tup.edu.ph')->send(new ContactGuidance1($studentId, $studentFName, $studentLName, $description));
    
            return redirect()->route('goodmoralindex')->with('success', 'Request has been sent!');
        } else {
            return redirect()->route('goodmoralindex')->with('error', 'Student information not found.');
        }
    }
    
    public function update(Request $request, $id)
{
    $guidance = Guidance::where('user_id', auth()->user()->id)->first();

    if (!$guidance) {
        return redirect()->route('goodmoralindex')->with('error', 'You are not authorized to perform this action.');
    }

    $goodmoral = GoodMoral::find($id);

    if (!$goodmoral) {
        return redirect()->route('goodmoralindex')->with('error', 'Good Moral entry not found.');
    }

    $input = $request->except(['_token', '_method']);

    $previousStatus = $goodmoral->status;

    $goodmoral->update($input);

    if (($previousStatus !== 'done' && $goodmoral->status === 'done') || ($previousStatus !== 'denied' && $goodmoral->status === 'denied')) {
        $student = $goodmoral->student;

        if ($student) {
            $studentFName = $student->fname;
            $studentLName = $student->lname;
            $studentEmail = $student->user->email;

            $guidanceFName = $guidance->fname;
            $guidanceLName = $guidance->lname;
            $guidanceEmail = $guidance->email;

            $scheduleDate = $goodmoral->schedule_date; 

            if ($studentEmail) {
                Mail::to($studentEmail)->send(new ContactStudent1($goodmoral, $studentFName, $studentLName, $guidanceFName, $guidanceLName, $guidanceEmail, $scheduleDate));
            } else {
                return redirect()->route('goodmoralindex')->with('error', 'Student email not found or invalid.');
            }
        } else {
            return redirect()->route('goodmoralindex')->with('error', 'Student details not found or invalid.');
        }
    }

    return redirect()->route('goodmoralindex')->with('success', 'Good Moral has been updated successfully.');
}

public function scheduleDate(Request $request, $id)
{
    $goodmoral = GoodMoral::find($id);

    if (!$goodmoral) {
        return redirect()->route('goodmoralindex')->with('error', 'Good Moral entry not found.');
    }

    $goodmoral->schedule_date = Carbon::parse($request->schedule_date);
    $goodmoral->save();

    return redirect()->route('goodmoralindex')->with('success', 'Schedule date has been set.');
}


public function delete(Request $request, $id)
{
    $goodmoral = GoodMoral::find($id);
    
    if (!$goodmoral) {
        return Redirect::route('goodmoralindex')->with('error', 'Good Moral entry not found.');
    }

    if ($goodmoral->status === 'pending' || $goodmoral->status === 'denied') {
        $goodmoral->delete(); 
        return Redirect::route('goodmoralindex')->with('success', 'Good Moral has been deleted.');
    } else {
        $goodmoral->delete(); 
        return Redirect::route('goodmoralindex')->with('success', 'Good Moral has been deleted.');
    }
}

}
