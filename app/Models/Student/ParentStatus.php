<?php

namespace App\Models\Student;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentStatus extends Model
{
    use HasFactory;

    protected $table        = 'student_entity__parents_status';
    protected $fillable     = ['parent_id', 'parent_name'];
    protected $primaryKey   = 'parent_id';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->timestamps = false;
    }

    static function name($id)
    {
        return $id .' - '. self::where('status_id', $id)->value('status_name');
    }
}
