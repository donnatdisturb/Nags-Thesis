<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Charts\StudentViolationChart;
use App\Charts\TopStudentViolationChart;
use App\Charts\ViolationRecordChart;
use App\Models\StudentRecords;
use App\Models\Student;
use App\Models\Course;
use App\Models\Section;
use DB;
use Charts;
use Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
  public function index1() {
    
    $user= Auth::user()->id;
    $studentinfo = Student::with('section','course')->where('user_id','=',$user)->get();  
    $id = DB::table('students')->where('user_id', '=', $user)->value('id');
    
    $months = [];
    for ($i = 1; $i <= 12; $i++) {
      $months[] = date('F', mktime(0, 0, 0, $i, 1));
    }
    
    $data = StudentRecords::select(DB::raw('MONTHNAME(date_recorded) as month'), DB::raw('COUNT(id) as count'))
    ->where('student_id','=', $id)
    ->groupBy('month')
    ->get();
    
    $data2 = StudentRecords::select(DB::raw('COUNT(id) as count'))
    ->where('student_id','=', $id)
    ->get();
    
    $data3 = StudentRecords::with('violations')
    ->where('student_id','=', $id)
    ->get();
    
    $chartData = [];
    foreach ($data as $row) {
      $chartData[$row->month] = $row->count;
     }
   
    $chartData = array_merge(array_fill_keys($months, 0), $chartData);
    $studentViolation = new StudentViolationChart;
    $dataset = $studentViolation->labels(array_keys($chartData));
    $dataset = $studentViolation->dataset('Student Violation', 'bar', array_values($chartData));

    $dataset = $dataset->backgroundColor(collect(['#7158e2','#3ae374', '#ff3838',"#FF851B", "#7FDBFF", "#B10DC9", 
    "#FFDC00", "#001f3f", "#39CCCC", "#01FF70", "#85144b", "#F012BE", "#3D9970", "#111111", "#EAF1F5"]));
    
    $studentViolation->options([
      'responsive' => true,
      'tooltips' => ['enabled'=> true],
      
      'title' => [
        'display'=> true,
      ],
      
      'aspectRatio' => 1,
      'scales' => [
        'yAxes'=> [[
          'display'=>true,
          'ticks'=> ['beginAtZero'=> true],
          'gridLines'=> ['display'=> true],
          ]],
          
          'xAxes'=> [[
            'categoryPercentage'=> 0.5,
            'barPercentage' => 1,
            'ticks' => ['beginAtZero' => true],
            'gridLines' => ['display' => true],
            'display' => true
            ]],
          ],
        ]);
        
        $timestamp = DB::table('academicyear')
        ->select('year')->get();
        return view('dashboard.index1', compact( 'studentViolation','timestamp','studentinfo','data','data2','data3') );
      }
  
  public function filter1(Request $request)
  {
    $student= Auth::user()->id;
    $id = DB::table('students')->where('user_id', '=', $student)->value('id');
    $year = $request->year;
    
    $months = [];
    for ($i = 1; $i <= 12; $i++) {
      $months[] = date('F', mktime(0, 0, 0, $i, 1));
    }
    $data = StudentRecords::select(DB::raw('MONTHNAME(date_recorded) as month'), DB::raw('COUNT(id) as count'))
    ->whereYear('date_recorded', $request->year)
    ->where('student_id','=', $id)
    ->groupBy('month')
    ->get();
    
    $data2 = StudentRecords::select(DB::raw('COUNT(id) as count'))
    ->whereYear('date_recorded', $request->year)
    ->where('student_id','=', $id)
    ->get();
    
    $data3 = StudentRecords::with('violations')
    ->whereYear('date_recorded', $request->year)
    ->where('student_id','=', $id)
    ->get();
    
    $chartData = [];
    foreach ($data as $row) {
      $chartData[$row->month] = $row->count;
    }
    $chartData = array_merge(array_fill_keys($months, 0), $chartData);
    $studentViolation = new StudentViolationChart;
    $dataset = $studentViolation->labels(array_keys($chartData));
    $dataset = $studentViolation->dataset('Student Violation', 'bar', array_values($chartData));
    $dataset = $dataset->backgroundColor(collect(['#7158e2','#3ae374', '#ff3838',"#FF851B", "#7FDBFF", "#B10DC9", 
    "#FFDC00", "#001f3f", "#39CCCC", "#01FF70", "#85144b", "#F012BE", "#3D9970", "#111111", "#EAF1F5"]));
    
    $studentViolation->options([
      'responsive' => true,
      'tooltips' => ['enabled'=> true],
      
      'title' => [
        'display'=> true,
      ],
      
      'aspectRatio' => 1,
      'scales' => [
        'yAxes'=> [[
          'display'=>true,
          'ticks'=> ['beginAtZero'=> true],
          'gridLines'=> ['display'=> true],
          ]],
          
          'xAxes'=> [[
            'categoryPercentage'=> 0.5,
            'barPercentage' => 1,
            'ticks' => ['beginAtZero' => true],
            'gridLines' => ['display' => true],
            'display' => true
            ]],
          ],
        ]);

        $timestamp = DB::table('academicyear')->select('year')->get();
        return view('dashboard.filter1', compact( 'studentViolation','timestamp','year','data','data2','data3') );
      } 

  public function index2(){
    
    $violator = DB::table('students')
    ->join('studentrecords','studentrecords.student_id','=','students.id')
    ->groupBy('students.fname')
    ->orderBy(DB::raw('COUNT(studentrecords.id)'), 'DESC')
    ->take(10)
    ->pluck(DB::raw('count(studentrecords.id) as total'),'fname')
    ->all();
    
    $totalstudents = DB::table('students')->count();
    $totalrecords = DB::table('studentrecords')->count();

    $data = DB::table('students')
    ->join('studentrecords','studentrecords.student_id','=','students.id')
    ->groupBy('students.fname','students.lname')
    ->orderBy(DB::raw('COUNT(studentrecords.id)'), 'DESC')
    ->take(10)
    ->select(DB::raw('count(studentrecords.id) as total'),'fname','lname')
    ->get();
    
    $student = DB::table('students')
    ->join('studentrecords','studentrecords.student_id','=','students.id')
    ->orderBy(DB::raw('COUNT(studentrecords.id)'), 'DESC')
    ->select(DB::raw('count(studentrecords.id) as total'),'students.fname','students.lname')
    ->groupBy('students.fname','students.lname')
    ->limit(1)
    ->get();

    $TopViolator = new TopStudentViolationChart;

    $dataset = $TopViolator->labels(array_keys($violator)); 
    $dataset = $TopViolator->dataset('Student Violation', 'bar', array_values($violator));
    $dataset = $dataset->backgroundColor(collect(['#7158e2','#3ae374', '#ff3838',"#FF851B", "#7FDBFF", "#B10DC9", 
    "#FFDC00", "#001f3f", "#39CCCC", "#01FF70", "#85144b", "#F012BE", "#3D9970", "#111111", "#EAF1F5"]));
    $TopViolator->options([
      'responsive' => true,
      'tooltips' => ['enabled'=> true],
      
      'title' => [
        'display'=> true, 
      ],
      
      'aspectRatio' => 1,
      'scales' => [
        'yAxes'=> [[
          'display'=>true,
          'ticks'=> ['beginAtZero'=> true],
          'gridLines'=> ['display'=> true],
          ]],
          
          'xAxes'=> [[
            'categoryPercentage'=> 0.5,
            'barPercentage' => 1,
            'ticks' => ['beginAtZero' => true],
            'gridLines' => ['display' => true],
            'display' => true
            ]],
          ],
        ]);
        
        $record = DB::table('violations')
        ->join('studentrecords','studentrecords.violation_id','=','violations.id')
        ->groupBy('violations.name')
        ->pluck(DB::raw('count(studentrecords.id) as total'),'name')
        ->all();
        
        $topcategory =  DB::table('violations')
        ->join('studentrecords','studentrecords.violation_id','=','violations.id')
        ->orderBy(DB::raw('COUNT(studentrecords.violation_id)'), 'DESC')
        ->select('violations.name',DB::raw('COUNT(studentrecords.violation_id)as count'))
        ->groupBy('violations.name')
        ->limit(1)
        ->get();
        
        $dataV = DB::table('violations')
        ->join('studentrecords','studentrecords.violation_id','=','violations.id')
        ->groupBy('violations.name')
        ->select(DB::raw('count(studentrecords.id) as total'),'name')
        ->get();
        
        $violationrecord = new ViolationRecordChart;
        $dataset = $violationrecord->labels(array_keys($record));
        $dataset = $violationrecord->dataset('Student Violation', 'pie', array_values($record));
        $dataset = $dataset->backgroundColor(collect(['#7158e2','#3ae374', '#ff3838',"#FF851B", "#7FDBFF", "#B10DC9", 
    "#FFDC00", "#001f3f", "#39CCCC", "#01FF70", "#85144b", "#F012BE", "#3D9970", "#111111", "#EAF1F5"]));
    
    $violationrecord->options([
      'responsive' => true,
      'tooltips' => ['enabled'=> true],
      'title' => [
        'display'=> true,
      ],
      'aspectRatio' => 1,
      'scales' => [
        'yAxes'=> [[
          'display'=>false,
          ]],
          'xAxes'=> [['display' => false
          ]],
        ],
      ]);
      
      $timestamp = DB::table('academicyear')->select('year')->get();
      return view('dashboard.index2', compact('data','dataV','TopViolator','timestamp','totalrecords','student','totalstudents',
      'record','violationrecord','topcategory') );
    }


  public function filter2(Request $request){
    $violator = DB::table('students')
    ->join('studentrecords','studentrecords.student_id','=','students.id')
    ->whereYear('studentrecords.date_recorded', $request->year)
    ->groupBy('students.fname')
    ->orderBy(DB::raw('COUNT(studentrecords.id)'), 'DESC')
    ->take(10)
    ->pluck(DB::raw('count(studentrecords.id) as total'),'fname')
    ->all();
    
    $totalrecords = DB::table('studentrecords')->whereYear('date_recorded',$request->year)->count();
    $year = $request->year;
    
    $data = DB::table('students')
    ->join('studentrecords','studentrecords.student_id','=','students.id')
    ->whereYear('studentrecords.date_recorded', $request->year)
    ->groupBy('students.fname','students.lname')
    ->orderBy(DB::raw('COUNT(studentrecords.id)'), 'DESC')
    ->take(10)
    ->select(DB::raw('count(studentrecords.id) as total'),'fname','lname')
    ->get();
    
    $student = DB::table('students')
    ->join('studentrecords','studentrecords.student_id','=','students.id')
    ->whereYear('studentrecords.date_recorded', $request->year)
    ->orderBy(DB::raw('COUNT(studentrecords.id)'), 'DESC')
    ->select(DB::raw('count(studentrecords.id) as total'),DB::raw('count(studentrecords.student_id) as student'),'students.fname','students.lname')
    ->groupBy('students.fname','students.lname')
    ->limit(1)
    ->get();
      
    $TopViolator = new TopStudentViolationChart;

    $dataset = $TopViolator->labels(array_keys($violator));    
    $dataset = $TopViolator->dataset('Student Violation', 'bar', array_values($violator));
    $dataset = $dataset->backgroundColor(collect(['#7158e2','#3ae374', '#ff3838',"#FF851B", "#7FDBFF", "#B10DC9", 
    "#FFDC00", "#001f3f", "#39CCCC", "#01FF70", "#85144b", "#F012BE", "#3D9970", "#111111", "#EAF1F5"]));
    
    $TopViolator->options([
      'responsive' => true,
      'tooltips' => ['enabled'=> true],
     
      'title' => [
        'display'=> true,
      ],
      
      'aspectRatio' => 1,
      'scales' => [
        'yAxes'=> [[
          'display'=>true,
          'ticks'=> ['beginAtZero'=> true],
          'gridLines'=> ['display'=> true],
          ]],
          
          'xAxes'=> [[
                        'categoryPercentage'=> 0.5,
                        'barPercentage' => 1,
                        'ticks' => ['beginAtZero' => true],
                        'gridLines' => ['display' => true],
                        'display' => true
 
                      ]],
        ],
      ]);
      
      $record = DB::table('violations')
      ->join('studentrecords','studentrecords.violation_id','=','violations.id')
      ->whereYear('studentrecords.date_recorded', $request->year)
      ->groupBy('violations.name')
      ->pluck(DB::raw('count(studentrecords.id) as total'),'name')
      ->all();

      $topcategory =  DB::table('violations')
      ->join('studentrecords','studentrecords.violation_id','=','violations.id')
      ->whereYear('studentrecords.date_recorded', $request->year)
      ->orderBy(DB::raw('COUNT(studentrecords.violation_id)'), 'DESC')
      ->select('violations.name',DB::raw('COUNT(studentrecords.violation_id)as count'))
      ->groupBy('violations.name')
      ->limit(1)
      ->get();

      $dataV = DB::table('studentrecords')
      ->join('violations','violations.id','=','studentrecords.violation_id')
      ->whereYear('studentrecords.date_recorded', $request->year)
      ->groupBy('violations.name')
      ->select(DB::raw('count(studentrecords.id) as total'),'name')
      ->get();

      $violationrecord = new ViolationRecordChart;
      $dataset = $violationrecord->labels(array_keys($record));    
      $dataset = $violationrecord->dataset('Student Violation', 'pie', array_values($record));
     
      $dataset = $dataset->backgroundColor(collect(['#7158e2','#3ae374', '#ff3838',"#FF851B", "#7FDBFF", "#B10DC9", 
      "#FFDC00", "#001f3f", "#39CCCC", "#01FF70", "#85144b", "#F012BE", "#3D9970", "#111111", "#EAF1F5"]));
      
      $violationrecord->options([
        'responsive' => true,
        'tooltips' => ['enabled'=> true],
     
        'title' => [
            'display'=> true,
        ],
 
        'aspectRatio' => 1,
        'scales' => [
            'yAxes'=> [[
                        'display'=>false,
                      ]],
            'xAxes'=> [[
                        'display' => false
                      ]],
                    ],
        ]);
        $timestamp = DB::table('academicyear')->select('year')->get();
        return view('dashboard.filter2', compact('data','dataV', 'TopViolator','timestamp','violator','totalrecords', 'year','student','violationrecord','record','topcategory') );
      }
}
     
