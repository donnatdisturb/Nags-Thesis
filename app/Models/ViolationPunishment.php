<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ViolationPunishment extends Model
{
    use HasFactory;
    public $table = 'violation_punishment';
    protected $primaryKey = 'id';

    protected $fillable = ['violation_id', 'offense_id','punishment_id'];

    public function punishment()
    {
        return $this->belongsTo(Punishments::class,'punishment_id', 'id');
    }  

    public function violation() 
    {
        return $this->belongsTo(Violation::class,'violation_id','id');
    }

    public function offense() 
    {
        return $this->belongsTo(Offense::class,'offense_id','id');
    }
}