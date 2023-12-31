<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Student;
use App\Models\Guidance;
use App\Models\User;
use App\Models\Counsel;
use DB;
<<<<<<< HEAD

class CallendarController extends Controller
{
=======
use Carbon\Carbon;

class CallendarController extends Controller
{
    protected function isTimeSlotAvailable($start, $end, $events)
    {
        foreach ($events as $event) {
            if (($start >= $event['start'] && $start < $event['end']) || ($end > $event['start'] && $end <= $event['end'])) {
                return false;
            }
        }
        return true; 
    }

>>>>>>> cd8d8b7f4e5381cf677fd4ce968275c83e73b30f
   /**

     * Write code on Method

     *

     * @return response()

     */

     public function index(Request $request)
     {
         if ($request->ajax()) {
            $counselings = Counsel::select('id', 'scheduled_date as start_date', 'start_time', 'end_time', 'student_id')
            ->with('student:id,fname,lname')
            ->get();
            $formattedData = [];

             foreach ($counselings as $counseling) {
                 $startDatetime = $counseling->start_date . ' ' . $counseling->start_time;
                 $endDatetime = $counseling->start_date . ' ' . $counseling->end_time;
             
                 $student = $counseling->student;
                 $title = $student->fname . ' ' . $student->lname;
             
                 $formattedData[] = [
                     'id' => $counseling->id,
                     'title' => $title,
                     'start' => $startDatetime,
                     'end' => $endDatetime,
                 ];
             }
             
             return response()->json($formattedData);
        }
    
        $students = Student::all();
        $guidance = Guidance::all();
    
        return view('FullCalendar', compact('students', 'guidance'));
     }
     

     /**
 
      * Write code on Method
 
      *
 
      * @return response()
 
      */
 
     public function ajax(Request $request)
     {
<<<<<<< HEAD
        // dd($request->all());
        switch ($request->type) {
            case 'add':
                // $event = Counsel::create([
                //     'scheduled_date' => $request->coachingDate,
                //     'start_time' => $request->starttime,
                //     'end_time' => $request->endtime,
                //     'guidance_id' =>$request->guidance,
                //     'student_id' => $request->student,
                //     'Status' => 'PENDING',
                // ]);
                $event = DB::table('counsil')->insert([
                    'scheduled_date' => $request->coachingDate,
                    'start_time' => $request->starttime,
                    'end_time' => $request->endtime,
                    'guidance_id' => $request->guidance,
                    'student_id' => $request->student,
                    'Status' => 'PENDING',
                ]);
                
                
                return response()->json($event);
                break;
                
=======
        switch ($request->type) {
            case 'add':
                $coachingDate = $request->coachingDate;
                $starttime = $request->starttime;
                $endtime = $request->endtime;
                
                $conflictingEvents = Counsel::where(function ($query) use ($coachingDate, $starttime, $endtime) {
                    $query->where(function ($query) use ($coachingDate, $starttime, $endtime) {
                        $query->whereDate('scheduled_date', '=', $coachingDate)
                        ->whereTime('start_time', '<', $endtime)
                        ->whereTime('end_time', '>', $starttime);
                    })->orWhere(function ($query) use ($coachingDate, $starttime, $endtime) {
                        $query->whereDate('scheduled_date', '=', $coachingDate)
                        ->whereTime('start_time', '<', $endtime)
                        ->whereTime('end_time', '>', $starttime);
                    });
                })
                ->get();
                
                if ($conflictingEvents->isEmpty()) {
                    $event = DB::table('counsil')->insert([
                        'scheduled_date' => $coachingDate,
                        'start_time' => $request->starttime, 
                        'end_time' => $request->endtime,
                        'guidance_id' => $request->guidance,
                        'student_id' => $request->student,
                        'Status' => 'PENDING',
                    ]);
            
                    return response()->json($event);
                } else {
                    return response()->json(['error' => 'Time slot is already taken.']);
                }
                break;
            
>>>>>>> cd8d8b7f4e5381cf677fd4ce968275c83e73b30f
                case 'update':
                    $event = Counsel::find($request->id)->update([
                        'title' => $request->title,
                        'start' => $request->start,
                        'end' => $request->end,
                    ]);
                    return response()->json($event);
                    break;
                
                case 'delete':
                    $event = Counsel::find($request->id)->delete();
                    return response()->json($event);
                    break;
                    default:
 
              break;
            }
        }
<<<<<<< HEAD
    }
=======
    }
>>>>>>> cd8d8b7f4e5381cf677fd4ce968275c83e73b30f
