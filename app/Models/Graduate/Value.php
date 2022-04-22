<?php

namespace App\Models\Graduate;

use App\Models\Master\Subject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Value extends Model
{
    use HasFactory;
    protected $table        = 'graduate_entity__values';
    protected $fillable     = [
        'value_id',
        'value_point',
        'value_subject'
    ];
    protected $primaryKey   = 'value_id';
    public $timestamps      = false;

    public function student()
    {
        return $this->belongsToMany(
            Student::class,
            'graduate_entity__student_value',
            'value_id',
            'student_id'
        );
    }

    public function subject()
    {
        return $this->hasOne(
            Subject::class,
            'subject_id',
            'value_subject'
        );
    }
}
