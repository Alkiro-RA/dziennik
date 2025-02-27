<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'grade',
        'comment'
    ];

     public function student()
     {
         return $this->belongsTo(User::class, 'user_id');
     }
 
     public function subject()
     {
         return $this->belongsTo(Subject::class, 'subject_id');
     }
}