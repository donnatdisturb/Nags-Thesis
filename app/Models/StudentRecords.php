<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentRecords extends Model
{
    use HasFactory;
   // use SoftDeletes;
    public $table = 'studentrecords';
    protected $primaryKey = 'id';

    protected $fillable = ['date_recorded', 'remarks','student_id','violation_id','punishment_id','offense_count ','guidance_id', 'status'];

    public static $rules = [
        'date_recorded'=>'required',
      'remarks'=>'required',
      'student_id'=>'required',
      'violation_id'=>'required',
      'guidance_id'=>'required',
    ];

    public function students() 
    {
        return $this->belongsTo(Student::class,'student_id');
    }

    public function violations() 
    {
        return $this->belongsTo(Violations::class,'violation_id');
    }
    public function guidances() {
        return $this->belongsTo(Guidance::class, 'guidance_id');
    }
    public function punishments() {
        return $this->belongsTo(Punishments::class, 'punishment_id');
    }
    public function getSearchResult(): SearchResult
    {
       $url = url('studentrecord/'.$this->id);
    
        return new \Spatie\Searchable\SearchResult(
           $this,
           $this->remarks,
           $this->student_id,
           $this->violation_id,
           $this->guidance_id,

           $url
           );
    }

    public function users() 
    {
        return $this->belongsTo(User::class,'reported_by');
    }

    // public function students()
    // {
    //     return $this->belongsToMany(Student::class);
    // }

    // // Define the users relationship
    // public function users()
    // {
    //     return $this->belongsToMany(User::class);
    // }

    // public function userStudents()
    // {
    //     return $this->belongsToMany(Student::class, User::class);
    // }


    
}