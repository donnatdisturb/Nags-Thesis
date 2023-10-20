<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Counsel extends Model
{
    use HasFactory;

    public $table = 'counsil';
    protected $primaryKey = 'id';

    protected $fillable = ['scheduled_date', 'start_time','end_time','guidance_id','student_id','Status'];

    public function guidance()
    {
        return $this->belongsTo(Guidance::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }


}
