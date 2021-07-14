<?php

namespace App\Models\Exam;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $table        = 'exam_entity__subjects';
    protected $fillable     = ['subject_code', 'subject_name'];

    protected $primaryKey   = 'subject_id';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->timestamps = false;
    }
}
