<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoodMoral extends Model
{
    use HasFactory;

    public $table = 'request_goodmoral';
    protected $primaryKey = 'id';
    public $timestamps = false;
    // protected $guarded = [];
    protected $fillable = ['description','status','student_id'];
  
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

}
