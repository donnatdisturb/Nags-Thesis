<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    public $table = 'students';
    protected $primaryKey = 'id';

    protected $fillable = ['fname', 'lname','section_id','course_id','user_id','family_id','student_img'];
   
    public function studentfamily() 
    {
        return $this->belongsTo(StudentFamily::class,'family_id');
    }
    public function section() 
    {
        return $this->belongsTo(Section::class,'section_id');
    }
    public function course() 
    {
        return $this->belongsTo(Course::class,'course_id');
    }


    public function studentrecord() 
    {
        return $this->HasMany(StudentRecords::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    

}
