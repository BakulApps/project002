<?php

namespace App\Models\Graduate;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $table        = 'graduate_entity__students';
    protected $fillable     = [
        'student_id',
        'student_name',
        'student_nisn',
        'student_nism',
        'student_class',
        'student_place_birth',
        'student_birthday',
        'student_gender',
        'student_address',
        'student_father',
        'student_mother'
    ];
    protected $primaryKey   = 'student_id';
    public $timestamps      = false;

    public function valuesemester()
    {
        return $this->belongsToMany(
            ValueSemester::class,
            'graduate_entity__student_value_semester',
            'student_id',
            'value_semester_id'
        );
    }

    public function valueexam()
    {
        return $this->belongsToMany(
            ValueExam::class,
            'graduate_entity__student_value_exam',
            'student_id',
            'value_exam_id'
        );
    }

    public function announcement()
    {
        return $this->hasOne(
            Announcement::class,
            'announcement_student',
            'student_id'
        );
    }
}
