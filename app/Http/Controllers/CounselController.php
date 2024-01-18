<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Student;
use App\Models\Guidance;
use App\Models\User;
use App\Models\Counsel;
use DB;
use Carbon\Carbon;
use Validator;

class CounselController extends Controller
{
    protected function isTimeSlotAvailable($start, $end, $events)
{
    foreach ($events as $event) {
        $eventStart = $event['start'];
        $eventEnd = $event['end'];
        
        // Assuming $eventStart and $eventEnd are in the "YYYY-MM-DD HH:MM" format
        if (($start >= $eventStart && $start < $eventEnd) || ($end > $eventStart && $end <= $eventEnd)) {
            return false;
        }
    }
    return true;
}

   /**

     * Write code on Method

     *

     * @return response()

     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $counselings = Counsel::select('id', 'scheduled_date as start_date', 'start_time', 'end_time', 'student_id', 'guidance_id')
            ->with('student:id,fname,lname')
            ->with('guidance:id,fname,lname')
            ->get();
            
            $formattedData = [];
            foreach ($counselings as $counseling) {
                $startDatetime = $counseling->start_date . ' ' . $counseling->start_time;
                $endDatetime = $counseling->start_date . ' ' . $counseling->end_time;
                $student = $counseling->student;
                $professor = $counseling->guidance;
                
                $formattedData[] = [
                    'id' => $counseling->id,
                    'title' => $student->fname . ' ' . $student->lname,
                    'start' => $startDatetime,
                    'end' => $endDatetime,
                    'studentName' => $student->fname . ' ' . $student->lname,
                    'professorName' => $professor->fname . ' ' . $professor->lname,
                ];
            }
            return response()->json($formattedData);
        }
        
        $students = Student::all();
        $guidance = Guidance::all();
        return view('FullCalendar', compact('students', 'guidance'));
        // return view('counsel.index', compact('students', 'guidance'));
    }

     /**
 
      * Write code on Method
 
      *
 
      * @return response()
 
      */
 
     public function ajax(Request $request)
     {
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
            
                case 'update':
                    $event = Counsel::find($request->id)->update([
                        'title' => $request->title,
                        'start' => $request->start,
                        'end' => $request->end,
                    ]);
                    return response()->json($event);
                    break;
                
    //             case 'delete':
    //                 $event = Counsel::find($request->id)->delete();
    //                 return response()->json($event);
    //                 break;
    //                 default:
 
              break;
            }
        }
    }
