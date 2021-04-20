<?php

namespace App\Models\Exam;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $table        = 'exam_entity__schedules';
    protected $fillable     = ['schedule_subject', 'schedule_level', 'schedule_major', 'schedule_start', 'schedule_end', 'schedule_token', 'schedule_link', 'schedule_monitoring'];

    protected $primaryKey   = 'schedule_id';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->timestamps = false;
    }

    public function subject()
    {
        return $this->hasOne(
            Subject::class,
            'subject_id',
            'schedule_subject'
        );
    }

    public function level()
    {
        return $this->hasOne(
            Level::class,
            'level_id',
            'schedule_level'
        );
    }

    public function major()
    {
        return $this->hasOne(
            Major::class,
            'major_id',
            'schedule_major'
        );
    }
}
