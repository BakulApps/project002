<?php

namespace App\Models\Exam;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $table        = 'exam_entity__students';
    protected $fillable     = ['student_name', 'student_number', 'student_class', 'student_username', 'student_password', 'student_schedule'];

    protected $primaryKey   = 'student_id';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->timestamps = false;
    }

    public function classes()
    {
        return $this->hasOne(
            Classes::class,
            'class_id',
            'student_class'
        );
    }
}
