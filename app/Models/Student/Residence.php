<?php

namespace App\Models\Student;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Residence extends Model
{
    use HasFactory;

    protected $table        = 'student_entity__residences';
    protected $fillable     = ['residence_id', 'residence_name'];
    protected $primaryKey   = 'residence_id';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->timestamps = false;
    }

    static function name($id)
    {
        return $id .' - '. self::where('residence_id', $id)->value('residence_name');
    }
}
