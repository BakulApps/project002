<?php

namespace App\Models\Graduate;

use App\Models\Master\Subject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ValueSemester extends Model
{
    use HasFactory;
    protected $table        = 'graduate_entity__value_semesters';
    protected $fillable     = [
        'value_semester_id',
        'value_semester_point_know',
        'value_semester_point_skill',
        'value_semester_subject',
        'value_semester_semester',
        'value_semester_year',
    ];
    protected $primaryKey   = 'value_semester_id';
    public $timestamps      = false;

    public function student()
    {
        return $this->belongsToMany(
            Student::class,
            'graduate_entity__student_value_semester',
            'value_semester_id',
            'student_id'
        );
    }

    public function subject()
    {
        return $this->hasMany(
            Subject::class,
            'subject_id',
            'value_semester_subject'
        );
    }
}
