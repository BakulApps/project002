<?php

namespace App\Models\Exam;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    use HasFactory;

    protected $table        = 'exam_entity__roles';
    protected $fillable     = ['role_name', 'role_desc'];
    protected $primaryKey   = 'role_id';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->timestamps = false;
    }
}
