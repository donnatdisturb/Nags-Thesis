<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Violations extends Model
{
    use HasFactory;
    public $table = 'violations';
    protected $primaryKey = 'id';

    protected $fillable = ['name', 'category','punishment_id'];

    public function studentrecords() 
    {
        return $this->HasMany(StudentRecords::class,'violation_id');
    }
    
    public function punishments() 
    {
        return $this->belongsTo(Punishments::class,'punishment_id');
    }
}
