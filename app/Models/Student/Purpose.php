<?php

namespace App\Models\Student;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purpose extends Model
{
    use HasFactory;

    protected $table        = 'student_entity__purposes';
    protected $fillable     = ['purpose_id', 'purpose_name'];
    protected $primaryKey   = 'purpose_id';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->timestamps = false;
    }

    static function name($id)
    {
        return $id .' - '. self::where('purpose_id', $id)->value('purpose_name');
    }
}
