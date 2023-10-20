<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guidance extends Model
{
    use HasFactory;
    
    public $table = 'guidances';
    public $primaryKey = 'id';

    protected $fillable = ['guidance_img','fname','lname','user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
