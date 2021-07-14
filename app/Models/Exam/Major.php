<?php

namespace App\Models\Exam;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    use HasFactory;

    protected $table        = 'exam_entity__majors';
    protected $fillable     = ['major_code', 'major_name'];

    protected $primaryKey   = 'major_id';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->timestamps = false;
    }
}
