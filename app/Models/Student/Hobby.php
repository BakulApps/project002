<?php

namespace App\Models\Student;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hobby extends Model
{
    use HasFactory;

    protected $table        = 'student_entity__hobbies';
    protected $fillable     = ['hobby_id', 'hobby_name'];
    protected $primaryKey   = 'hobby_id';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->timestamps = false;
    }

    static function name($id)
    {
        return $id .' - '. self::where('hobby_id', $id)->value('hobby_name');
    }
}
