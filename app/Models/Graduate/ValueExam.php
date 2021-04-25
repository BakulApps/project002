<?php

namespace App\Models\Graduate;

use App\Models\Master\Subject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ValueExam extends Model
{
    use HasFactory;
    protected $table        = 'graduate_entity__value_exams';
    protected $fillable     = [
        'value_exam_id',
        'value_exam_point',
        'value_exam_subject'
    ];
    protected $primaryKey   = 'value_exam_id';
    public $timestamps      = false;

    public function student()
    {
        return $this->belongsToMany(
            Student::class,
            'graduate_entity__student_value_exam',
            'value_exam_id',
            'student_id'
        );
    }

    public function subject()
    {
        return $this->hasOne(
            Subject::class,
            'subject_id',
            'value_exam_subject'
        );
    }
}
