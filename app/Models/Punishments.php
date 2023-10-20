<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Punishments extends Model
{
    use HasFactory;
    public $table = 'punishments';
    protected $primaryKey = 'id';

    protected $fillable = ['punishment_name	'];

    public function violations() 
    {
        return $this->HasMany(Violations::class,'violation_id');
    }
}
