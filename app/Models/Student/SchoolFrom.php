<?php

namespace App\Models\Student;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolFrom extends Model
{
    use HasFactory;

    protected $table        = 'student_entity__schools_from';
    protected $fillable     = ['from_id', 'from_name', 'from_category'];
    protected $primaryKey   = 'from_id';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->timestamps = false;
    }

    static function name($id)
    {
        return $id .' - '. self::where('from_id', $id)->value('from_name');
    }
}
