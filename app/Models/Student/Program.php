<?php

namespace App\Models\Student;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;

    protected $table        = 'student_entity__programs';
    protected $fillable     = ['program_id', 'program_name'];
    protected $primaryKey   = 'program_id';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->timestamps = false;
    }

    static function name($id)
    {
        return $id .' - '. self::where('program_id', $id)->value('program_name');
    }
}
