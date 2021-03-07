<?php

namespace App\Models\Admission;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;

    protected $table        = 'admission_entity__forms';
    protected $fillable     = ['form_uuid', 'form_letter', 'form_student', 'form_count', 'form_date'];
    protected $primaryKey   = 'form_id';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->timestamps = false;
    }


    public function student()
    {
        return $this->hasOne(
            Student::class,
            'student_id',
            'form_student'
        );
    }
}
