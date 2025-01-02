<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name'
    ];

    public function teachers()
    {
        return $this->belongsToMany(User::class, 'teacher_subject', 'subject_id', 'user_id');
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'subject_group', 'subject_id', 'group_id');
    }

    public function grades()
    {
        return $this->hasMany(Grade::class, 'subject_id');
    }
}