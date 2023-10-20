<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    public $table = 'courses';
    protected $primaryKey = 'id';

    protected $fillable = ['coursename', 'coursecode'];
}
