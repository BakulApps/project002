<?php

namespace App\Models\Exam;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;

    protected $table        = 'exam_entity__classes';
    protected $fillable     = ['class_level', 'class_major', 'class_teacher', 'class_code', 'class_name'];
    protected $primaryKey   = 'class_id';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->timestamps = false;
    }

    public function level()
    {
        return $this->hasOne(
            Level::class,
            'level_id',
            'class_level'
        );
    }

    public function major()
    {
        return $this->hasOne(
            Major::class,
            'major_id',
            'class_major'
        );
    }

    public function user()
    {
        return $this->hasOne(
            User::class,
            'user_id',
            'class_teacher'
        );
    }
}
